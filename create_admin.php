<?php

include("auth.php");
require('db.php');

if($_SESSION['username'] == "sadmin")
{

	$username = $_POST['username'];
	$password = $_POST['password'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phone_number = $_POST['phone_number'];

	if($phone_number == '')
	{
		$phone_number = NULL;
	}

	$query = "INSERT INTO admin(username, password, fname, lname, phone_number, is_sadmin) VALUES ('$username', '$password', '$fname', '$lname', '$phone_number', 0)";
	$result = mysqli_query($connection, $query);
	if($result)
	{
		header("Location: admin.php");
	}

}

?>