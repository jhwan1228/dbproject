<?php 

include("auth.php");
require('db.php');

if($_SESSION['username'] == "sadmin")
{

	$qty = $_POST['qty'];
	$action = 0; //1 is edit, 2 is delete
	$aid = 0;


	for($i = 1; $i < $qty + 100; $i++)
	{
		$chosen_check = 'e' . "$i";
		$test = $_POST["$chosen_check"];
		if($test == 9)
		{
			$chosen = 'e' . "$i";
			$action = 1;
			$aid = $i;
		}
		$chosen_check2 = 'd' . "$i";
		$test2 = $_POST["$chosen_check2"];
		if($test2 == 9)
		{
			$chosen = 'd' . "$i";
			$action = 2;
			$aid = $i;
		}
	}

	//echo "chosen = " . "$chosen" . " ";
	//echo "qty = " . "$qty" . " ";
	//echo "action = " . "$action" . " ";
	//echo "id = " . "$aid" . " ";

	$sql = "SELECT * FROM admin WHERE id = $aid";
	$result = mysqli_query($connection, $sql);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$id = $row["id"];
		$username = $row["username"];
		$password = $row["password"];
		$fname = $row["fname"];
		$lname = $row["lname"];
		$phone_number = $row["phone_number"];
		//echo "username = " . $username . " ";
	}
	else
	{
		echo "<h3>Cannot edit</h3>";
	}
	//mysqli_close($connection);

	if($action == 1)
	{


?>


<html>
	
	<head>
		
		<meta charset="utf-8">
		<title>Home</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!--link rel = "stylesheet" href = "style.css" /-->

        <script>
            $(document).ready(function() {
                $('input#id_phone_number').keyup(function(ev) {
                    var key = ev.which;
                    if (key < 48 || key > 57 || key != 45) {
                        ev.preventDefault();
                    }

                    if (this.value.length > 13) {
                        this.value = this.value.slice(0, -1);
                        return;
                    }

                    this.value = this.value.replace(/^(\d{3})(\d)/, '$1-$2')
                        .replace(/^(\d{3}-\d{4})(\d)/, '$1-$2');
                });
            });
        </script>

	</head>
	<style>
		
		body {background-color: #F1F1F1;}

		.container
		{
			background-color: white;
			padding-left: 50px;
			padding-top: 15px;
			padding-bottom: 15px;
			margin-top: 10px;
			border: 1px solid #E7E7E7;
			border-radius: 5px;
		}

	</style>

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
						<li><a href = "home.php">Home</a></li>
						<li class = "active"><a href = "#" style = "border-bottom: 3px solid #d200ff !important;">Admin</a></li>
						<li><a href = "cctv.php">CCTV</a></li>
						<li><a href = "location.php">Location</a></li>
						<li><a href = "#">Video</a></li>
						<li><a href = "#">Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>

		<div class = "container">

		<h2>Edit admin</h2>

		<form class="form-horizontal" action = "edit_admin.php" method = "post">
			<input type = "hidden" name = "id" value= <?php echo "\"". $id ."\""?>>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="email">Username:</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" name="username" value= <?php echo "\"". $username ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Password:</label>
		    <div class="col-sm-6"> 
		      <input type="password" class="form-control" name="password" value= <?php echo "\"". $password ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">First name:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="fname" value= <?php echo "\"". $fname ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Lastname:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="lname" value= <?php echo "\"". $lname ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Phone number:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" id="id_phone_number" name="phone_number" value= <?php echo "\"". $phone_number ."\""?>>
		    </div>
		  </div>
		  <div class="form-group"> 
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">Save changes</button>
		      <a type="submit" href = "admin.php" class="btn btn-default" style = "margin-left: 5px;">Cancel</a>
		    </div>
		  </div>
		</form>


		</div>


	</body>

</html>

<?php
	}
	else if($action == 2)
	{
		
		//echo "$id = " . $id . " ";
		$query = "DELETE FROM admin WHERE id = $id";
		$result2 = mysqli_query($connection, $query);
		if($result2)
		{
			//echo " in ";
			header("Location: admin.php");
		}
		else
		{
			die("Unable to delete " . mysqli_error($result2));
		}
		mysqli_close($connection);

	} 
}
else
{
	$action = 1;
	$aid = $_SESSION['id'];

	$sql = "SELECT * FROM admin WHERE id = $aid";
	$result = mysqli_query($connection, $sql);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$id = $row["id"];
		$username = $row["username"];
		$password = $row["password"];
		$fname = $row["fname"];
		$lname = $row["lname"];
		$phone_number = $row["phone_number"];
		//echo "username = " . $username . " ";
	}
	else
	{
		echo "<h3>Cannot edit</h3>";
	}
	//mysqli_close($connection);

	if($action == 1)
	{
?>


<html>
	
	<head>
		
		<meta charset="utf-8">
		<title>Home</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!--link rel = "stylesheet" href = "style.css" /-->

	</head>
	<style>
		
		body {background-color: #F1F1F1;}

		.container
		{
			background-color: white;
			padding-left: 50px;
			padding-top: 15px;
			padding-bottom: 15px;
			margin-top: 10px;
			border: 1px solid #E7E7E7;
			border-radius: 5px;
		}

	</style>

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
						<li><a href = "home.php">Home</a></li>
						<li class = "active"><a href = "#" style = "border-bottom: 3px solid #d200ff !important;">Admin</a></li>
						<li><a href = "cctv.php">CCTV</a></li>
						<li><a href = "location.php">Location</a></li>
						<li><a href = "#">Video</a></li>
						<li><a href = "#">Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>

		<div class = "container">

		<h2>Edit admin</h2>

		<form class="form-horizontal" action = "edit_admin.php" method = "post">
			<input type = "hidden" name = "id" value= <?php echo "\"". $id ."\""?>>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="email">Username:</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" name="username" value= <?php echo "\"". $username ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Password:</label>
		    <div class="col-sm-6"> 
		      <input type="password" class="form-control" name="password" value= <?php echo "\"". $password ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">First name:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="fname" value= <?php echo "\"". $fname ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Lastname:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="lname" value= <?php echo "\"". $lname ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Phone number:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" id="id_phone_number" name="phone_number" value= <?php echo "\"". $phone_number ."\""?>>
		    </div>
		  </div>
		  <div class="form-group"> 
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">Save changes</button>
		      <a type="submit" href = "admin.php" class="btn btn-default" style = "margin-left: 5px;">Cancel</a>
		    </div>
		  </div>
		</form>


		</div>


	</body>

</html>

<?php
	}
}

?>