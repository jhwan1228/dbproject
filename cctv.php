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
		<title>CCTV</title>
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
						<li><a href = "admin.php">Admin</a></li>
						<li class = "active"><a href = "#" style = "border-bottom: 3px solid #d200ff !important;">CCTV</a></li>
						<li><a href = "location.php">Location</a></li>
						<li><a href = "vm.php">Video + Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>
		


		<div class = "container">

		<h2>Create CCTV</h2>


		<form class="form-horizontal" action = "create_cctv.php" method = "post">
		  <div class="form-group">
		    <label class="control-label col-sm-2">Model name:</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" name="model_name" placeholder="Enter model name" required/>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2">Installation date:</label>
		    <div class="col-sm-6"> 
		      <input type="date" class="form-control" name="installation_date" placeholder="Enter installation date" required/>
		    </div>
		  </div>
		  <div class="form-group">
			  <label class = "control-label col-sm-2" for="sel1">Select admin:</label>
			  <div class = "col-sm-3">
			  <select class="form-control" name="id" required/>

				<?php

				require("db.php");

				$query = "SELECT * FROM admin";
				$result = mysqli_query($connection, $query);
				while($r = mysqli_fetch_array($result))
				{
					if($r['id'] == 1)
					{
						continue;
					}
					echo "<option value =" . $r['id'] . ">" . $r['username'] . "</option>";
				}

				?>
			  </select>
			  </div>
			</div>
		  <div class="form-group"> 
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default">Submit</button>
		    </div>
		  </div>
		</form>
		</div>

		<div class = "container">

		<h2>Create CCTV with csv</h2>


		<form class="form-horizontal" action = "create_cctv_csv.php" method = "post" enctype = "multipart/form-data">
		  <div class="form-group">
		    <label class="control-label col-sm-2">Upload file:</label>
		    <div class="col-sm-6">
		      <input type="file" class="form-control" name="cctvupload" required/>
		    </div>
		  </div>
		  <div class="form-group"> 
		    <div class="col-sm-offset-2 col-sm-10">
		      <input type="submit" class="btn btn-default" name = "save" value = "Upload">
		    </div>
		  </div>
		</form>
		</div>
		

		<div class = "container">
			<h2>Search CCTV</h2>
			<form class="form-inline" method = "post" action = "cctv.php?go">
			  <div class="form-group">
			    <label>Model name:</label>
			    <input type="text" class="form-control" name="model_name">
			  </div>
			  <div class="form-group">
			    <label>Installation date:</label>
			    <input type="text" class="form-control" name="installation_date">
			  </div>
			  <div class="form-group">
			    <label>Admin-in-charge:</label>
			    <input type="text" class="form-control" name="admin_in_charge">
			  </div>
			  <button type="submit" name = "search_submit" class="btn btn-default" style = "margin-left: 5px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Search</button>
			</form>
		
		<br>

			<h3>Search results</h3>

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

			<?php
			if(isset($_POST['search_submit']))
			{
			if(isset($_GET['go']))
			{
				//if($_POST['model_name'])
				
				$model_name = $_POST['model_name'];
				$installation_date = $_POST['installation_date'];
				$admin_in_charge = $_POST['admin_in_charge'];

				if($model_name && !$installation_date && !$admin_in_charge)
				{
					$sql = "SELECT * FROM cctv WHERE model_name = '$model_name'";
				}
				else if(!$model_name && $installation_date && !$admin_in_charge)
				{
					$sql = "SELECT * FROM cctv WHERE installation_date = '$installation_date'";
				}
				else if(!$model_name && !$installation_date && $admin_in_charge)
				{
					$sql = "SELECT * FROM cctv WHERE admin_id = '$admin_in_charge'";
				}
				else if($model_name && $installation_date && !$admin_in_charge)
				{
					$sql = "SELECT * FROM cctv WHERE model_name = '$model_name' AND installation_date = '$installation_date'";
				}
				else if(!$model_name && $installation_date && $admin_in_charge)
				{
					$sql = "SELECT * FROM cctv WHERE admin_id = '$admin_in_charge' AND installation_date = '$installation_date'";
				}
				else if($model_name && !$installation_date && $admin_in_charge)
				{
					$sql = "SELECT * FROM cctv WHERE admin_id = '$admin_in_charge' AND model_name = '$model_name'";
				}

				//$sql = "SELECT * FROM cctv WHERE model_name = '$model_name'";
				$resultsql = mysqli_query($connection, $sql);
				while($row = mysqli_fetch_array($resultsql))
				{
					$result_cctv_id = $row['cctv_id'];
					$result_model_name = $row['model_name'];
					$result_installation_date = $row['installation_date'];
					$result_admin_in_charge = $row['admin_id'];
					echo
			      	"<tr>".
			      	"<td>". $result_cctv_id ."</td>".
			      	"<td>". $result_model_name ."</td>".
			      	"<td>". $result_installation_date ."</td>".
			      	"<td>". $result_admin_in_charge ."</td>"
			      	."</tr>";
				}
				
			}
			}
			?>
			</tbody>
			</table>
			<?php
			if(isset($_POST['search_submit']))
			{
				if(isset($_GET['go']))
				{
					echo "<a type=\"submit\" href = \"cctv.php\" class=\"btn btn-primary\">Done</a><br>";
				}
			}
			else
			{
				echo "<p>Please enter search query</p>";
			}

			?>
		</div>
		

		<div class = "container">

				<h2>CCTV table</h2>
			
			  <p>The .table-hover class enables a hover state on table rows:</p>            
			  <table class="table table-hover">
			    <thead>
			      <tr>
			        <th>CCTV id</th>
			        <th>Model name</th>
			        <th>Installation date</th>
			        <th>Admin-in-charge</th>
			        <th>Location list</th>
			      </tr>
			    </thead>
			    <tbody>
			      

			    <?php
			      require("db.php");

			      $sql = "SELECT * FROM cctv";
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
			      		"<td>
			      		<form method = \"post\" action = \"captures_list.php\">
			      		<input type=\"hidden\" name = \"qty\" value = \"". mysqli_num_rows($result) ."\">
			      		<button type = \"submit\" class = \"btn btn-default\" name = \"n". $row["cctv_id"] ."\" value = \"9\"><span class = \"glyphicon glyphicon-eye-open\" aria-hidden = \"true\"></span></button></form>

			      		</td>"
			      		."</tr>";
			      	}
			      }
			      else
			      {
			      	echo "<h3>No cctv</h3>";
			      }
			      mysqli_close($connection);

			      ?>

			      
			    </tbody>
			  </table>
		</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>


	</body>




