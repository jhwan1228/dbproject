<?php

include("auth.php");
require('db.php');

if($_SESSION['username'] == "sadmin")
{
	$id = $_POST['id'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phone_number = $_POST['phone_number'];


	$query = "UPDATE admin SET username = '$username', password = '$password', fname = '$fname', lname = '$lname', phone_number = '$phone_number' WHERE id = $id";
	$result = mysqli_query($connection, $query);
	if($result)
	{
		header("Location: admin.php");
	}

}

?>