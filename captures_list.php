<?php


include("auth.php");
require('db.php');

$qty = $_POST['qty'];
$cid = 0;

for($i = 1; $i < $qty + 100; $i++)
{
	$chosen_check = 'n' . "$i";
	$test = $_POST["$chosen_check"];
	if($test == 9)
	{
		$cid = $i;
	}
}


/*$sql = "SELECT * FROM cctv WHERE cctv_id = $cid";
$result = mysqli_query($connection, $sql);
if(mysqli_num_rows($result) > 0)
{
	$row = mysqli_fetch_array($result);
	$cctv_id = $row["cctv_id"];
	$model_name = $row["model_name"];
	$installation_date = $row["installation_date"];
	$admin_id = $row["admin_id"];
}*/

$sql2 = "SELECT location_id FROM captures WHERE cctv_id = $cid";
$result2 = mysqli_query($connection, $sql2);

if(mysqli_num_rows($result2) > 0)
{
	$row = mysqli_fetch_array($result2);
	$selected_lid = $row["location_id"];
}


?>

<html>
	
	<head>
		<meta charset="utf-8">
		<title>Home</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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
						<li><a href = "admin.php">Admin</a></li>
						<li class = "active"><a href = "#"  style = "border-bottom: 3px solid #d200ff !important;">CCTV</a></li>
						<li><a href = "location.php">Location</a></li>
						<li><a href = "#">Video</a></li>
						<li><a href = "#">Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>

		<div class = "container">
			<h2>CCTV info</h2>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>CCTV id</th>
			        <th>Model name</th>
			        <th>Installation date</th>
			        <th>Admin-in-charge</th>
			      </tr>
			    </thead>
			    <tbody>



			<?

				$sql = "SELECT * FROM cctv WHERE cctv_id = $cid";
			    $result = mysqli_query($connection, $sql);

			    if(mysqli_num_rows($result) > 0)
			    {
			      while($row = mysqli_fetch_array($result))
			      {
			      	echo
			      	"<tr>".
			      	"<td>". $row["cctv_id"] ."</td>".
			      	"<td>". $row["model_name"] ."</td>".
			      	"<td>". $row["installation_date"] ."</td>".
			      	"<td>". $row["admin_id"] ."</td>".
			      	"</tr>";
			      }
			    }
			    else
			    {
			      echo "<h3>No cctv</h3>";
			    }


			?>
			</tbody>
			</table>
		</div>


		<div class = "container">
			<h2>Location list</h2>
			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Location id</th>
			        <th>City</th>
			        <th>Province</th>
			        <th>Building name</th>
			        <th>Building number</th>
			        <th>Floor number</th>
			        <th>Details</th>
			        <th>Settings</th>
			      </tr>
			    </thead>
			    <tbody>



			<?

				$sql2 = "SELECT location_id FROM captures WHERE cctv_id = $cid";
				$result2 = mysqli_query($connection, $sql2);

				if(mysqli_num_rows($result2) > 0)
				{
					while($row2 = mysqli_fetch_array($result2))
					{
						$selected_lid = $row2["location_id"];
						$sql3 = "SELECT * FROM location WHERE location_id = $selected_lid";
						$result3 = mysqli_query($connection, $sql3);
						if(mysqli_num_rows($result3) > 0)
						{
							while($row3 = mysqli_fetch_array($result3))
							{
								echo
					      		"<tr>".
					      		"<td>". $row3["location_id"] ."</td>".
					      		"<td>". $row3["city"] ."</td>".
					      		"<td>". $row3["province"] ."</td>".
					      		"<td>". $row3["bld_name"] ."</td>".
					      		"<td>". $row3["bld_number"] ."</td>".
					      		"<td>". $row3["floor_number"] ."</td>".
					      		"<td>". $row3["details"] ."</td>".
					      		"<td>
					      		<form method = \"post\" action = \"delete_captures.php\">
					      		<input type=\"hidden\" name = \"qty\" value = \"". mysqli_num_rows($result3) ."\">
					      		<input type=\"hidden\" name = \"cid\" value = \"". $cid ."\">
					      		<button type = \"submit\" class = \"btn btn-default\" name = \"d". $row3["location_id"] ."\" value = \"9\"><span class = \"glyphicon glyphicon-trash\" aria-hidden = \"true\"></span></button></form>

					      		</td>"
					      		."</tr>";
							}
						}

					}
					
				}



			?>
			</tbody>
			</table>
			<br><br>
			<a type="submit" href = "cctv.php" class="btn btn-primary btn-lg">Done</a>
		</div>



	</body>

</html>