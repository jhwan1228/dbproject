<?php

include("auth.php");
require('db.php');
$action = 0;
$nid = 0;

for($i = 1; $i < $qty + 100; $i++)
{
	$chosen_check = 'e' . "$i";
	$test = $_POST["$chosen_check"];
	if($test == 9)
	{
		$chosen = 'e' . "$i";
		$action = 1;
		$nid = $i;
	}
	$chosen_check2 = 'd' . "$i";
	$test2 = $_POST["$chosen_check2"];
	if($test2 == 9)
	{
		$chosen = 'd' . "$i";
		$action = 2;
		$nid = $i;
	}
}

$sql = "SELECT * FROM sequence WHERE sequence_id = $nid";
$result = mysqli_query($connection, $sql);

if(mysqli_num_rows($result) > 0)
{
	$row = mysqli_fetch_array($result);
	$sequence_id = $row['sequence_id'];
	$sequence_name = $row['sequence_name'];
	$neighbors_list = $row['neighbors_list'];
	$neighbors_list_after = substr($neighbors_list, 1);
	$neighbors_list_array = explode("-", $neighbors_list_after);
	$total_neighbors_list_array = count($neighbors_list_array);

}
else
{
	echo "<h3>Cannot edit</h3>" . " ";
}

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
			
		<h2>Edit sequence</h2>

		<form class = "form-horizontal col-md-8" action = "edit_sequence.php" method = "post" class = "form-horizontal col-md-8">


		<?php


		$text4 = "<div class=\"form-group\">
    <label class = \"control-label col-sm-2\">Sequence name:</label>
    <div class = \"col-sm-6\"><input type = \"text\" class = \"form-control\" value = \"" . $sequence_name ."\" name = \"s_name\" required><input type = \"hidden\" name = \"s_id\" value = " . $sequence_id . "><input type = \"hidden\" name = \"qty\" value = " . $total_neighbors_list_array . "></div></div>";

    	$text2 = "<div class=\"col-sm-offset-2 col-sm-6\"><button type=\"submit\" class=\"btn btn-primary\">Save changes</button><a type=\"submit\" href = \"location.php\" class=\"btn btn-default\" style = \"margin-left: 5px;\">Cancel</a></div>";

    	for($i = 0; $i < $total_neighbors_list_array; $i++)
		{

		    echo "<div class=\"form-group\">
		    <label class = \"control-label col-sm-2\">". $i ."</label>
		    <div class = \"col-sm-6\">
		        <select class=\"form-control\" name=\"s". $i ."\">";

		    require("db.php");

		    $query = "SELECT * FROM neighbors";
		    $result = mysqli_query($connection, $query);
		    while($r = mysqli_fetch_array($result))
		    {
		    	if($r['neighbors_id'] == $neighbors_list_array[$i])
		    	{
		    		echo "<option selected = \"selected\" value =" . $r['neighbors_id'] . ">" . $r['neighbors_name'] . "</option>";
		    	}
		    	else
		    	{
		    		echo "<option value =" . $r['neighbors_id'] . ">" . $r['neighbors_name'] . "</option>";
		    	}
		        
		    }
		    echo "</select>
		        </div>
		</div>";
		}
		echo $text4;
		echo $text2;



		?>
		</form>


		</div>



	</body>

</html>


<?
}
else if($action == 2)
{
	$query = "DELETE FROM sequence WHERE sequence_id = $sequence_id";
	$result = mysqli_query($connection, $query);

	if($result)
	{
		header("Location: location.php");
	}
}
?>