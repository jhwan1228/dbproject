<?php

include("auth.php");
require('db.php');

$qty = $_POST['qty'];
$sid = 0;

for($i = 1; $i < $qty + 100; $i++)
{
	$chosen_check = 'n' . "$i";
	$test = $_POST["$chosen_check"];
	if($test == 9)
	{
		$sid = $i;
	}
}

$sql2 = "SELECT * FROM sequence WHERE sequence_id = $sid";
$result2 = mysqli_query($connection, $sql2);

if(mysqli_num_rows($result2) > 0)
{
	$row = mysqli_fetch_array($result2);
	$selected_sid = $row["sequence_id"];
	$selected_sname = $row["sequence_name"];
	$selected_list = $row["neighbors_list"];
}

$list2 = $selected_list;
$list = substr($list2, 1);
$tr = explode("-", $list);
$total_tr = count($tr);



?>

<html>
	
	<head>
		<meta charset="utf-8">
		<title>Location</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
						<li><a href = "admin.php">Admin</a></li>
						<li><a href = "cctv.php">CCTV</a></li>
						<li class = "active"><a href = "#"  style = "border-bottom: 3px solid #d200ff !important;">Location</a></li>
						<li><a href = "#">Video</a></li>
						<li><a href = "#">Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>

		<div class = "container">
			<h2>Sequence info</h2>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Sequence id</th>
			        <th>Sequence name</th>
			      </tr>
			    </thead>
			    <tbody>



			<?php

				$sqla = "SELECT * FROM sequence WHERE sequence_id = $selected_sid";
			    $resulta = mysqli_query($connection, $sqla);

			    if(mysqli_num_rows($resulta) > 0)
			    {
			      while($rowa = mysqli_fetch_array($resulta))
			      {
			      	echo
			      	"<tr>".
			      	"<td>". $rowa["sequence_id"] ."</td>".
			      	"<td>". $rowa["sequence_name"] ."</td>".
			      	"</tr>";
			      }
			    }
			    else
			    {
			      echo "<h3>No sequence</h3>";
			    }


			?>
			</tbody>
			</table>
		</div>

		<div class = "container">

			<h2>Neighbors list</h2>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Neighbors id</th>
			        <th>Neighbors name</th>
			        <th>First location</th>
			        <th>Second location</th>
			      </tr>
			    </thead>
			    <tbody>



			<?php
				for($i = 0; $i < $total_tr; $i++)
				{
					$nid = $tr[$i];
					$sqlb = "SELECT * FROM neighbors WHERE neighbors_id = '$nid'";
				    $resultb = mysqli_query($connection, $sqlb);

				    if(!$resultb)
				    {
				    	echo "resultb failed";
				    }

				    if(mysqli_num_rows($resultb) > 0)
				    {
				      while($rowb = mysqli_fetch_array($resultb))
				      {
				      	echo
				      	"<tr>".
				      	"<td>". $rowb["neighbors_id"] ."</td>".
				      	"<td>". $rowb["neighbors_name"] ."</td>";

				      	$test = $rowb["neighbors_id"];
			      		$sql2 = "SELECT * FROM neighbors_of WHERE neighbors_id = '$test'";
			      		$result2 = mysqli_query($connection, $sql2);
			      		$q = 0;

				      	if(mysqli_num_rows($result2) > 0)
			      		{
			      			while($row2 = mysqli_fetch_array($result2))
			      			{
			      				//echo "<td>". $row2["location_id"] ."</td>";
			      				$q += 1;
			      				$test2 = $row2["location_id"];
			      				if($q == 1)
			      				{
			      					$w = $test2;
			      				}
			      				else if($q == 2)
			      				{
			      					$e = $test2;
			      				}
			      				$sql3 = "SELECT * FROM location WHERE location_id = '$test2'";
			      				$result3 = mysqli_query($connection, $sql3);
			      				if(mysqli_num_rows($result3) > 0)
			      				{
			      					while($row3 = mysqli_fetch_array($result3))
			      					{
			      						echo "<td>". $row3["details"] ."</td>";
			      					}

			      				}

			      			}
			      		}
				      }

				      echo "</tr>";
				    }
				    else
				    {
				      echo "<h3>No neighbors</h3>";
				    }
				}
			?>
			</tbody>
			</table>

			<br><br>
			<a type="submit" href = "location.php" class="btn btn-primary btn-lg">Done</a>

		</div>
	</body>
</html>