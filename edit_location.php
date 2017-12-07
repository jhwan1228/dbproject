<?php

include("auth.php");
require('db.php');

//if($_SESSION['username'] == "sadmin")
//{
	$city = $_POST['city'];
	$province = $_POST['province'];
	$bld_name = $_POST['bld_name'];
	$floor_number = $_POST['floor_number'];
	$details= $_POST['details'];
	$location_id = $_POST['location_id'];


	$query = "UPDATE location SET city = '$city', province = '$province', bld_name = '$bld_name', floor_number = '$floor_number', details = '$details' WHERE location_id = $location_id";
	$result = mysqli_query($connection, $query);
	if($result)
	{
		header("Location: location.php");
	}

//}



?>