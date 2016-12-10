<?php require_once('head.php');?>

<img id="full-bleed" src="images/h-m-banner-dark.jpg" />

<div class="center text-center">
	<div class="about-top">
		<h2>About</h2>
		<p>33 Degrees is a full service provider of digital out of home networks that reach customers in high traffic areas around the world. With one of our national clients alone, we will implement over 108 million impressions a month. Our mission is to not only increase sales and customer experience but to also strengthen brand loyalty.</p>
	</div>
	<div class="about-top">
		<h2>History</h2>
		<p>With offices in Louisville, Kentucky and New York City, 33 Degrees is led by a team with years of experience working with internationally recognized brands. 33 Degrees has been involved in digital media since the beginning of the technology era.</p>
	</div>
	<div class="about-top">
		<h2>Experience</h2>
		<p>33 Degrees management team has experience working with some of the largest digital out-of-home networks in the world. We have the ability to interface with companies marketing strategies and transform them into a successful campaign, tailored for digital billboards. There are 7.125 billion people in the world &mdash; our digital out of home network connects people everywhere.</p>
	</div>
</div>
<div class="center">
	<video id="circle-k-vid" controls>
		<source src="/video/33D_Promo_Video_Karnady_v2.mp4" type="video/mp4" />
	</video>
</p>
</div>
<div class="love center">
	Interested in working with us? We’re listening. <a href="/contact.php">Contact Us</a>
</div>
<hr>
<div class="graybg" id="people">
	<div class="center">
		<a name="leadership"></a>
		<h2>Leadership</h2>
		<div class="person active" data-bio="cott">
			Chris Ott
			<div id="arrow" class="arrow-up"></div>
		</div>
		<div class="person" data-bio="rmills">
			Rick Mills
		</div>
		<div class="person" data-bio="dmiller">
			David Miller
		</div>
	</div>
</div>
<div class="center">
	<div id="cott" class="bio active">
		<p><a href="mailto:cott@33degreecc.com">cott@33degreecc.com</a></p>
		<p>As principle of OTT Communications in 1970, Chris has grown a Kentucky advertising and marketing agency from $1.5 million in billing to over $70 million in billing today. During his tenure, OTT has acquired national and global clients and projects that have resulted in global attention today. OTT is recognized as a top 50 promotional agencies nationally, one of the top 500 advertising agencies, and one of the top 10 agencies in the state of Kentucky. Chris has earned a spotlight in Ad Week, Brand Week, Promotions Marketing Worldwide, Biz Journal’s &ldquo;40 Under 40&rdquo; and &ldquo;50 Fastest Growing Companies&rdquo;. His account experience includes Chiquita, Lens Crafters, Proctor &amp; Gamble, Maker’s Mark, LexMark, Hiram Walker Liquors, Busch Brothers, General Electric, American Express, Flowers Food and Circle K.</p>
	</div>
</div>
<div class="center">
	<div id="rmills" class="bio">
		<p><a href="mailto:rmills@33degreecc.com">rmills@33degreecc.com</a></p>
		<p>Richard Mills has served as President and CEO of ConeXus World since founding it in 2010. With more than 25 years of leadership experience, guiding top-tier technology companies, Richard is an accomplished corporate strategist and turnaround executive. His vision and expertise in business performance have driven notable enterprise growth in the technology, service, and telecommunications sectors. Richard’s achievements have been featured in Inc. magazine as well as other media publications. Currently, Richard’s focus is helping global clients improve the implementation of technology solutions in all regions of the world. In addition, ConeXus World is the only digital signage integration company with a global footprint.</p>
	</div>
</div>
<div class="center">
	<div id="dmiller" class="bio">
		<p><a href="mailto:dmiller@33degreecc.com">dmiller@33degreecc.com</a></p>
		<p>David Miller has served as President of MPG Media Services, formerly Miller Print Group, since he founded the company in 1991. His impressive career in the out-of-home industry began in 1989 as a Sales Executive at Naegele Outdoor, which is now Outfront Media. He also spent time as the Sales Manager at Lamar Outdoor Advertising prior to founding MPG. In 2008 David utilized his relationships and vast knowledge of the outdoor industry to transform Miller Print Group in to a full service out-of-home media buying agency. David thoroughly enjoys working alongside each and every one of his clients, and he is always focused on finding new and effective ways to utilize out-of-home to develop their brands.</p>
	</div>
</div>

<script type="text/javascript">
var people = document.querySelectorAll(".person"), i;
for(i=0; i<people.length; i++){
	people[i].addEventListener('click', function(e){
		var bio = e.target.dataset.bio, j, arrow = document.getElementById('arrow');
		var bios = document.querySelectorAll('.bio');
		for (j=0; j<bios.length; j++){
			bios[j].classList.remove("active");
			people[j].classList.remove("active");
		}
		e.target.classList.add("active");
		document.getElementById(bio).classList.add("active");
		//arrow.parentNode.removeChild(arrow);
		e.target.appendChild(arrow);
	})
}
</script>

<?php require_once('foot.php');?>