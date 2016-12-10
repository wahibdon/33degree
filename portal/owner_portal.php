<style type="text/css">
	.ds_box {
		background-color: #FFF;
		border: 1px solid #000;
		position: absolute;
		z-index: 32767;
	}

	.ds_tbl {
		background-color: #FFF;
	}

	.ds_head {
		background-color: #333;
		color: #FFF;
		font-family: Arial, Helvetica, sans-serif;
		font-size: 13px;
		font-weight: bold;
		text-align: center;
		letter-spacing: 2px;
	}

	.ds_subhead {
		background-color: #CCC;
		color: #000;
		font-size: 12px;
		font-weight: bold;
		text-align: center;
		font-family: Arial, Helvetica, sans-serif;
		width: 32px;
	}

	.ds_cell {
		background-color: #EEE;
		color: #000;
		font-size: 13px;
		text-align: center;
		font-family: Arial, Helvetica, sans-serif;
		padding: 5px;
		cursor: pointer;
	}

	.ds_cell:hover {
		background-color: #F3F3F3;
	} /* This hover code won't work for IE */
</style>

<div id="portal-container" class="center">
	<h2>Screen Owner Dashboard</h2>
	<ul id="request-list">
	</ul>
	<button id="create-request">Create Promo Request</button>
	<a name="request-form"></a>
	<div id="request-form">
		<input type="hidden" id="region" value="" class="form-elem">
		<input type="text" id="name" placeholder="Name the Request" class="form-elem">
		<textarea id="description" placeholder="Description" class="form-elem"></textarea>
		<input type="text" id="duration" placeholder="Promo Duration" class="form-elem">
		<input type="text" id="due" placeholder="Due Date" class="form-elem">
		<input type="file" id="files" multiple class="form-elem">
		<button id="request-submit">Submit</button><button id="request-cancel">Cancel</button>
	</div>
