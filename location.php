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
						<li><a href = "cctv.php"">CCTV</a></li>
						<li><a href = "#" style = "border-bottom: 3px solid #d200ff !important;">Location</a></li>
						<li><a href = "#">Video</a></li>
						<li><a href = "#">Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>
		

		<div class = "container">
		<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
		<h1>Location</h1>
		</div>


		<div class = "container">

		<h2>Create location</h2>

		<form class="form-horizontal" action = "create_location.php" method = "post">
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="email">City:</label>
		    <div class="col-sm-10">
		      <input type="text" class="form-control" name="city" placeholder="Enter city">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Province:</label>
		    <div class="col-sm-10"> 
		      <input type="text" class="form-control" name="province" placeholder="Enter province">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Building name:</label>
		    <div class="col-sm-10"> 
		      <input type="text" class="form-control" name="bld_name" placeholder="Enter building name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Building number:</label>
		    <div class="col-sm-10"> 
		      <input type="text" class="form-control" name="bld_number" placeholder="Enter building number">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Floor number:</label>
		    <div class="col-sm-10"> 
		      <input type="text" class="form-control" name="floor_number" placeholder="Enter floor number">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Details:</label>
		    <div class="col-sm-10"> 
		      <input type="text" class="form-control" name="details" placeholder="Enter details">
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

		<h2>Assign CCTV to location</h2>

		<form class="form-horizontal" action = "assign_cctv_to_location.php" method = "post">
		  <div class="form-group">
			  <label class = "control-label col-sm-2" for="sel1">Select cctv:</label>
			  <div class = "col-sm-3">
			  <select class="form-control" name="cctv_id">

				<?php

				require("db.php");

				$query = "SELECT * FROM cctv";
				$result = mysqli_query($connection, $query);
				while($r = mysqli_fetch_array($result))
				{
					echo "<option value =" . $r['cctv_id'] . ">" . $r['cctv_id'] . "</option>";
				}

				?>
			  </select>
			  </div>
			</div>
			<div class="form-group">
			  <label class = "control-label col-sm-2" for="sel1">Select location:</label>
			  <div class = "col-sm-3">
			  <select class="form-control" name="location_id">

				<?php

				require("db.php");

				$query = "SELECT * FROM location";
				$result = mysqli_query($connection, $query);
				while($r = mysqli_fetch_array($result))
				{
					echo "<option value =" . $r['location_id'] . ">" . $r['location_id'] . "</option>";
				}

				?>
			  </select>
			  </div>
			</div>
		  <div class="form-group"> 
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default">Assign</button>
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

			<h3>Location table</h3>
			
			  <p>The .table-hover class enables a hover state on table rows:</p>            
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
			      </tr>
			    </thead>
			    <tbody>
			      

			    <?php
			      require("db.php");

			      $sql = "SELECT * FROM location";
			      $result = mysqli_query($connection, $sql);

			      if(mysqli_num_rows($result) > 0)
			      {
			      	while($row = mysqli_fetch_array($result))
			      	{
			      		echo
			      		"<tr>".
			      		"<td>". $row["location_id"] ."</td>".
			      		"<td>". $row["city"] ."</td>".
			      		"<td>". $row["province"] ."</td>".
			      		"<td>". $row["bld_name"] ."</td>".
			      		"<td>". $row["bld_number"] ."</td>".
			      		"<td>". $row["floor_number"] ."</td>".
			      		"<td>". $row["details"] ."</td>".
			      		"</tr>";
			      	}
			      }
			      else
			      {
			      	echo "<h3>No locations</h3>";
			      }
			      mysqli_close($connection);

			      ?>

			      
			    </tbody>
			  </table>
		</div>



		<div class = "container">
			
			<h3>Create sequence</h3>

			<form id = "sequence_adder" action = "create_sequence.php" method = "post">
			<div id = "ts">
			  <div class="form-group">
			    <label for="">1</label>
			    <input type="text" class="form-control" name="s1">
			  </div>
			  <div class="form-group">
			    <label>2</label>
			    <input type="text" class="form-control" name="s2">
			  </div>
<script>

var label_count = 2;

$(document).ready(function(){
    $("#plus").click(function(){
    	label_count += 1;
        $("#ts").append("<div class = \"form-group\"><label>" + label_count + "</label><input type=\"text\" class = \"form-control\" name=\"s"+ label_count +"\"></div>");
    });
    $("#submitt").click(function(){
        $("#quantity").val(label_count);
    });
});



</script>
			  </div>
			  <button type="button" id = "plus" class="btn btn-info" style = "margin-right: 5px;">+</button><button type="button" class="btn btn-danger">Reset</button><br><br>
			  <input type="hidden" name = "qty" id = "quantity">
			  <button type="submit" id = "submitt" class="btn btn-default">Submit</button>
			</form>

		</div>


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


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

<h1><p>Welcome <?php echo $_SESSION['username']; ?>!</p></h1>
<h1><?php echo $_SESSION['id']; ?></h1>
<h2>This is admin</h2>
<a href = "admin.php">admin.php</a><br>
<a href = "cctv.php">admin.php</a><br>
<a href = "logout.php">logout.php</a>


<?
}
?>