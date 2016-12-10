	<div id="op-contract" class="dashboard">
		<h3>Operational Contracts</h3>
		<ul id="op-contract-ul"></ul>
	</div>
	<div id="sales-contract" class="dashboard">
		<h3>Sales Contracts</h3>
		<ul id="sales-contract-ul"></ul>
	</div>
	<div id="financial" class="dashboard">
		<h3>Financial</h3>
		<ul id="financial-ul"></ul>
	</div>
	<div id="loop-schedule" class="dashboard">
		<h3>Loop Schedule</h3>
	</div>
	<div id="sales-list" class="dashboard">
		<h3>Sales List</h3>
	</div>
	<div id="add-doc" class="dashboard">
		<h3>Add Document</h3>
		<div>
			<input type="file" id="doc-file">
			<select id="doc-type">
				<option value="0">Select Documnet Type</option>
				<option value="1">Operational Contracts</option>
				<option value="2">Sales Contracts</option>
				<option value="3">Financial</option>
			</select>
			<button id="submit-doc">Submit Document</button>
		</div>
	</div>
<!-- 	<ul id="users-list">
	</ul>
	<button id="create-user">Create User</button>
	<a name="user-form"></a>
	<div id="user-form">
		<h2>Create New User</h2>
		<input type="hidden" id="id" value="" class="user-form">
		<input type="hidden" id="edit" value="" class="user-form">
		<input id="fname" type="text" placeholder="First Name" class="user-form">
		<input id="lname" type="text" placeholder="Last Name" class="user-form">
		<input id="email" type="email" placeholder="Email Address" class="user-form">
		<select id="type" class="user-form">
			<option value="1">Admin</option>
			<option value="16" selected>Reseller</option>
			<option value="2">Screen Owner</option>
			<option value="4">Advertiser</option>
			<option value="8">Ott User</option>
		</select>
		<select id="docs" class="user-form">
			<option value="0">None</option>
			<option value="1">Admin</option>
			<option value="2" selected>Sellers</option>
		</select>
		<button id="submit-user">Submit</button><button id="cancel-user">Cancel</button>
	</div>
 -->
	<script type="text/javascript">
		var user_list = new FormData();
		window.users = document.getElementsByClassName('users');
		user_list.append('action', 'list-users');
		window.addEventListener('load', function(){
			addEventToAllOfClass(document.getElementsByClassName('portal-nav'), 'click', portalNav);
			listDocuments({1:'op-contract-ul', 2:'sales-contract-ul', 3:'financial-ul'});
			document.getElementById('submit-doc').addEventListener('click', function (){
				var file=document.getElementById('doc-file');
				var type=document.getElementById('doc-type');
				if (file.files.length < 1 || type.value == 0)
					return;
				var data=new FormData();
				data.append("SelectedFile", file.files[0]);
				data.append("type", type.value);
				var request = new XMLHttpRequest();
				request.onreadystatechange = function(response){
					if(request.readyState == 4){
						//flear files
						type.value = 0;
						console.log(JSON.parse(this.responseText));
					}
				}
				request.open('post', '/portal/addDocument.php');
				request.send(data);
			});
		});

		function xhr(url, callback, type, params) {
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

		//xhr('user_administration.php', buildUsersList, 'post', user_list);
		/*document.getElementById('type').addEventListener('change', function(e){
			if(e.target.value == 2){
				getCompanies();
			}else{destroyCompanies();}
		})
		function destroyCompanies(){
			var user_form = document.getElementById('user-form');
			try{
				user_form.removeChild(document.getElementById('companies'));
				user_form.removeChild(document.getElementById('region'));
			}catch(e){

			}
		}
		function getCompanies(cid, rid){
			index = cid || -1;
			rid = rid || -1;
			xhr('getCompanies.php', function(response){
				var select = document.createElement('select');
				select.id = "companies";
				select.addEventListener('change', function(){
					getRegions(this.value, rid);
				})
				var option = document.createElement('option');
				select.appendChild(option);
				option.appendChild(document.createTextNode('Select Company'));
				option.value = 0;
				for (var i = 0; i < response.length; i++) {
					option = document.createElement('option');
					option.value = response[i].id;
					if (index == option.value){
						option.selected = true;
						getRegions(index, rid);
					}
					option.appendChild(document.createTextNode(response[i].name));
					select.appendChild(option);
				}
				document.getElementById('user-form').insertBefore(select, document.getElementById('submit-user'));
			});
		}

		function getRegions(cid, rid){
			rid = rid || -1
			var data = new FormData();
			data.append('cid', cid);
			xhr('getRegions.php', function(response){
				var select = document.createElement('select');
				select.id = "region";
				select.classList.add('user-form');
				var option = document.createElement('option');
				select.appendChild(option);
				option.appendChild(document.createTextNode('Select Region/Location'));
				option.value = 0;
				for (var i = 0; i < response.length; i++) {
					option = document.createElement('option');
					option.value = response[i].id;
					if (rid == option.value)
						option.selected = true;
					option.appendChild(document.createTextNode(response[i].name));
					select.appendChild(option);
				}
				document.getElementById('user-form').insertBefore(select, document.getElementById('submit-user'));
			}, 'post', data);
		}*/

		// function buildUsersList(response){
		// 	var li, span;
		// 	var ul = document.getElementById('users-list');
		// 	for(var i=0; i<response.length; i++){
		// 		li = document.createElement('li');
		// 		createItem(response[i], ul, li);
		// 	}
		// }
		// setInterval(function(){
		// 	for(var i=0; i<window.users.length; i++){
		// 		if (window.users[i].info.dirty){
		// 			emptyNode(window.users[i]);
		// 			createItem(window.users[i].info, document.getElementById('users-list'), window.users[i]);
		// 			window.users[i].info.dirty = false;
		// 		}
		// 	}
		// }, 250);
		// function emptyNode(node){
		// 	while(node.lastChild)
		// 		node.removeChild(node.lastChild);
		// }
		// function createItem(info, ul, li){
		// 	var edit_button, delete_button;
		// 	edit_button = document.createElement('a');
		// 	delete_button = document.createElement('a');
		// 	edit_button.appendChild(document.createTextNode('edit'));
		// 	edit_button.addEventListener('click', editUser);
		// 	delete_button.appendChild(document.createTextNode('delete'));
		// 	delete_button.addEventListener('click', deleteUser);
		// 	li.info = info;
		// 	li.info.dirty = false;
		// 	span = document.createElement('span');
		// 	span.appendChild(document.createTextNode(li.info.email));
		// 	li.appendChild(document.createTextNode(li.info.fname+" "+li.info.lname));
		// 	li.appendChild(span);
		// 	li.classList.add('users')
		// 	li.appendChild(delete_button);
		// 	li.appendChild(edit_button);
		// 	ul.appendChild(li);
		// }
		// function editUser(e){
		// 	var info = e.target.parentNode.info;
		// 	document.getElementById('edit').value = true;
		// 	for(var piece in info){
		// 		if(piece == "dirty" || !info[piece] || piece == 'rid')
		// 			continue;
		// 		/*if(piece == 'cid'){
		// 			getCompanies(info['cid'], info['rid']);
		// 			continue;
		// 		}*/
		// 		document.getElementById(piece).value = info[piece];
		// 	}
		// 	document.getElementById('create-user').style.display = "none";
		// 	document.getElementById('user-form').style.display = "block";
		// 	window.location.hash = "#user-form";
		// }

		// function deleteUser(e){
		// 	var del = confirm("Delete user "+e.target.parentNode.info.fname+" "+e.target.parentNode.info.lname+"?");
		// 	if (del){
		// 		var id = e.target.parentNode.info.id;
		// 		var data = new FormData();
		// 		data.append('action', "delete-user");
		// 		data.append('id', id);
		// 		xhr('user_administration.php', function(res){
		// 			if(res)
		// 				e.target.parentNode.parentNode.removeChild(e.target.parentNode);
		// 		}, 'post', data);
		// 	}
		// }

		// document.getElementById('create-user').addEventListener('click', function(e){
		// 	var params = new FormData();
		// 	var id;
		// 	params.append('action', 'prep-user');
		// 	xhr('user_administration.php', function(res){
		// 		document.getElementById('id').value = res;
		// 		e.target.style.display = "none";
		// 		document.getElementById('user-form').style.display = "block";
		// 		// getCompanies();
		// 	}, 'post', params);
		// });

		// document.getElementById('submit-user').addEventListener('click', function(){
		// 	var data = new FormData();
		// 	var info = new Object();
		// 	var update = document.getElementById('edit').value;
		// 	data.append('action', 'create-user');
		// 	if(update)
		// 		data.append('update', true);
		// 	var elems = document.getElementsByClassName('user-form');
		// 	for (var i=0; i<elems.length; i++){
		// 		if(elems[i].id == 'edit')
		// 			continue;
		// 		data.append(elems[i].id, elems[i].value);
		// 		info[elems[i].id] = elems[i].value;
		// 	}
		// 	xhr('user_administration.php', function(res){
		// 		if(res){
		// 			if(!update)
		// 				buildUsersList([info]);
		// 			else{
		// 				var id = document.getElementById('id').value;
		// 				for(var i=0; i<window.users.length; i++){
		// 					if (window.users[i].info.id == id){
		// 						window.users[i].info = info;
		// 						window.users[i].info.dirty = true;
		// 					}
		// 				}
		// 			}
		// 			closeForm();
		// 		}
		// 	}, 'post', data)
		// })

		// document.getElementById('cancel-user').addEventListener('click', closeForm);

		// function closeForm(){
		// 	document.getElementById('create-user').style.display = "inline-block";
		// 	document.getElementById('user-form').style.display = "none";
		// 	var elems = document.getElementsByClassName('user-form');
		// 	for (var i=0; i<elems.length; i++){
		// 		if(elems[i].tagName == "SELECT")
		// 			elems[i].value = 2;
		// 		else
		// 			elems[i].value = "";
		// 	}

		// 	window.location.hash = "";
		// 	// destroyCompanies();
		// }

	</script>
