<?php

session_start();
if(isset($_SESSION["username"]))
{
	header("Location: home.php");
	exit();
}

?>

<a class = "btn btn-default btn-sm pull-right" href = "login.php" id = "login-btn">Login</a>
