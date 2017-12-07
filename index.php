<?php

session_start();
if(isset($_SESSION["username"]))
{
	header("Location: home.php");
	exit();
}

?>

<style>
	
body
{
	background-color: #f3f3f3 !important;
}

.info
{
	display: block;
	margin: auto;
	margin-top: 80px;
	padding-top: 120px;
	padding-bottom: 120px;
	padding-right: 10px;
	padding-left: 10px;
	background-color: white;

	
}

.icon
{
	display: block;
	margin: auto;
	margin-top: 30px;
	height: 220px;


}



#name
{
	margin: auto;
	text-align: center;
	color: #646464;
	margin-top: 20px;
}



}

</style>

<html>
	
	<head>
		
		<meta charset="utf-8">
		<title>Index</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!--link rel = "stylesheet" href = "style.css" /-->

	</head>

	<body>
		
		<nav class = "nav navbar-inverse">
			<div class = "container-fluid">
				<div class="collapse navbar-collapse" id=".navbar-collapse">
				<p class = "navbar-text navbar-left">Database Project</p>

					<p class = "navbar-text navbar-right">This is index page</p>
				</div>
			</div>
		</nav>

		<div class = "container info">
			<div class = "col-md-5">
				<img src="cctv_icon.png" class = "icon">
			</div>
			<div class = "col-md-7">
				<h1>Database project</h1><br>
				<h4>Home</h4>
				<h4>Admin</h4>
				<h4>CCTV</h4>
				<h4>Location</h4>
				<h4>Video + Metalog</h4><br>
				<a class="btn btn-default btn-lg block" href = "login.php">Login</a>
			</div>
		</div>
		
		<p id = "name">Park JuHyun, Kim Ji Hwan, Faiz Wong</p>
	</body>
</html>
