<?php

include("auth.php");
require('db.php');

$total = $_POST['qty'];
$i = 1;


for($i = 1; $i < $total + 1; $i++)
{
	$value = 's' . "$i";
	$neigh = $_POST[$value];
	$neighbors_list = $neighbors_list . "-" . $neigh;
}







$query = "INSERT INTO sequence(neighbors_list) VALUES ('$neighbors_list')";
$result = mysqli_query($connection, $query);
if($result)
{
	header("Location: location.php");
}


?>