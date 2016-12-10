<?php
session_start();
require_once('../dbcon.php');
if(!isset($_SESSION['auth']))
	die();
if(!($_SESSION['type'] & 0b10) && !($_SESSION['type'] & 0b1000) && !($_SESSION['type'] & 0b100)){
	die();
}
if(isset($_POST['action'])){
	switch($_POST['action']){
		case 'list':
			$ids = [];
			$stmt = $db->prepare('select reqs.*, regions.name as region, companies.name as company from reqs left join request_target on reqs.id = request_target.rid left join regions on request_target.tid = regions.id left join companies on companies.id = regions.cid where uid = :uid');
			$stmt->bindParam(':uid', $_SESSION['id'], PDO::PARAM_INT);
			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_OBJ);
			if (count($results) == 0){
				echo json_encode(false);
				break;
			}
			for ($i=0; $i<count($results); $i++){
				$ids[$i] = $results[$i]->id;
			}
			$qmarks = implode(', ', array_fill(0, count($ids), '?'));
			$stmt = $db->prepare("select * from (select * from request_files union select* from proofs) files where rid IN ($qmarks)");
			$stmt->execute($ids);
			$files = $stmt->fetchAll(PDO::FETCH_OBJ);
			echo json_encode([$results, $files]);
			break;
		case 'list-all':
			$ids = [];
			$stmt = $db->prepare('select reqs.*, regions.name as region, companies.name as company from reqs left join request_target on reqs.id = request_target.rid left join regions on request_target.tid = regions.id left join companies on companies.id = regions.cid');
			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_OBJ);
			for ($i=0; $i<count($results); $i++){
				$ids[$i] = $results[$i]->id;
			}
			$qmarks = implode(', ', array_fill(0, count($ids), '?'));
			$stmt = $db->prepare("select * from (select * from request_files union select* from proofs) files where rid IN ($qmarks)");
			$stmt->execute($ids);
			$files = $stmt->fetchAll(PDO::FETCH_OBJ);
			echo json_encode([$results, $files]);
			break;
		case 'create-request':
			$status = 0;
			$stmt = $db->prepare('insert into requests (uid, name, body, duration, status, due) values (:uid, :name, :body, :duration, :status, :due);');
			$stmt->bindParam(':uid', $_SESSION['id'], PDO::PARAM_INT);
			$stmt->bindParam(':name', $_POST['name']);
			$stmt->bindParam(':body', $_POST['description']);
			$stmt->bindParam(':duration', $_POST['duration'], PDO::PARAM_INT);
			$stmt->bindParam(':status', $status, PDO::PARAM_INT);
			$stmt->bindParam(':due', $_POST['due']);
			$stmt->execute();
			$id = $db->lastInsertId();
			$stmt = $db->prepare("insert into request_target (rid, tid) value (:id, :tid);");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->bindParam(':tid', $_POST['region']);
			$stmt->execute();
			$stmt = $db->prepare("insert into request_files (rid, url) value (:id, :name);");
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			foreach ($_FILES as $file){
				$stmt->bindParam(':name', $file['name']);
				$stmt->execute();
			}
			echo json_encode(true);
			break;
		case 'delete':
			$stmt = $db->prepare('delete from requests where id = :id');
			$stmt->bindParam(':id', $_POST['index'], PDO::PARAM_INT);
			$result = $stmt->execute();
			echo json_encode($result);
			break;
		case 'proof':
			$stmt  = $db->prepare("update requests set status=1 where id=:id");
			$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
			$stmt->execute();
			$stmt = $db->prepare("insert into proofs (rid, url) values (:rid, :url)");
			$stmt->bindParam(':rid', $_POST['id'], PDO::PARAM_INT);
			$stmt->bindParam(':url', $_FILES['file']['name']);
			$stmt->execute();
			$id = $db->lastInsertId();
			echo json_encode($id);
			break;
		case 'complete':
			$stmt = $db->prepare("update requests set status=2 where id=:id");
			$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
			$stmt->execute();
			echo json_encode(true);
			break;
		default:
			echo json_encode(true);
			break;
	}
}