function portalNav(e){
	var pages = document.getElementsByClassName('dashboard');
	for(var i=0; i<pages.length; i++){
		pages[i].style.display = "none";
	}
	document.getElementById(e.target.dataset.id).style.display = "block";
}
function listDocuments(docsObj){
	for (var key in docsObj){
		xhr('/portal/listDocuments.php?type='+key, function(res){
			var li, a, ul
			for(var i=0; i<res.length; i++){
				ul = document.getElementById(docsObj[res[i].type]);
				li = document.createElement('li');
				a = document.createElement('a');
				a.appendChild(document.createTextNode(res[i].document));
				a.href = "/portal/fetchdocs.php?doc_id="+res[i].id;
				li.appendChild(a);
				ul.appendChild(li);
			}
		});
	}
}