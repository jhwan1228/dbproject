<?php

include("auth.php");
require("db.php");

if($_SESSION['username'] == "sadmin")
{

if($_GET['error'] == 'exist')
{
    echo "<script type = \"text/javascript\">alert(\"Create admin failed\")</script>";
}

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

		<h2>Create admin</h2>

		<form class="form-horizontal" name = "create_admin" action = "create_admin.php" method = "post" onsubmit = "return(phone_ok());">
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
		    <label class="control-label col-sm-2" for="pwd">Last name:</label>
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
			<h2>Search admin with personal information</h2><br>
			<form class="form-inline" method = "post" action = "admin.php?go">
			  <div class="form-group">
			    <label>Username:</label>
			    <input type="text" class="form-control" name="username">
			  </div>
			  <div class="form-group">
			    <label>First name:</label>
			    <input type="text" class="form-control" name="fname">
			  </div>
			  <div class="form-group">
			    <label>Last name:</label>
			    <input type="text" class="form-control" name="lname">
			  </div>
			  <div class="form-group">
			    <label>Phone number:</label>
			    <input type="text" class="form-control" name="phone_number">
			  </div>
			  <button type="submit" name = "search_submit" class="btn btn-default" style = "margin-left: 5px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Search</button>
			</form>
		


		
			<h3>Search results</h3>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Admin id</th>
			        <th>Username</th>
			        <th>First name</th>
			        <th>Last name</th>
			        <th>Phone number</th>
			      </tr>
			    </thead>
			    <tbody>

			<?php
			if(isset($_POST['search_submit']))
			{
			if(isset($_GET['go']))
			{
				//if($_POST['model_name'])
				
				$username = $_POST['username'];
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$phone_number = $_POST['phone_number'];

				if($username && !$fname && !$lname && !$phone_number) // search username only (a)
				{
					$sql = "SELECT * FROM admin WHERE username = '$username'";
				}
				else if(!$username && $fname && !$lname && !$phone_number) // search fname only (b)
				{
					$sql = "SELECT * FROM admin WHERE fname = '$fname'";
				}
				else if(!$username && !$fname && $lname && !$phone_number) // search lname only (c)
				{
					$sql = "SELECT * FROM admin WHERE lname = '$lname'";
				}
				else if(!$username && !$fname && !$lname && $phone_number) // search phone_number only (d)
				{
					$sql = "SELECT * FROM admin WHERE phone_number = '$phone_number'";
				}
				else if($username && $fname && !$lname && !$phone_number) // search username and fname (ab)
				{
					$sql = "SELECT * FROM admin WHERE username = '$username' AND fname = '$fname'";
				}
				else if($username && !$fname && $lname && !$phone_number) // search username and lname (ac)
				{
					$sql = "SELECT * FROM admin WHERE username = '$username' AND lname = '$lname'";
				}
				else if($username && !$fname && !$lname && $phone_number) // search username and phone_number (ad)
				{
					$sql = "SELECT * FROM admin WHERE username = '$username' AND phone_number = '$phone_number'";
				}
				else if(!$username && $fname && $lname && !$phone_number) // search fname and lname (bc)
				{
					$sql = "SELECT * FROM admin WHERE fname = '$fname' AND lname = '$lname'";
				}
				else if(!$username && $fname && !$lname && $phone_number) // search fname and phone_number (bd)
				{
					$sql = "SELECT * FROM admin WHERE fname = '$fname' AND phone_number = '$phone_number'";
				}
				else if(!$username && !$fname && $lname && $phone_number) // search lname and phone_number (cd)
				{
					$sql = "SELECT * FROM admin WHERE lname = '$lname' AND phone_number = '$phone_number'";
				}
				else if($username && $fname && $lname && !$phone_number) // search username, fname and lname (abc)
				{
					$sql = "SELECT * FROM admin WHERE username = '$username' AND fname = '$fname' AND lname = '$lname'";
				}
				else if($username && $fname && !$lname && $phone_number) // search username, fname and phone_number (abd)
				{
					$sql = "SELECT * FROM admin WHERE username = '$username' AND fname = '$fname' AND phone_number = '$phone_number'";
				}
				else if($username && !$fname && $lname && $phone_number) // search username, lname, and phone_number (acd)
				{
					$sql = "SELECT * FROM admin WHERE username = '$username' AND lname = '$lname' AND phone_number = '$phone_number'";
				}
				else if(!$username && $fname && $lname && $phone_number) // search fname, lname, and phone_number (bcd)
				{
					$sql = "SELECT * FROM admin WHERE fname = '$fname' AND lname = '$lname' AND phone_number = '$phone_number'";
				}
				else if($username && $fname && $lname && $phone_number) // search username, fname, lname, and phone_number (abcd)
				{
					$sql = "SELECT * FROM admin WHERE username = '$username' AND fname = '$fname' AND lname = '$lname' AND phone_number = '$phone_number'";
				}

				


				//$sql = "SELECT * FROM cctv WHERE model_name = '$model_name'";
				$resultsql = mysqli_query($connection, $sql);
				while($row = mysqli_fetch_array($resultsql))
				{
					$result_admin_id = $row['id'];
					$result_username = $row['username'];
					$result_fname = $row['fname'];
					$result_lname = $row['lname'];
					$result_phone_number = $row['phone_number'];
					$result_cctv_id = $row['cctv_id'];
					echo
			      	"<tr>".
			      	"<td>". $result_admin_id ."</td>".
			      	"<td>". $result_username ."</td>".
			      	"<td>". $result_fname ."</td>".
			      	"<td>". $result_lname ."</td>".
			      	"<td>". $result_phone_number ."</td>".
			      	"<td>". $result_cctv_id ."</td>"
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
					echo "<a type=\"submit\" href = \"admin.php\" class=\"btn btn-primary\">Done</a>";
				}
			}
			else
			{
				echo "<p>Please enter search query</p>";
			}

			?>
		</div>



		<div class = "container">
			<h2>Search admin with cctv assigned</h2><br>
			<form class="form-inline" method = "post" action = "admin.php?gol">
			  <div class="form-group">
			    <label>CCTV assigned:</label>
			    <input type="text" class="form-control" name="cctv_id">
			  </div>
			  <button type="submit" name = "search_submit2" class="btn btn-default" style = "margin-left: 5px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Search</button>
			</form>
		
		<br>

		
			<h3>Search results</h3>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Admin id</th>
			        <th>Username</th>
			        <th>First name</th>
			        <th>Last name</th>
			        <th>Phone number</th>
			      </tr>
			    </thead>
			    <tbody>

			<?php
			if(isset($_POST['search_submit2']))
			{
			if(isset($_GET['gol']))
			{
				//if($_POST['model_name'])
				
				$cctv_id = $_POST['cctv_id'];
				
				if($cctv_id)
				{
					$sql2 = "SELECT * FROM cctv WHERE cctv_id = $cctv_id";
					$resultsql2 = mysqli_query($connection, $sql2);
					$row2 = mysqli_fetch_array($resultsql2);
					$row2_admin_id = $row2['admin_id'];
					$sql3 = "SELECT * FROM admin WHERE id = '$row2_admin_id'";
				}


				


				//$sql = "SELECT * FROM cctv WHERE model_name = '$model_name'";
				$resultsql3 = mysqli_query($connection, $sql3);
				while($row3 = mysqli_fetch_array($resultsql3))
				{
					$result_admin_id = $row3['id'];
					$result_username = $row3['username'];
					$result_fname = $row3['fname'];
					$result_lname = $row3['lname'];
					$result_phone_number = $row3['phone_number'];
					$result_cctv_id = $row3['cctv_id'];
					echo
			      	"<tr>".
			      	"<td>". $result_admin_id ."</td>".
			      	"<td>". $result_username ."</td>".
			      	"<td>". $result_fname ."</td>".
			      	"<td>". $result_lname ."</td>".
			      	"<td>". $result_phone_number ."</td>".
			      	"<td>". $result_cctv_id ."</td>"
			      	."</tr>";
				}
				
			}
			}
			?>
			</tbody>
			</table>
			<?php
			if(isset($_POST['search_submit2']))
			{
				if(isset($_GET['gol']))
				{
					echo "<a type=\"submit\" href = \"admin.php\" class=\"btn btn-primary\">Done</a>";
				}
			}
			else
			{
				echo "<p>Please enter search query</p>";
			}

			?>
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

<script>


function phone_ok()
{
	var phone_id = document.create_admin.phone_number.value;
	var length_ok = false;
	var format_ok = false;
	if(phone_id.length = 13)
		length_ok = true;
	if(phone_id.charAt(0) == '0' &&
		phone_id.charAt(1) == '1' &&
		phone_id.charAt(3) == '-' &&
		phone_id.charAt(8) == '-'
		)
		format_ok = true;
	if(length_ok && format_ok)
	{
		return true;
	}
	else
	{
		if(!length_ok)
			console.log("Phone number length not ok");
		if(!format_ok)
			console.log("Phone number format incorrect");
		return false;
	}
}


</script>


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
				            <li><a href="edit_or_del_admin.php">Change personal info</a></li>
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
			<h1><span class="glyphicon glyphicon-lock col-md-offset-4" aria-hidden="true" style = "margin-right: 30px;"></span></h1>
			<h1>You do not have permission to view this page.</h1>

		</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
     $(document).ready(function(){
        $('.dropdown-toggle').dropdown()
    });
</script>
		


	</body>

</html>

<?php
}
?>


