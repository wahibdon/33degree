<?php
try {
	$db = new PDO('mysql:host=173.194.246.201;dbname=33degree', '33degree', 'W^5.=s_2C458b:z_|--999V_*64:%=^U');
}catch(PDOException $e){
	echo $e->getMessage();
}