</html>

<?
}

else
{
?>

<!--
admin html goes here
-->


<html>
	<head>
		
		<meta charset="utf-8">
		<title>CCTV</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
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
				            <li><a href="edit_or_del_admin.php">Change personal info</a></li>
				          </ul>
				        </li>
						
					</ul>

					<ul class = "nav navbar-nav navbar-right">
						<li><a href = "home.php">Home</a></li>
						<li><a href = "admin.php">Admin</a></li>
						<li class = "active"><a  style = "border-bottom: 3px solid #d200ff !important;">CCTV</a></li>
						<li><a href = "location.php">Location</a></li>
						<li><a href = "vm.php">Video + Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>

		

		<div class = "container">
			<h2>Assigned CCTV list</h2>
			  <p>The .table-hover class enables a hover state on table rows:</p>            
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
			      

			    <?php
			      require("db.php");

			      $sql = "SELECT * FROM cctv";
			      $result = mysqli_query($connection, $sql);

			      if(mysqli_num_rows($result) > 0)
			      {
			      	while($row = mysqli_fetch_array($result))
			      	{
			      		if($row["admin_id"] == $_SESSION['id'])
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
			      }
			      else
			      {
			      	echo "<h3>No cctv</h3>";
			      }
			      mysqli_close($connection);

			      ?>

			      
			    </tbody>
			  </table>
		</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>


	</body>




</html>


<?
}
?>


