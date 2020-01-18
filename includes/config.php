<?php 
	$localhost = "localhost";
	$username = "root";
	$password = "batwings";
	$database = "water_delivery";
	$con=mysqli_connect($localhost,$username,$password) or die('Database not connected');
	mysqli_select_db($con,$database) or die('Database not selected');



	define("APP_NAME", "Water Delivery System");
	define("COMPANY_NAME", "Al Doseri Water Delivery Company");

?>
