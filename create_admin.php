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

    $sql = "SELECT * FROM admin WHERE username = '$username'";
    $resultsql = mysqli_query($connection, $sql);
    if(mysqli_num_rows($resultsql) > 0)
    {
        header("Location: admin.php?error=exist");
    }
    else
    {

		if($phone_number == '')
		{
			$phone_number = NULL;
		}

		$query = "INSERT INTO admin(username, password, fname, lname, phone_number, is_sadmin) VALUES ('$username', '$password', '$fname', '$lname', '$phone_number', 0)";
		$result = mysqli_query($connection, $query);
		if($result)
		{
			header("Location: admin.php");
		} else{
			echo "Fail due to : ".mysqli_error($connection);
		}

    }
}

?>
