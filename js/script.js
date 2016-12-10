var url = window.location.pathname;
var filename = url.substring(url.lastIndexOf('/')+1);
if (filename == "index.php")
	filename = "";
var menuItems = document.querySelectorAll(".menu");
for(var i = 0; i<menuItems.length; i++){
	if (menuItems[i].href.substring(menuItems[i].href.lastIndexOf('/')+1) == filename )
		menuItems[i].parentNode.className = "active";
}
var menuIcon = document.getElementById('menu-icon').addEventListener('click', function(){
	this.src = (this.src.substring(this.src.lastIndexOf('/')+1) == "menu.gif") ? "images/close-menu.gif" : "images/menu.gif";
	var menuTakeover = document.getElementById('menu_takeover');
	menuTakeover.style.display = menuTakeover.style.display == "block" ? "none" : "block";
	document.body.style.overflow = document.body.style.overflow == "hidden" ? "visible" : "hidden";
	document.body.style.backgroundColor = document.body.style.backgroundColor == "rgb(242, 242, 242)" ? "#fff" : "#f2f2f2";
});
document.getElementById('login-button').addEventListener('click', function(){
	document.getElementById('login-error').style.display = "block";
});

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
var desktopMenuLinks = document.getElementsByClassName('desktop-menu');
var file = window.location.pathname.substring(1).split('.')[0];
if (window.location.hash.substring(0,1) == "#"){
	file = window.location.hash.substring(1);
}
for (var i=0; i<desktopMenuLinks.length; i++){
	if(desktopMenuLinks[i].dataset.link == file){
		desktopMenuLinks[i].classList.add("active");
		break;
	}
}
function xhr(url, callback, type, params, headers) {
	type = type || "get";
	var xhr = new XMLHttpRequest();
	xhr.open(type, url);
	xhr.onreadystatechange = function(){
		if(this.readyState == 4 && this.status == 200){
			callback(JSON.parse(this.responseText));
		}
	}
	xhr.send(params);
}
function emptyElement(element){
	if(element instanceof HTMLElement)
		element = [element];
	var child, reserve;
	for(list in element){
		reserve = [];
		while (element[list].lastChild){
			try{
				child = element[list].lastChild.classList.contains('no-hide');
				if (child){
					reserve.push(element[list].lastChild);
				}
				element[list].removeChild(element[list].lastChild);
				child = false;
			}catch(e){
				element[list].removeChild(element[list].lastChild);
			}
		}
		for (e in reserve)
			element[list].appendChild(reserve[e]);
	}
}

function addEventToAllOfClass(collection, event_type, callback){
	for(var i=0; i<collection.length; i++){
		collection[i].addEventListener(event_type, callback);
	}
}

// var day1 = new Date();
//buildCalendar(buildMonthArray(day1));
if(document.getElementById('cal-prev-month')){
	document.getElementById('cal-prev-month').addEventListener('click', function(){
		var root = document.getElementById('cal-root');
		buildCalendar(buildMonthArray(new Date(root.dataset.year, parseInt(root.dataset.month)-1, 1)));
	});
	document.getElementById('cal-next-month').addEventListener('click', function(){
		var root = document.getElementById('cal-root');
		buildCalendar(buildMonthArray(new Date(root.dataset.year, parseInt(root.dataset.month)+1, 1)));
	});
}
function buildMonthArray(dateObject){
	var	year = dateObject.getFullYear();
	var month = dateObject.getMonth();
	var rows = [];
	var row_index = 0
	rows[0] = [];
	dateObject.setDate(1);
	var offset = dateObject.getDay();
	while (dateObject.getMonth() == month){
		rows[row_index][offset] = dateObject.getDate();
		dateObject.setDate(dateObject.getDate()+1);
		offset++;
		if(offset == 7){
			row_index++;
			rows[row_index] = [];
			offset = 0;
		}
	}
	return {
		'year': year,
		'month': month,
		'cal': rows
	}
}
function buildCalendar(monthOject){
	var cal = monthOject.cal;
	var row;
	var td;
	var root = document.getElementById('cal-root');
	var year = document.getElementById('cal-year');
	emptyElement(year);
	year.appendChild(document.createTextNode(monthOject.year));
	var month = document.getElementById('cal-month');
	emptyElement(month);
	month.appendChild(document.createTextNode(monthOject.month+1));
	var month = monthOject.month;
	root.dataset.month = monthOject.month;
	root.dataset.year = monthOject.year;
	var tbody = document.getElementById('cal-body');
	emptyElement(tbody);
	for(var i = 0; i<cal.length; i++){
		row = document.createElement('tr');
		for(var j = 0; j<7; j++){
			td = document.createElement('td');
			if(cal[i][j] != undefined){
				td.appendChild(document.createTextNode(cal[i][j]));
				td.date = {year: monthOject.year, month: monthOject.month, day: cal[i][j]}
				td.addEventListener('click', function(e){
					var dateString = e.target.date.year+"-"+(e.target.date.month+1)+"-"+e.target.date.day;
					window.cal_target.value = dateString;
					calPopup();
				})
			}
			row.appendChild(td);
		}
		tbody.appendChild(row);
	}
}
function calPopup(e){
	var root = document.getElementById('cal-root');
	if(root.style.display == "block"){
		document.getElementById('cal-root').style.display = "none";
		window.cal_target = null;
		return;
	}else{
		var bodyRect = document.body.getBoundingClientRect(),
			target = document.getElementById(e.target.dataset.target);
			elemRect = target.getBoundingClientRect(),
			offsetTop   = elemRect.top - bodyRect.top,
			offsetLeft  = elemRect.left- bodyRect.left;
		window.cal_target = target;
		setTimeout(function(root){root.style.display = "block";}, 101, root);
		root.style.left = offsetLeft+"px";
		root.style.top = offsetTop+target.clientHeight+"px";
		buildCalendar(buildMonthArray(new Date()));
	}
}