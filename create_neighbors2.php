<?php

include("auth.php");
//include("create_neighbors.php");
require('db.php');

if($_SESSION['username'] == "sadmin")
{

	$l1_id = $_POST['l1_id'];
	$l2_id = $_POST['l2_id'];
	$neighbors_name = $_POST['neighbors_name'];

	$sql = "SELECT * FROM neighbors WHERE neighbors_name = $neighbors_name";
	$resultsql = mysqli_query($connection, $sql);

	$row = mysqli_fetch_array($resultsql);
	$nid = $row["neighbors_id"];

	
	if(mysqli_num_rows($resultsql) > 0)
	{
		$row = mysqli_fetch_array($resultsql);
		$nid = $row["neighbors_id"];
	}

	$query2 = "INSERT INTO neighbors_of(location_id, neighbors_id) VALUES ('$l1_id', '$nid')";

	$query3 = "INSERT INTO neighbors_of(location_id, neighbors_id) VALUES ('$l2_id', '$nid')";


	
	$result2 = mysqli_query($connection, $query2);
	$result3 = mysqli_query($connection, $query3);

	if($result2 && $result3)
	{
		header("Location: location.php");
	}

}

?>