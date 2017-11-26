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
		<title>Location</title>
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
						<li><a href = "admin.php">Admin</a></li>
						<li><a href = "cctv.php">CCTV</a></li>
						<li class = "active"><a href = "location.php" style = "border-bottom: 3px solid #d200ff !important;">Location</a></li>
						<li><a href = "#">Video</a></li>
						<li><a href = "#">Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>


		<div class = "container">

		<h2>Create location</h2>

		<form class="form-horizontal" action = "create_location.php" method = "post">
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="email">City:</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" name="city" placeholder="Enter city">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Province:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="province" placeholder="Enter province">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Building name:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="bld_name" placeholder="Enter building name" required/>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Building number:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="bld_number" placeholder="Enter building number">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Floor number:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="floor_number" placeholder="Enter floor number">
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Details:</label>
		    <div class="col-sm-6"> 
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
					echo "<option value =" . $r['location_id'] . ">" . $r['details'] . "</option>";
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

		<h2>Create neighbors</h2>

		<form class="form-horizontal" action = "create_neighbors.php" method = "post">
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
					echo "<option value =" . $r['location_id'] . ">" . $r['details'] . "</option>";
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
					echo "<option value =" . $r['location_id'] . ">" . $r['details'] . "</option>";
				}

				?>
			  </select>
			  </div>
			</div>
			<div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Neighbors name:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="neighbors_name" placeholder="Enter neighbors name">
		    </div>
		  </div>
		  <div class="form-group"> 
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-default">Create</button>
		    </div>
		  </div>
		</form>


		</div>



		<div class = "container">

			<h3>Neighbors table</h3>
			
			  <p>The .table-hover class enables a hover state on table rows:</p>            
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
			      require("db.php");

			      $sql = "SELECT * FROM neighbors";
			      $result = mysqli_query($connection, $sql);

			      if(mysqli_num_rows($result) > 0)
			      {
			      	while($row = mysqli_fetch_array($result))
			      	{


			      		echo
			      		"<tr>".
			      		"<td>". $row["neighbors_id"] ."</td>".
			      		"<td>". $row["neighbors_name"] ."</td>";

			      		$test = $row["neighbors_id"];
			      		$sql2 = "SELECT * FROM neighbors_of WHERE neighbors_id = '$test'";
			      		$result2 = mysqli_query($connection, $sql2);


			      		if(mysqli_num_rows($result2) > 0)
			      		{
			      			while($row2 = mysqli_fetch_array($result2))
			      			{
			      				//echo "<td>". $row2["location_id"] ."</td>";
			      				$test2 = $row2["location_id"];
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


			      		echo "</tr>";
			      	}
			      }
			      else
			      {
			      	echo "<h3>No neighbors</h3>";
			      }
			      mysqli_close($connection);

			      ?>

			      
			    </tbody>
			  </table>
		</div>






<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>




		<div class = "container">

		<h2>Create sequence</h2>
			
		<form class = "form-horizontal">
			<div class = "form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">How many?</label>
			    <div class="col-sm-4">
			      <input type="text" class="form-control" onchange = "showUser(this.value)">
			    </div>
		    </div>
		</form>
		<br>
		<form id = "txtHint" action = "create_sequence.php" method = "post" class = "form-horizontal col-md-3"></form>


		</div>
		<br><br><br><br><br>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


<script>

function reset()
{
	location.reload();
}

</script>

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

<h1><p>Welcome <?php echo $_SESSION['username']; ?>!</p></h1>
<h1><?php echo $_SESSION['id']; ?></h1>
<h2>This is admin</h2>
<a href = "admin.php">admin.php</a><br>
<a href = "cctv.php">admin.php</a><br>
<a href = "logout.php">logout.php</a>


<?
}
?>