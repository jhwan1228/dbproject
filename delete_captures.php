<?php

include("auth.php");
require('db.php');

$qty = $_POST['qty'];
$cid = $_POST['cid'];
$lid = 0;

for($i = 1; $i < $qty + 100; $i++)
{
	$chosen_check2 = 'd' . "$i";
	$test2 = $_POST["$chosen_check2"];
	if($test2 == 9)
	{
		$lid = $i;
	}
}

//echo $lid;
//echo " " . $cid;

$query = "DELETE FROM captures WHERE cctv_id = $cid AND location_id = $lid";
$result2 = mysqli_query($connection, $query);
if($result2)
{
	//echo " in ";
	header("Location: cctv.php");
}
else
{
	die("Unable to delete " . mysqli_error($result2));
}
mysqli_close($connection);


?>