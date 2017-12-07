<?php 

include("auth.php");
require('db.php');

//if($_SESSION['username'] == "sadmin")
//{

	$qty = $_POST['qty'];
	$action = 0; //1 is edit, 2 is delete
	$lid = 0;


	for($i = 1; $i < $qty + 100; $i++)
	{
		$chosen_check = 'e' . "$i";
		$test = $_POST["$chosen_check"];
		if($test == 9)
		{
			$chosen = 'e' . "$i";
			$action = 1;
			$lid = $i;
		}
		$chosen_check2 = 'd' . "$i";
		$test2 = $_POST["$chosen_check2"];
		if($test2 == 9)
		{
			$chosen = 'd' . "$i";
			$action = 2;
			$lid = $i;
		}
	}

	//echo "chosen = " . "$chosen" . " ";
	//echo "qty = " . "$qty" . " ";
	//echo "action = " . "$action" . " ";
	//echo "id = " . "$aid" . " ";

	$sql = "SELECT * FROM location WHERE location_id = $lid";
	$result = mysqli_query($connection, $sql);

	if(mysqli_num_rows($result) > 0)
	{
		$row = mysqli_fetch_array($result);
		$city = $row["city"];
		$province = $row["province"];
		$bld_name = $row["bld_name"];
		$floor_number = $row["floor_number"];
		$details = $row["details"];
		$location_id = $row["location_id"];
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
						<li><a href = "vm.php">Video + Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>

		<div class = "container">

		<h2>Edit admin</h2>

		<form class="form-horizontal" action = "edit_location.php" method = "post">
			<input type = "hidden" name = "location_id" value= <?php echo "\"". $location_id ."\""?>>
		  <div class="form-group">
		    <label class="control-label col-sm-2">City:</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" name="city" value= <?php echo "\"". $city ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2">Province:</label>
		    <div class="col-sm-6"> 
		      <input type="password" class="form-control" name="province" value= <?php echo "\"". $province ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2">Building name:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="bld_name" value= <?php echo "\"". $bld_name ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2">Floor number:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="floor_number" value= <?php echo "\"". $floor_number ."\""?>>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2">Details:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="details" value= <?php echo "\"". $details ."\""?>>
		    </div>
		  </div>
		  <div class="form-group"> 
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">Save changes</button>
		      <a type="submit" href = "location.php" class="btn btn-default" style = "margin-left: 5px;">Cancel</a>
		    </div>
		  </div>
		</form>


		</div>


	</body>

</html>


	
<?php
}
?>