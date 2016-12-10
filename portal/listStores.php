<?php

session_start();
require_once('../dbcon.php');
if(!isset($_SESSION['auth']))
	die();
/*if(!($_SESSION['type'] & 0b10)){
	die();
}*/
if(isset($_GET['region']) && !isset($_GET['state'])){
	$stmt = $db->prepare('SELECT * from stores left join states on stores.state_id = states.id left join regions on states.rid = regions.id where regions.id = :region');
	$stmt->bindParam(':region', $_GET['region']);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($results);
}elseif(isset($_GET['region']) && isset($_GET['state'])){
	$stmt = $db->prepare('SELECT * from stores left join states on stores.state_id = states.id left join regions on states.rid = regions.id where regions.id = :region and states.id= :state');
	$stmt->bindParam(':region', $_GET['region']);
	$stmt->bindParam(':state', $_GET['state']);
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($results);
}