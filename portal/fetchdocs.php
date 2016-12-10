<?php

session_start();
require_once('../dbcon.php');
if(!isset($_SESSION['auth']))
	die();
/*if(!($_SESSION['type'] & 0b10)){
	die();
}*/
$stmt = $db->prepare('select document from documents left join user_doc on documents.id = user_doc.doc_id where documents.id=:doc_id and (access&:doc or user_id=:uid)');
$stmt->bindParam(':doc', $_SESSION['document']);
$stmt->bindParam(':uid', $_SESSION['id']);
$stmt->bindParam(':doc_id', $_GET['doc_id']);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_OBJ);
$file = "/var/www/html/33degree/documents/".$results[0]->document;
//print_r($file);
print_r(file_exists("garbage"));
if(file_exists($file)){
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="'.basename($file).'"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	header('Content-Length: ' . filesize($file));
	readfile($file);
}