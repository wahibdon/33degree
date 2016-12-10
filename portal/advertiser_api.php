<?php
session_start();
require_once('../dbcon.php');
if(!isset($_SESSION['auth']))
	die();
if(!($_SESSION['type'] & 0b100)){
	die();
}
if(!isset($_GET['call']))
	die();
switch ($_GET['call']){
	case 'list-orders':
		$stmt = $db->prepare("SELECT orders.*, concat(users.fname, ' ', users.lname) client from orders left join users on users.id=orders.uid where uid=:client_id  and current_date() < end_date order by order_number ASC");
		$stmt->bindParam(':client_id', $_SESSION['id']);
		$stmt->execute();
		echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
		break;
	case 'list-historical':
		$stmt = $db->prepare("SELECT orders.*, concat(users.fname, ' ', users.lname) client from orders left join users on users.id=orders.uid where uid=:client_id  and end_date < current_date() order by order_number ASC");
		$stmt->bindParam(':client_id', $_SESSION['id']);
		$stmt->execute();
		echo json_encode($stmt->fetchAll(PDO::FETCH_OBJ));
		break;
	default:
		echo json_encode(false);
		break;
}