</div>
<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
<tr><td id="ds_calclass">
</td></tr>
</table>
<script type="text/javascript" src="/js/cal.js"></script>
<script type="text/javascript">
	var app = new Object();
	app.requests = new Object();
	app.requests.list = [];
	app.requests.files = [];
	app.requests.dirty = false;
	setInterval(function(){
		if(app.requests.dirty){
			buildList();
		}
	}, 250);
	xhr('requests.php', function(res){
		if (res){
			app.requests.list = res[0];
			app.requests.files = res[1];
			app.requests.dirty = true;
		}
	}, 'post', (function(){var data = new FormData(); data.append('action', 'list'); return data;})());
	document.getElementById('create-request').addEventListener('click', function(e){
		e.target.style.display = "none";
		document.getElementById('request-form').style.display = "block";
		window.location.hash = "#request-form";
	});
	document.getElementById('due').addEventListener('click', function(e){ds_sh(e.target)});
	document.getElementById('request-cancel').addEventListener('click', closeForm);
	document.getElementById('request-submit').addEventListener('click', function() {
		var data = new FormData();
		data.append('action', 'create-request');
		var info =  new Object();
		info.files = [];
		var form_elems = document.getElementsByClassName('form-elem');
		for(var i=0; i<form_elems.length; i++){
			if (form_elems[i].files != null){
				for(var j=0; j<form_elems[i].files.length; j++){
					info.files.push(form_elems[i].files[j].name);
					data.append(form_elems[i].id+j, form_elems[i].files[j]);
				}
			}else{
				data.append(form_elems[i].id, form_elems[i].value);
				info[form_elems[i].id] = form_elems[i].value;
			}
		}
		console.log(data);
		xhr('requests.php', function(res){
			if (res){
				app.requests.dirty = true;
				app.requests.list.push(info);
				closeForm();
			}
		}, 'post', data);
	});
	function buildList(){
		var reqlist = document.getElementById('request-list');
		emptyNode(reqlist);
		var li, span, status;
		for(var i=0; i<app.requests.list.length; i++){
			li = document.createElement('li');
			span = document.createElement('span');
			li.dataset.info = app.requests.list[i];
			li.dataset.index = i;
			li.addEventListener('click', showMore);
			li.appendChild(document.createTextNode(app.requests.list[i].name));
			status = app.requests.list[i].status_text || "pending";
			span.appendChild(document.createTextNode(status));
			li.appendChild(span);
			reqlist.appendChild(li);
		}
		app.requests.dirty = false;
	}
	function showMore(e){
		try{
			var sm = document.getElementById('show-more');
			sm.parentNode.removeChild(sm);
		}catch(e){
			//do nothing.
		}
		var info = app.requests.list[e.target.dataset.index];
		var div = document.createElement('div');
		var p = document.createElement('p');
		var fileList = document.createElement('div');
		fileList.id = "file-list"
		div.id = "show-more";
		div.classList.add('center');
		div.appendChild(elementCreate('h2', info.name));
		div.appendChild(elementCreate('p', info.body));
		div.appendChild(elementCreate('p', 'Duration: '+info.duration, ["inline"]));
		div.appendChild(elementCreate('p', 'Status: ' +info.status_text, ["inline"]));
		div.appendChild(elementCreate('p', 'Created on: '+info.created, ["inline"]));
		div.appendChild(elementCreate('p', "Due Date: " + info.due, ["inline"]));
		document.body.insertBefore(div, document.querySelectorAll('footer')[0]);
		var list = checkFileList(info.id);
		if (list){
			for(var i = 0; i<list.length; i++){
				fileList.appendChild(elementCreate('a', list[i].url, ['block'], "/upload/"+list[i].url));
			}
			div.appendChild(fileList);
		}
		var approve = document.createElement('button');
		approve.appendChild(document.createTextNode('Approve Request'));
		approve.dataset.id = info.id;
		approve.dataset.index = e.target.dataset.index;
		approve.addEventListener('click', approveRequest);
		if (info.status == 1)
			div.appendChild(approve);
		var cancel = document.createElement('button');
		cancel.appendChild(document.createTextNode('Cancel Request'));
		cancel.dataset.reqID = info.id;
		cancel.dataset.reqIndex = e.target.dataset.index;
		cancel.addEventListener('click', removeRequest)
		div.appendChild(cancel);
	}
	function approveRequest(e){
		var id = e.target.dataset.id;
		var index = e.target.dataset.index;
		xhr('requests.php', function(res){
			if(res){
				app.requests.list[index].status_text = "complete";
				app.requests.list[index].status = "2";
				app.requests.dirty = true;
			}
		}, 'post', (function(){
			var data = new FormData();
			data.append('action', 'complete');
			data.append('id', id);
			return data;
		})())
	}
	function removeRequest (e){
		var index = e.target.dataset.reqID;
		var arrayIndex = e.target.dataset.reqIndex;
		var data = new FormData();
		data.append('action', 'delete');
		data.append('index', index);
		xhr('requests.php', function(res){
			if(res){
				app.requests.list.splice(arrayIndex, 1);
				app.requests.dirty = true;
				var sm = document.getElementById('show-more');
				sm.parentNode.removeChild(sm);
			}
		}, 'post', data);
	}
	function elementCreate(name, content, classList, href){
		var elem = document.createElement(name);
		elem.appendChild(document.createTextNode(content));
		if (classList && classList.length > 0 && typeof classList != 'string'){
			for (var i = 0; i<classList.length; i++)
				elem.classList.add(classList[i]);
		}
		if(href){
			elem.href = href;
			elem.target = "_blank";
		}
		return elem;
	}
	function checkFileList(id){
		var list = [];
		for(var i=0; i<app.requests.files.length; i++){
			if(app.requests.files[i].rid == id)
				list.push(app.requests.files[i]);
		}
		if (list.length)
			return list;
		else
			return false;
	}
	function emptyNode(node){
		while(node.lastChild)
			node.removeChild(node.lastChild);
	}
	function closeForm(){
		document.getElementById('create-request').style.display = "inline-block";
		document.getElementById('request-form').style.display = "none";
		var elems = document.getElementsByClassName('form-elem');
		for (var i=0; i<elems.length; i++){
			elems[i].value = "";
		}
		document.getElementById('ds_conclass').style.display = "none";
		window.location.hash = "";
	}
</script>