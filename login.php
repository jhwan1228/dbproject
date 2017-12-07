<?php
	session_start();

// Date in the past
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Cache-Control: no-cache");
	header("Pragma: no-cache");


		//session_start();
		require('db.php');


		//if form is submitted, insert values into the database
		if(isset($_POST['username']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$test_query = "SELECT id FROM admin WHERE username = '$username' and password = '$password'";
			$test_result = mysqli_query($connection, $test_query);
			$test_row = mysqli_fetch_array($test_result);

			//checking if user exists in the database or not
			$query = "SELECT * FROM admin WHERE username = '$username' and password = '$password'";
			$result = mysqli_query($connection, $query) or die(mysqli_error());
			$rows = mysqli_num_rows($result);
			if($rows == 1)
			{
				$_SESSION['username'] = $username;
				$_SESSION['id'] = $test_row['id'];
				header("Location: home.php");
			}
			else
			{
				header("Location: loginagain.php");
			}
		}
		else
		{
?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset = "utf-8">
		<title>Login</title>
		<!--link rel = "stylesheet" href = "style.css"/-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	</head>

	<style>
		
		body {background-color: #F1F1F1;}

		.container
		{
			background-color: white;
			padding-left: 50px;
			padding-right: 50px;
			padding-top: 15px;
			padding-bottom: 50px;
			margin-top: 10px;
			border: 1px solid #E7E7E7;
			border-radius: 5px;
		}

	</style>

	<body>

		<nav class = "nav navbar-inverse">
			<div class = "container-fluid">
				<div class="collapse navbar-collapse" id=".navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href = "index.php"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Back</a></li>
					</ul>

					<p class = "navbar-text navbar-right">Enter username and password to login</p>
				</div>
			</div>
		</nav>
		<br>
		<br>

		<div class = "container col-md-3 col-md-offset-4">
			<h1>Login</h1><br>
			<form action = "" method = "post" name = "login">
				<div class = "form-group">
					<input type = "text" class="form-control" name = "username" placeholder = "Username" required />
				</div>
				<div class = "form-group">
					<input type = "password" class="form-control" name = "password" placeholder = "Password" required/>
				</div>
				
				
				<button type = "submit" class = "btn btn-default" name = "submit" value = "Login">Submit</button>
				
			</form>
		</div>
	</body>
	<?php } ?>
</html>
