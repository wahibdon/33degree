	<div id="sales-contract" class="dashboard">
		<h3>Sales Contracts</h3>
	</div>
	<div id="loop-schedule" class="dashboard">
		<h3>Loop Schedule</h3>
	</div>
	<div id="sales-list" class="dashboard">
		<h3>Sales List</h3>
	</div>
<!-- 	<div id="home" class="dashboard">
		<table>
			<thead>
				<tr>
					<th>id</th><th>Order Nuumber</th><th>Running Dates</th><th>Creation Status</th>
				</tr>
			</thead>
			<tbody id="orders-list"></tbody>
		</table>
	</div>
	<div id="new-order" class="dashboard">
		<select id="client" class="order-form">
			<option value="0" class="no-hide">Select Client</option>
		</select>
		<input type="text" id="title" class="order-form">
		<select id="duration" class="order-form">
			<option value="0">Select Duration</option>
			<option value="5">5s</option>
			<option value="10">10s</option>
			<option value="15">15s</option>
			<option value="20">20s</option>
			<option value="25">25s</option>
			<option value="30">30s</option>
			<option value="35">35s</option>
			<option value="40">40s</option>
			<option value="45">45s</option>
			<option value="50">50s</option>
			<option value="55">55s</option>
			<option value="60">1m</option>
		</select>
		<input type="text" id="start_date" placeholder="Start Date" class="order-form"><span class="calendar-button" data-target="start_date">📅</span>
		<input type="text" id="end_date" placeholder="End Date" class="order-form"><span class="calendar-button" data-target="end_date">📅</span>
		<select id="region" class="order-form"><option value="0">Select Region</option></select>
		<select id="state" class="order-form"><option value="0" class="no-hide">Select State</option></select>
		<input type="checkbox" id="select-all-stores"> Select All
		<div id="store-list"></div>
		<button id="submit-order">Submit Order</button>
	</div>
	<div id="history" class="dashboard">
		<table>
			<thead>
				<tr>
					<th>id</th><th>Order Nuumber</th><th>Running Dates</th><th>Creation Status</th>
				</tr>
			</thead>
			<tbody id="historical-list"></tbody>
		</table>
	</div>
	<div id="documents" class="dashboard">
		<ul id="documents-list"></ul>
	</div> -->
	<script type="text/javascript">
		window.addEventListener('load', function(){
			// populateClients();
			// populateRegions();
			// addEventToAllOfClass(document.getElementsByClassName('calendar-button'), 'click', calPopup);
			addEventToAllOfClass(document.getElementsByClassName('portal-nav'), 'click', portalNav);
			listDocuments({2:'sales-contract-ul'});
			// listDocuments();
			// listOrders();
			// listHistoricalOrders();
		});
		// var selected_stores = {};
		// document.getElementById('submit-order').addEventListener('click', submitOrder);
		// function submitOrder(){
		// 	var elems = document.getElementsByClassName('order-form'),
		// 		checkboxes = document.getElementsByClassName('store-checkbox'),
		// 		form = {},
		// 		cb = [];
		// 	for (var i=0; i<elems.length; i++){
		// 		form[elems[i].id] = elems[i].value;
		// 	}
		// 	for (var i=0; i<checkboxes.length; i++){
		// 		if(checkboxes[i].checked)
		// 			cb.push(checkboxes[i].value);
		// 	}
		// 	form.stores = cb;
		// 	xhr('/portal/seller_api.php?call=submit-order&form='+JSON.stringify(form), resetForm);
		// }
		// function listOrders(){
		// 	xhr('/portal/seller_api.php?call=list-orders', function(res){
		// 		var tr, td, tbody = document.getElementById('orders-list');
		// 			for(var i=0; i<res.length; i++){
		// 				tr = document.createElement('tr');
		// 				td = document.createElement('td');
		// 				td.appendChild(document.createTextNode(res[i].order_number));
		// 				tr.appendChild(td);
		// 				td = document.createElement('td');
		// 				td.appendChild(document.createTextNode(res[i].order_number+" - "+res[i].title));
		// 				tr.appendChild(td);
		// 				td = document.createElement('td');
		// 				td.appendChild(document.createTextNode(res[i].start_date+" - "+res[i].end_date));
		// 				tr.appendChild(td);
		// 				td = document.createElement('td');
		// 				td.appendChild(document.createTextNode(res[i].status));
		// 				tr.appendChild(td);
		// 				tbody.appendChild(tr);
		// 			}
		// 	});
		// }
		// function listHistoricalOrders(){
		// 	xhr('/portal/seller_api.php?call=list-historical', function(res){
		// 		var tr, td, tbody = document.getElementById('historical-list');
		// 			for(var i=0; i<res.length; i++){
		// 				tr = document.createElement('tr');
		// 				td = document.createElement('td');
		// 				td.appendChild(document.createTextNode(res[i].order_number));
		// 				tr.appendChild(td);
		// 				td = document.createElement('td');
		// 				td.appendChild(document.createTextNode(res[i].order_number+" - "+res[i].title));
		// 				tr.appendChild(td);
		// 				td = document.createElement('td');
		// 				td.appendChild(document.createTextNode(res[i].start_date+" - "+res[i].end_date));
		// 				tr.appendChild(td);
		// 				td = document.createElement('td');
		// 				td.appendChild(document.createTextNode(res[i].status));
		// 				tr.appendChild(td);
		// 				tbody.appendChild(tr);
		// 			}
		// 	});
		// }
		// function resetForm(){
		// 	var form_elems = document.getElementsByClassName('order-form');
		// 	for(var i=0; i<form_elems.length; i++){
		// 		if (form_elems[i].nodeName == 'SELECT'){
		// 			form_elems[i].value = 0;
		// 		}else{
		// 			form_elems[i].value = "";
		// 		}
		// 		if(form_elems[i].id == "state")
		// 			emptyElement(document.getElementById('state'));
		// 		emptyElement(document.getElementById('store-list'));
		// 	}
		// }
		// function populateClients(){
		// 	xhr('/portal/seller_api.php?call=list-clients', function(res){
		// 		var option, select = document.getElementById('client');
		// 		for(var i=0; i<res.length; i++){
		// 			option = document.createElement('option');
		// 			option.appendChild(document.createTextNode(res[i].fname+" "+res[i].lname));
		// 			option.value = res[i].id;
		// 			select.appendChild(option);
		// 		}
		// 	});
		// }
		// document.getElementById('select-all-stores').addEventListener('change', function(e){
		// 	var boxes = document.getElementsByClassName('store-checkbox');
		// 	for(var i=0; i<boxes.length; i++){
		// 		if (e.target.checked){
		// 			boxes[i].checked = true;
		// 		}else{
		// 			boxes[i].checked = false;
		// 		}
		// 	}
		// });
		// function buildStoreList(){
		// 	var selected_stores = document.getElementById('selected-stores');
		// 	emptyElement(selected_stores);
		// 	var li, ul = document.createElement('ul');
		// 	selected_stores.appendChild(ul);
		// 	for(var i in selected_stores){
		// 		li = document.createElement('li');
		// 		li.appendChild(document.createTextNode(selected_stores[i]));
		// 		ul.appendChild(li);
		// 	}
		// }
		// function populateRegions(){
		// 	xhr('/portal/seller_api.php?call=list-regions', function(res){
		// 		var option, select = document.getElementById('region');
		// 		select.addEventListener('change', function(){
		// 			listStates();
		// 			listStores();
		// 		});
		// 		for(var i=0; i<res.length; i++){
		// 			option = document.createElement('option');
		// 			option.appendChild(document.createTextNode(res[i].name));
		// 			option.value = res[i].id;
		// 			select.appendChild(option);
		// 		}
		// 	});
		// }
		// function listStates(){
		// 	xhr('/portal/seller_api.php?call=list-states&region='+document.getElementById('region').value, function(res){
		// 		var option, select = document.getElementById('state');
		// 		select.addEventListener('change', function(){
		// 			listStores();
		// 		});
		// 		for(var i=0; i<res.length; i++){
		// 			option = document.createElement('option');
		// 			option.appendChild(document.createTextNode(res[i].state));
		// 			option.value = res[i].id;
		// 			select.appendChild(option);
		// 		}
		// 	});
		// }
		// function listStores(){
		// 	var url = '/portal/seller_api.php?call=list-stores';
		// 	if (document.getElementById('region').value == 0)
		// 		return;
		// 	url += "&region="+document.getElementById('region').value;
		// 	if (document.getElementById('state').value>0){
		// 		url += "&state="+document.getElementById('state').value;
		// 	}
		// 	xhr(url, function(res){
		// 		emptyElement(document.getElementById('store-list'));
		// 		var list = document.getElementById('store-list');
		// 		var checkbox, span;
		// 		for (var i=0; i<res.length; i++){
		// 			span = document.createElement('span');
		// 			checkbox = document.createElement('input');
		// 			checkbox.type = 'checkbox';
		// 			checkbox.value = res[i].id;
		// 			checkbox.classList.add('store-checkbox');
		// 			span.appendChild(checkbox);
		// 			span.appendChild(document.createTextNode(res[i].store_number+" - "+res[i].address));
		// 			list.appendChild(span);
		// 		}
		// 	});
		// }
	</script>