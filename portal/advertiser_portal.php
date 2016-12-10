<div id="portal-container" class="center">
	<h2>Advertiser Dashboard</h2>
	<ul id="dashboard-nav">
		<li data-id="home" class="portal-nav">Dashboard Home</li>
		<li data-id="history" class="portal-nav">History</li>
		<li data-id="documents" class="portal-nav">Documents</li>
	</ul>
	<div id="home" class="dashboard">
		<table>
			<thead>
				<tr>
					<th>id</th><th>Order Nuumber</th><th>Running Dates</th><th>Creation Status</th>
				</tr>
			</thead>
			<tbody id="orders-list"></tbody>
		</table>
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
	</div>
</div>
	
</div>
<script type="text/javascript" src="/js/portal_scripts.js"></script>
<script type="text/javascript">
	window.addEventListener('load', function(){
		addEventToAllOfClass(document.getElementsByClassName('portal-nav'), 'click', portalNav);
		listDocuments();
		listOrders();
		listHistoricalOrders();
	});
	function listOrders(){
		xhr('/portal/advertiser_api.php?call=list-orders', function(res){
			var tr, td, tbody = document.getElementById('orders-list');
				for(var i=0; i<res.length; i++){
					tr = document.createElement('tr');
					td = document.createElement('td');
					td.appendChild(document.createTextNode(res[i].order_number));
					tr.appendChild(td);
					td = document.createElement('td');
					td.appendChild(document.createTextNode(res[i].order_number+" - "+res[i].title));
					tr.appendChild(td);
					td = document.createElement('td');
					td.appendChild(document.createTextNode(res[i].start_date+" - "+res[i].end_date));
					tr.appendChild(td);
					td = document.createElement('td');
					td.appendChild(document.createTextNode(res[i].status));
					tr.appendChild(td);
					tbody.appendChild(tr);
				}
		});
	}
	function listHistoricalOrders(){
		xhr('/portal/advertiser_api.php?call=list-historical', function(res){
			var tr, td, tbody = document.getElementById('historical-list');
				for(var i=0; i<res.length; i++){
					tr = document.createElement('tr');
					td = document.createElement('td');
					td.appendChild(document.createTextNode(res[i].order_number));
					tr.appendChild(td);
					td = document.createElement('td');
					td.appendChild(document.createTextNode(res[i].order_number+" - "+res[i].title));
					tr.appendChild(td);
					td = document.createElement('td');
					td.appendChild(document.createTextNode(res[i].start_date+" - "+res[i].end_date));
					tr.appendChild(td);
					td = document.createElement('td');
					td.appendChild(document.createTextNode(res[i].status));
					tr.appendChild(td);
					tbody.appendChild(tr);
				}
		});
	}
</script>
