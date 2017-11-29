<?php

include("auth.php");
require('db.php');

$neighbors_id = $_POST['neighbors_id'];
$neighbors_name = $_POST['neighbors_name'];
$l1id = $_POST['l1id'];
$l2id = $_POST['l2id'];
$l1_id = $_POST['l1_id'];
$l2_id = $_POST['l2_id'];


$query1 = "UPDATE neighbors SET neighbors_name = '$neighbors_name' WHERE neighbors_id = $neighbors_id";

$query2 = "UPDATE neighbors_of SET location_id = '$l1_id' WHERE neighbors_id = $neighbors_id AND location_id = '$l1id'";

$query3 = "UPDATE neighbors_of SET location_id = '$l2_id' WHERE neighbors_id = $neighbors_id AND location_id = '$l2id'";

$result = mysqli_query($connection, $query1);
$result2 = mysqli_query($connection, $query2);
$result3 = mysqli_query($connection, $query3);

if($result && $result2 && $result3)
{
	header("Location: location.php");
}


?>