<?php

session_start();
require_once('../dbcon.php');
if(!isset($_SESSION['auth']))
	die();
/*if(!($_SESSION['type'] & 0b10)){
	die();
}*/
if (in_array($_GET['type'], [1,2,3])) {
	$doc = $db->prepare('select * from documents left join user_doc on documents.id = user_doc.doc_id where (access&:doc or user_id=:uid) and type=:type');
	$doc->bindParam(':doc', $_SESSION['document']);
	$doc->bindParam(':uid', $_SESSION['id']);
	$doc->bindParam(':type', $_GET['type']);
	$doc->execute();
	echo json_encode($doc->fetchAll(PDO::FETCH_OBJ));
}