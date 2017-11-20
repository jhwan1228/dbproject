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
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<link rel = "stylesheet" href = "style.css" />

	</head>

	<body>
		
		<nav class = "nav navbar-default">
			<div class = "container-fluid">
				<div class = "navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
        				<span class="sr-only">Toggle navigation</span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
      				</button>
						<a class = "navbar-brand" href="logout.php">Logout</a>
				</div>
				<div class="collapse navbar-collapse" id=".navbar-collapse">
					<ul class = "nav navbar-nav navbar-right">
						<li><a href = "admin.php">Admin</a></li>
						<li><a href = "#" style = "border-bottom: 3px solid #d200ff !important;">CCTV</a></li>
						<li><a href = "location.php">Location</a></li>
						<li><a href = "#">Video</a></li>
						<li><a href = "#">Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>
		

		<div class = "container">
		<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
		<h1>CCTV</h1>
		</div>

		<div class = "container">

		<h2>Create CCTV</h2>


			
		

		<form class="form-horizontal" action = "create_cctv.php" method = "post">
		  <div class="form-group">
		    <label class="control-label col-sm-2">Model name:</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="model_name" placeholder="Enter model name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2">Installation date:</label>
		    <div class="col-sm-10"> 
		      <input type="text" class="form-control" name="installation_date" placeholder="Enter installation date">
		    </div>
		  </div>
		  <div class="form-group">
			  <label class = "control-label col-sm-2" for="sel1">Select list:</label>
			  <div class = "col-sm-3">
			  <select class="form-control" name="id">

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
			<h3>Search</h3>
			<form class="form-inline">
			  <div class="form-group">
			    <label for="">CCTV id:</label>
			    <input type="text" class="form-control" id="">
			  </div>
			  <div class="form-group">
			    <label for="">Model name:</label>
			    <input type="text" class="form-control" id="">
			  </div>
			  <div class="form-group">
			    <label for="">Installation date:</label>
			    <input type="text" class="form-control" id="">
			  </div>
			  <div class="form-group">
			    <label for="">Admin-in-charge:</label>
			    <input type="text" class="form-control" id="">
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
		<br>
		<br>

		<div class = "container">
			
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
			      mysqli_close($connection);

			      ?>

			      
			    </tbody>
			  </table>
		</div>


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
		<link rel = "stylesheet" href = "style.css" />

	</head>

	<body>
		
		<nav class = "nav navbar-default">
			<div class = "container-fluid">
				<div class = "navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false">
        				<span class="sr-only">Toggle navigation</span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
        				<span class="icon-bar"></span>
      				</button>
						<a class = "navbar-brand" href="logout.php">Logout</a>
				</div>
				<div class="collapse navbar-collapse" id=".navbar-collapse">
					<ul class = "nav navbar-nav navbar-right">
						<li><a href = "admin.php">Admin</a></li>
						<li><a href = "#" style = "border-bottom: 3px solid #d200ff !important;">CCTV</a></li>
						<li><a href = "#">Location</a></li>
						<li><a href = "#">Video</a></li>
						<li><a href = "#">Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>
		

		<div class = "container">
		<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
		<h1>CCTV</h1>
		</div>

		

		<div class = "container">
			<h3>Search</h3>
			<form class="form-inline">
			  <div class="form-group">
			    <label for="">CCTV id:</label>
			    <input type="text" class="form-control" id="">
			  </div>
			  <div class="form-group">
			    <label for="">Model name:</label>
			    <input type="text" class="form-control" id="">
			  </div>
			  <div class="form-group">
			    <label for="">Installation date:</label>
			    <input type="text" class="form-control" id="">
			  </div>
			  <div class="form-group">
			    <label for="">Admin-in-charge:</label>
			    <input type="text" class="form-control" id="">
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
		</div>
		<br>
		<br>

		<div class = "container">
			
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


	</body>




</html>


<?
}
?>


