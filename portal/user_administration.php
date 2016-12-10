<?php
session_start();
require_once('../dbcon.php');
if(!isset($_SESSION['auth']))
	die();
if(!($_SESSION['type'] & 0b1)){
	die();
}
function genPW($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if(isset($_POST['action'])){
	switch($_POST['action']){
		case 'list-users':
			$stmt = $db->prepare('SELECT users.id, email, fname, lname, type, docs from users;');
			$stmt->execute();
			$users = $stmt->fetchAll(PDO::FETCH_OBJ);
			echo json_encode($users);
			break;
		case 'prep-user':
			$result = $db->query("select prep_user();");
			echo json_encode(intval($result->fetch(PDO::FETCH_NUM)[0]));
			break;
		case 'create-user':
			if(isset($_POST['update']))
				$stmt = $db->prepare('update users set fname=:fname, lname=:lname ,email=:email, type=:type, docs=:docs where id=:id');
			else
				$stmt = $db->prepare('insert into users (id, fname,lname,email,password,type,docs) values (:id, :fname, :lname, :email, :password, :type, :docs)');
			$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
			$stmt->bindParam(':fname', $_POST['fname']);
			$stmt->bindParam(':lname', $_POST['lname']);
			$stmt->bindParam(':email', $_POST['email']);
			$stmt->bindParam(':type', $_POST['type'], PDO::PARAM_INT);
			$stmt->bindParam(':docs', $_POST['docs'], PDO::PARAM_INT);
			$pw = genPW(8);
			$password = hash('sha256', $_POST['id'].$pw);
			if(!isset($_POST['update']))
				$stmt->bindParam(':password', $password);
			$status = $stmt->execute();
			$r_status = 1;
			if(isset($_POST['region'])){
				$stmt = $db->prepare('insert into owner_region (uid, rid) values (:uid, :rid)');
				$stmt->bindParam(':uid', $_POST['id']);
				$stmt->bindParam(':rid', $_POST['region']);
				$r_status = $stmt->execute();
			}
			if ($status && $r_status && !isset($_POST['update'])){
				mail($_SESSION['email'], "New 33degree.com user", "The user with the email address {$_POST['email']} has been assigned the password: $pw.");
			}
			echo json_encode($status);
			break;
		case 'delete-user':
			$stmt = $db->prepare('delete from users where id=:id');
			$stmt->bindParam(':id', $_POST['id']);
			$status = $stmt->execute();
			echo json_encode($status);
			break;
		default:
			die();
			break;
	}
}