<?php

include("auth.php");
require("db.php");

if($_SESSION['username'] == "sadmin")
{



?>

<!--
sadmin html goes here
-->





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

		<h2>Create admin</h2>

		<form class="form-horizontal" action = "create_admin.php" method = "post">
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="email">Username:</label>
		    <div class="col-sm-6">
		      <input type="text" class="form-control" name="username" placeholder="Enter username" required/>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Password:</label>
		    <div class="col-sm-6"> 
		      <input type="password" class="form-control" name="password" placeholder="Enter password" required/>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">First name:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="fname" placeholder="Enter first name" required/>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Lastname:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="lname" placeholder="Enter last name" required/>
		    </div>
		  </div>
		  <div class="form-group">
		    <label class="control-label col-sm-2" for="pwd">Phone number:</label>
		    <div class="col-sm-6"> 
		      <input type="text" class="form-control" name="phone_number" placeholder="Phone number: 01*-********">
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
			<h2>Admin</h2>
			  <p>The .table-hover class enables a hover state on table rows:</p>            
			  <table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Admin id</th>
			        <th>Username</th>
			        <th>First name</th>
			        <th>Last name</th>
			        <th>Phone number</th>
			        <th>Settings</th>
			      </tr>
			    </thead>
			    <tbody>
			      
			      <?php
			      require("db.php");

			      $sql = "SELECT * FROM admin";
			      $result = mysqli_query($connection, $sql);

			      if(mysqli_num_rows($result) > 0)
			      {
			      	while($row = mysqli_fetch_array($result))
			      	{
			      		echo
			      		"<tr>".
			      		"<td>". $row["id"] ."</td>".
			      		"<td>". $row["username"] ."</td>".
			      		"<td>". $row["fname"] ."</td>".
			      		"<td>". $row["lname"] ."</td>".
			      		"<td>". $row["phone_number"] ."</td>".
			      		"<td>
			      		<form method = \"post\" action = \"edit_or_del_admin.php\">
			      		<input type=\"hidden\" name = \"qty\" value = \"". mysqli_num_rows($result) ."\">
			      		<button type = \"submit\" class = \"btn btn-default\" name = \"e". $row["id"] ."\" value = \"9\"><span class = \"glyphicon glyphicon-pencil\" aria-hidden = \"true\"></span></button>
<button type = \"submit\" class = \"btn btn-default\" name = \"d". $row["id"] ."\" value = \"9\"><span class = \"glyphicon glyphicon-trash\" aria-hidden = \"true\"></span></button></form>

			      		</td>"
			      		."</tr>";
			      	}
			      }
			      else
			      {
			      	echo "<h3>No admins</h3>";
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>


	</body>




</html>



<?php
}

else
{
?>

<!--
admin html goes here
-->

<h1><p>Welcome <?php echo $_SESSION['username']; ?>!</p></h1>
<h2>This is admin</h2>

<p>You do not have permission to view this page</p>
<p>Click here to return</p>
<a href = "home.php">Return</a>

<?php
}
?>


