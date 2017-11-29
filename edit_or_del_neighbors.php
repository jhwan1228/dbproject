<?php

include("auth.php");
require('db.php');

$qty = $_POST['qty'];
$action = 0; //1 is edit, 2 is delete
$nid = 0;
$l1id = $_POST['l1id'];
$l2id = $_POST['l2id'];


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

$sql = "SELECT * FROM neighbors WHERE neighbors_id = $nid";
$result = mysqli_query($connection, $sql);

if(mysqli_num_rows($result) > 0)
{
	$row = mysqli_fetch_array($result);
	$neighbors_id = $row["neighbors_id"];
	$neighbors_name = $row["neighbors_name"];
	//echo "username = " . $username . " ";
}
else
{
	echo "<h3>Cannot edit</h3>" . " ";
	echo $nid . " ";
	echo $l1id . " ";
	echo $l2id . " ";
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

		<h2>Edit neighbors</h2>

		<form class="form-horizontal" action = "edit_neighbors.php" method = "post">
		  <div class="form-group">
			  <label class = "control-label col-sm-2" for="sel1">Select location 1:</label>
			  <div class = "col-sm-3">
			  <select class="form-control" name="l1_id">

				<?php

				require("db.php");

				$query = "SELECT * FROM location";
				$result = mysqli_query($connection, $query);
				while($r = mysqli_fetch_array($result))
				{
					if($r['location_id'] == $l1id)
					{
						echo "<option selected = \"selected\" value =" . $r['location_id'] . ">" . $r['details'] . "</option>";
					}
					else
					{
						echo "<option value =" . $r['location_id'] . ">" . $r['details'] . "</option>";
					}
				}

				?>
			  </select>
			  </div>
			</div>
			<div class="form-group">
			  <label class = "control-label col-sm-2" for="sel1">Select location 2:</label>
			  <div class = "col-sm-3">
			  <select class="form-control" name="l2_id">

				<?php

				require("db.php");

				$query = "SELECT * FROM location";
				$result = mysqli_query($connection, $query);
				while($r = mysqli_fetch_array($result))
				{
					if($r['location_id'] == $l2id)
					{
						echo "<option selected = \"selected\" value =" . $r['location_id'] . ">" . $r['details'] . "</option>";
					}
					else
					{
						echo "<option value =" . $r['location_id'] . ">" . $r['details'] . "</option>";
					}
					
				}

				?>
			  </select>
			  </div>
			</div>
			<div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Neighbors name:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="neighbors_name" value=<?php echo "\"". $neighbors_name ."\"";?>>
		    </div>
		  </div>
		  <div class="form-group"> 
		    <div class="col-sm-offset-2 col-sm-10">
		    <input type = "hidden" name = "l1id" value=<?php echo "\"". $l1id ."\"";?>>
		    <input type = "hidden" name = "l2id" value=<?php echo "\"". $l2id ."\"";?>>
		    	<input type = "hidden" name = "neighbors_id" value=<?php echo "\"". $neighbors_id ."\"";?>>
		      <button type="submit" class="btn btn-primary">Save changes</button>
		      <a type="submit" href = "location.php" class="btn btn-default" style = "margin-left: 5px;">Cancel</a>
		    </div>
		  </div>
		</form>
			
		</div>


	</body>


</html>




<?

}
else if($action == 2)
{

	
	$query2 = "DELETE FROM neighbors_of WHERE neighbors_id = $nid";
	$query = "DELETE FROM neighbors WHERE neighbors_id = $nid";

	
	$result2 = mysqli_query($connection, $query2);
	$result1 = mysqli_query($connection, $query);

	if(!$result2)
	{
		echo "result2 failed";
	}

	


	$sql = "SELECT * from sequence";
	$resultsql = mysqli_query($connection, $sql);

	if(mysqli_num_rows($resultsql) > 0)
	{
		while($row = mysqli_fetch_array($resultsql))
		{
			$test1 = $row['sequence_id'];
			$test2 = $row['neighbors_list'];

			$list = substr($test2, 1);
			$tr = explode("-", $list);
			$total_tr = count($tr);

			for($i = 0; $i < $total_tr; $i++)
			{
				if($tr[$i] == $nid)
				{
					$sql2 = "DELETE FROM sequence WHERE sequence_id = $test1";
					$resultsql = mysqli_query($connection, $sql2);
					if(!$resultsql)
					{
						echo "resultsql failed";
					}
				}
			}
		}
	}

	

	if($result1 && $result2)
	{
		header("Location: location.php");
	}



}
?>