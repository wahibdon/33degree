<?php 
session_start();
require_once('dbcon.php');
$error = "";
if(isset($_POST['submit'])){
	$stmt = $db->prepare("Select * from users where email=:email");
	$stmt->bindParam(':email', $_POST['username'], PDO::PARAM_STR);
	$stmt->execute();
	$user = $stmt->fetch(PDO::FETCH_OBJ);
	$password = hash('sha256', $user->id.$_POST['password']);

	if ($password == $user->password){
		$_SESSION['auth'] = true;
		$_SESSION['id'] = $user->id;
		$_SESSION['email'] = $user->email;
		$_SESSION['fname'] = $user->fname;
		$_SESSION['lname'] = $user->lname;
		$_SESSION['type'] = $user->type;
		$_SESSION['document'] = $user->docs;
		header('Location: /portal/');
	}else{
		$error = "<p>Username and/or password incorrect. Please contact <a href=\"mailto:info@33degreecc.com\">info@33degreecc.com</a> for assistance.</p>";
	}
}
if(isset($_GET['logout'])){
	session_destroy();
	header('Location: /');
}
?>

<?php require_once('head.php');?>
	
<div id="contact-container">
	<form id="contact" action="" method="post">
		<h2>Login</h2>
		<input type="text" name="username" placeholder="Username" />
		<input type="password" name="password" placeholder="Password" />
		<?php echo $error; ?>
		<input type="submit" class="active" name="submit" value="Submit" />
		<p>Forgot your username or password? <a href="#">Get Help</a></p>
	</form>
</div>

<?php require_once('foot.php');?>