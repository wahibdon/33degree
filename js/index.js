if(getCookie('played') != 'yes'){
	var date = new Date();
	date.setHours(date.getHours()+5);
	document.cookie = "played=yes; expires="+date;
}else{
	document.getElementById('intro').style.display = "none";
}
document.body.onload = function(){
	setTimeout(function(){
		document.getElementById('intro').style.opacity = "0";
		document.getElementById('intro').style.visibility = "hidden";
		document.getElementById('home-vid').play();
	}, 2500);
}