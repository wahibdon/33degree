<?php
	@session_start();
	if(!isset($logo_id)){
		$logo_id = "";
		$logo_image = "/images/logo.gif";
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>33 Degree</title>
	<meta name="description" content="33 Degrees is a full service provider of digital out of home networks that reach customers in high traffic areas around the world. With one of our national clients alone, we will implement over 108 million impressions a month. Our mission is to not only increase sales and customer experience but to also strengthen brand loyalty." />
	<link rel="stylesheet" type="text/css" href="/css/styles.css">
	<link rel="icon" href="/favicon.png">
</head>
<body>
<header>
	<div class="center graybg">
		<div id="mobile">
			<img id="menu-icon" src="/images/menu.gif" alt="click here to open the menu" />
		</div>
		<?php 
		if (strpos($_SERVER['PHP_SELF'], "portal") === false){
		?>
		<ul id="desktop">
			<li><a data-link="about" class="desktop-menu" href="/about.php">About</a></li>
			<li><a data-link="leadership" class="desktop-menu" href="/about.php#leadership">Leadership</a></li>
			<li><a data-link="case-studies" class="desktop-menu" href="/case-studies.php">Case Studies</a></li>
			<li><a data-link="clients" class="desktop-menu" href="/case-studies.php#clients">Clients</a></li>
			<li><a data-link="partners" class="desktop-menu" href="/case-studies.php#partners">Partners</a></li>
			<!--<li><a data-link="jobs" class="desktop-menu" href="/jobs.php">Jobs</a></li>-->
			<li><a data-link="contact" class="desktop-menu" href="/contact.php">Contact</a></li>
			<?php 
			if (isset($_SESSION['auth']) && $_SESSION['auth']){
				echo "<li><a href=\"/portal/\">Dashboard</a></li>";
				echo "<li><a href=\"/login.php?logout\">Logout</a></li>" ;
			}else
				echo "<li><a href=\"/login.php\">Login</a></li>"; ?>
		</ul>
		<?php }else{ ?>
		<ul id="desktop">
			<li><a href=\"/login.php?logout\">Logout</a></li>
		</ul>
		<?php } ?>
		<h1<?php echo $logo_id;?>>
			<a href="/">
				<img src="<?php echo $logo_image;?>" alt="33 degree logo" />
			</a>
		</h1>

	</div>
</header>
<nav id="menu_takeover">
	<div class="center">
		<ul>
			<li><a class="menu" href="/">Home</a></li>
			<li><a class="menu" href="/about.php">About</a></li>
			<li><a class="menu" href="/about.php#leadership">Leadership</a></li>
			<li><a class="menu" href="/case-studies.php">Case Studies</a></li>
			<li><a class="menu" href="/case-studies.php#clients">Clients</a></li>
			<li><a class="menu" href="/case-studies.php#partners">Partner</a></li>
			<!--<li><a class="menu" href="/jobs.php">Jobs</a></li>-->
			<li><a class="menu" href="/contact.php">Contact</a></li>
		</ul>
		<div>
			<h2>Log In:</h2>
			<input type="text" name="username" placeholder="Username" />
			<input type="password" name="password" placeholder="Password" />
			<button id="login-button">Login</button> <a href="">Forgot password?</a>
			<p id="login-error">Login infromation incorrect.  Please email <a href="mailto:info@33degreecc.com">info@33degreecc.com</a> for assistance</p>
		</div>
	</div>
</nav>