<?php  session_start();?>
<?php 
include('../config/constants.php');
include('login_check.php');

?>
<html>
<head>
	<title>foodorder</title>
	<link rel="stylesheet"  href="../css/admin.css">
</head>
<body>
	<!--menu section stert -->
	<div class="menu text-center">
		<div class="wrapper">
			<ul>
				<li><a href="index.php">Home</a> </li>
				<li><a href="manage-admin.php">Admin</a> </li>
				<li><a href="manage-category.php">Category</a> </li>
				<li><a href="manage-food.php">Food</a> </li>
				<li><a href="manage-order.php">Order</a> </li>
				<li><a href="logout.php">Logout</a> </li>
			</ul>
		</div>
		<!--menu section end -->	
</div>