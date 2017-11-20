<?php

include("auth.php");
require('db.php');

$cctv_id = $_POST['cctv_id'];
$location_id = $_POST['location_id'];
	

$query = "INSERT INTO captures(cctv_id, location_id) VALUES ('$cctv_id', '$location_id')";
$result = mysqli_query($connection, $query);
if($result)
{
	header("Location: location.php");
}
		

?>