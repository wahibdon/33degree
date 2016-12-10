<?php

session_start();
require_once('../dbcon.php');
if(!isset($_SESSION['auth']))
	die();
if(!($_SESSION['type'] & 0b10000)){
	die();
}
if(!isset($_GET['call']))
	die();
switch ($_GET['call']){
	case 'list-regions':
		$stmt = $db->prepare("SELECT * from regions");
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_OBJ);
		echo json_encode($results);
		break;
	case 'list-stores':
		if(isset($_GET['region']) && !isset($_GET['state'])){
			$stmt = $db->prepare('SELECT stores.* from stores left join states on stores.state_id = states.id left join regions on states.rid = regions.id where regions.id = :region');
			$stmt->bindParam(':region', $_GET['region']);
			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_OBJ);
			echo json_encode($results);
		}elseif(isset($_GET['region']) && isset($_GET['state'])){
			$stmt = $db->prepare('SELECT stores.* from stores left join states on stores.state_id = states.id left join regions on states.rid = regions.id where regions.id = :region and states.id= :state');
			$stmt->bindParam(':region', $_GET['region']);
			$stmt->bindParam(':state', $_GET['state']);
			$stmt->execute();
			$results = $stmt->fetchAll(PDO::FETCH_OBJ);
			echo json_encode($results);
		}
		break;
	case 'list-states':
		$stmt = $db->prepare("SELECT * from states where rid=:region");
		$stmt->bindParam(':region', $_GET['region']);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_OBJ);
		echo json_encode($results);
		break;
	case 'list-clients':
		$stmt = $db->prepare("SELECT * from users left join client_seller on client_id = users.id where seller_id = :uid");
		$stmt->bindParam(':uid', $_SESSION['id']);
		$stmt->execute();
		echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
		break;
	case 'submit-order':
		$form = json_decode($_GET['form']);
		$stmt = $db->prepare("INSERT into orders (uid, title, duration, status, start_date, end_date) values (:uid, :title, :duration, 0, :start, :end)");
		$stmt->bindParam(':uid', $form->client);
		$stmt->bindParam(':title', $form->title);
		$stmt->bindParam(':duration', $form->duration);
		$stmt->bindParam(':start', $form->start_date);
		$stmt->bindParam(':end', $form->end_date);
		$stmt->execute();
		$order_num = $db->lastInsertId();
		$stores = $db->prepare("INSERT INTO order_assignment (order_number, store_number) values (:order, :store);");
		$stores->bindParam(":order", $order_num);
		for ($i=0; $i<count($form->stores); $i++){
			$stores->bindParam(":store", $form->stores[$i]);
			$stores->execute();
		}
		echo json_encode(true);
		break;
	case 'list-orders':
		$stmt = $db->prepare("SELECT orders.*, concat(users.fname, ' ', users.lname) client from orders left join client_seller on orders.uid = client_seller.client_id left join users on users.id=client_seller.client_id where seller_id=:seller_id  and current_date() < end_date order by order_number ASC");
		$stmt->bindParam(':seller_id', $_SESSION['id']);
		$stmt->execute();
		echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
		break;
	case 'list-historical':
		$stmt = $db->prepare("SELECT orders.*, concat(users.fname, ' ', users.lname) client from orders left join client_seller on orders.uid = client_seller.client_id left join users on users.id=client_seller.client_id where seller_id=:seller_id  and end_date < current_date() order by order_number ASC");
		$stmt->bindParam(':seller_id', $_SESSION['id']);
		$stmt->execute();
		echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
		break;
	default:
		echo json_encode(false);
		break;
}