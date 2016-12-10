<?php require_once('../head.php');?>
<?php
if (!isset($_SESSION['auth']) || !$_SESSION['auth'])
	header("Location: /");

?>
<div id="portal-container" class="center">
	<h2>Main Menu</h2>
	<ul id="dashboard-nav">
		<?php if($_SESSION['type'] & 0b1){?>
			<li data-id="op-contract" class="portal-nav">Operational Contracts</li>
		<?php } ?>
		<li data-id="sales-contract" class="portal-nav">Sales Contracts</li>
		<?php if($_SESSION['type'] & 0b1){?>
		<li data-id="financial" class="portal-nav">Financial</li>
		<?php } ?>
		<li data-id="loop-schedule" class="portal-nav">Loop Schedule</li>
		<li data-id="sales-list" class="portal-nav">Sales List</li>
		<?php if($_SESSION['type'] & 0b1){?>
		<li><button id="addDoc" class="portal-nav" data-id="add-doc">Add Document</button></li>
		<?php } ?>
		<!-- <li data-id="new-order" class="portal-nav">New Order</li>
		<li data-id="home" class="portal-nav">Dashboard Home</li>
		<li data-id="history" class="portal-nav">History</li>
		<li data-id="documents" class="portal-nav">Documents</li> -->
	</ul>
<?php

if ($_SESSION['type'] & 0b1){
	require_once('admin_portal.php');
}elseif($_SESSION['type'] & 0b10){
	require_once('seller_portal.php');
}/*elseif($_SESSION['type'] & 0b10000){
	require_once('owner_portal.php');
}elseif($_SESSION['type'] & 0b100){
	require_once('advertiser_portal.php');
}elseif($_SESSION['type'] & 0b1000){
	require_once('ott_portal.php');
}*/

?>

</div>
<div id="cal-root">
	<h2 id="cal-month"></h2>
	<h2 id="cal-year"></h2>
	<table>
		<thead>
			<tr>
				<th>Sun</th><th>Mon</th><th>Tues</th><th>Weds</th><th>Thurs</th><th>Fri</th><th>Sat</th>
			</tr>
		</thead>
		<tbody id="cal-body">
		</tbody>
	</table>
	<span id="cal-prev-month">&lt;</span><span id="cal-next-month">&gt;</span>
</div>
<script type="text/javascript" src="/js/portal_scripts.js"></script>
<?php require_once('../foot.php');?>