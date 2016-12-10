<?php

session_start();
require_once('../dbcon.php');
if(!isset($_SESSION['auth']))
	die();
/*if(!($_SESSION['type'] & 0b10)){
	die();
}*/
$stmt = $db->prepare('SELECT * from companies');
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_OBJ);
echo json_encode($results);