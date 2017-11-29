<?php

include("auth.php");
require('db.php');


$city = $_POST['city'];
$province = $_POST['province'];
$bld_name = $_POST['bld_name'];
$floor_number = $_POST['floor_number'];
$details = $_POST['details'];

if($city == '')
{
	$city = NULL;
}

if($province == '')
{
	$province = NULL;
}

if($bld_name == '')
{
	$bld_name = NULL;
}



if($floor_number == '')
{
	$floor_number = NULL;
}

if($details == '')
{
	$details = NULL;
}

$query = "INSERT INTO location(city, province, bld_name, floor_number, details) VALUES ('$city', '$province', '$bld_name','$floor_number', '$details')";
$result = mysqli_query($connection, $query);
if($result)
{
	header("Location: location.php");
}


?>