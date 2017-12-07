<?php

include("auth.php");
require('db.php');

if($_SESSION['username'] == "sadmin")
{

	$model_name = $_POST['model_name'];
	$before_installation_date = $_POST['installation_date'];
	$admin_id = $_POST['id'];

	$installation_date_array = explode("-", $before_installation_date);
	$installation_date = $installation_date_array[0] . $installation_date_array[1] . $installation_date_array[2]; 

	

	$query = "INSERT INTO cctv(model_name, installation_date, admin_id) VALUES ('$model_name', '$installation_date', '$admin_id')";
	$result = mysqli_query($connection, $query);
	if($result)
	{
		header("Location: cctv.php");
	}

}
?>