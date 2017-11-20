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
				echo "<div class = 'form'><h3>Username/password is incorrect.</h3><br/>Click here to <a href = 'login.php'>Login</a></div>";
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
		<link rel = "stylesheet" href = "style.css"/>
	</head>

	<body>
		<div class = "form">
			<h1>Login</h1>
			<form action = "" method = "post" name = "login">
				<input type = "text" name = "username" placeholder = "Username" required />
				<input type = "password" name = "password" placeholder = "Password" required/>
				<input type = "submit" name = "submit" value = "Login" />
			</form>
		</div>
	</body>
	<?php } ?>
</html>