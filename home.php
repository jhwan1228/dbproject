<?php

include("auth.php");

if($_SESSION['username'] == "sadmin")
{


?>

<!--
sadmin html goes here
-->


<html>
	<head>
		<meta charset="utf-8">
		<title>Home</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!--link rel = "stylesheet" href = "style.css" /-->
	</head>

	<body>
		<nav class = "nav navbar-inverse">
			<div class = "container-fluid">
				<div class="collapse navbar-collapse" id=".navbar-collapse">
					<ul class = "nav navbar-nav">
						<li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Logged in as <?php echo $_SESSION['username']; ?> <span class="caret"></span></a>
				          <ul class="dropdown-menu">
				            <li><a href="logout.php">Logout</a></li>
				          </ul>
				        </li>
						
					</ul>

					<ul class = "nav navbar-nav navbar-right">
						<li  class = "active"><a style = "border-bottom: 3px solid #d200ff !important;">Home</a></li>
						<li><a href = "admin.php" >Admin</a></li>
						<li><a href = "cctv.php">CCTV</a></li>
						<li><a href = "location.php">Location</a></li>
						<li><a href = "vm.php">Video + Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>

		<div class = "container">
			<h1><p>Welcome <?php echo $_SESSION['username']; ?>!</p></h1>
			<h1><?php echo $_SESSION['id']; ?></h1>
			<h2>This is sadmin</h2>
		</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>
		


	</body>


</html>


<?php
}

else
{
?>

<!--
admin html goes here


-->

<h1><p>Welcome <?php echo $_SESSION['username']; ?>!</p></h1>
<h1><?php echo $_SESSION['id']; ?></h1>
<h2>This is admin</h2>
<a href = "admin.php">admin.php</a><br>
<a href = "cctv.php">admin.php</a><br>
<a href = "logout.php">logout.php</a>


<?php
}
?>