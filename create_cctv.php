<?php

include("auth.php");
require('db.php');

if($_SESSION['username'] == "sadmin")
{

	$model_name = $_POST['model_name'];
	$installation_date = $_POST['installation_date'];
	$admin_id = $_POST['id'];

	

	$query = "INSERT INTO cctv(model_name, installation_date, admin_id) VALUES ('$model_name', '$installation_date', '$admin_id')";
	$result = mysqli_query($connection, $query);
	if($result)
	{
		header("Location: cctv.php");
	}

}
		

?>