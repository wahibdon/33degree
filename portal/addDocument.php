<?php

session_start();
require_once('../dbcon.php');
if(!isset($_SESSION['auth']))
	die();
if(!($_SESSION['type'] & 0b1)){
	die();
}
$name = str_replace(' ', '_', $_FILES['SelectedFile']['name']);
$access = 3;
$doc = $db->prepare('insert into documents (document, access, type) values (:document, :access, :type);');
$doc->bindParam(':document', $name);
$doc->bindParam(':access', $access);
$doc->bindParam(':type', $_POST['type']);
if(move_uploaded_file($_FILES['SelectedFile']['tmp_name'], '/var/www/html/33degree/documents/'.$name)){
	$success = $doc->execute();
	echo json_encode($success);
}else{
	json_encode(false);
}
