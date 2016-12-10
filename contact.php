<?php if(isset($_POST['submit'])){
	//$db = new PDO()
		//echo "insert into ";
	} ?>

<?php require_once('head.php');?>

<div id="contact-head" class="center">
	<h2>Contact Us</h2>
	<p>
		<a href="tel:+18886480531">(888) 648-0531</a><br />
		<a href="mailto:info@33degreecc.com">info@33degreecc.com</a>
	</p>
	<p class="contact-float">
		13100 Magisterial Drive, Suite 102<br />
		Louisville, KY 40223<br />
		<a href="https://www.google.com/maps/place/13100+Magisterial+Dr+%23202,+Louisville,+KY+40223/">Get Directions</a>
	</p>
	<p class="contact-float">
		80 Orville Drive, Suite 245<br />
		Bohemia, NY 11716<br />
		<a href="https://www.google.com/maps/place/80+Orville+Dr+%23245,+Bohemia,+NY+11716/">Get Directions</a>
	</p>
</div>
<div id="contact-container" class="bluebg">
	<h2>Leave Us A Message</h2>
	<form id="contact" method="post">
		<input class="form-elem" type="text" name="name" placeholder="Name" required />
		<input class="form-elem" type="email" name="email" placeholder="E-mail Address" required />
		<input class="form-elem" type="text" name="subject" placeholder="Subject" required />
		<textarea class="form-elem" maxlength="5000000" name="message" placeholder="Your Message" required></textarea>
		<input type="submit" name="submit" value="Submit" id="submit" disabled/>
	</form>
</div>

<script type="text/javascript">
	var form_elems = document.querySelectorAll('.form-elem'), i;
	for (i=0; i<form_elems.length; i++){
		form_elems[i].addEventListener('keyup', function(){
			var form = document.getElementById('contact');
				var submit_button = document.getElementById('submit');
			if (form.checkValidity()){
				submit_button.disabled = false;
				submit_button.classList.add('active');
			}else{
				submit_button.disabled = true;
				submit_button.classList.remove('active');
			}
		});
	}
</script>

<?php require_once('foot.php');?>