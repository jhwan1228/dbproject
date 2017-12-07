<?php 

include("auth.php");
require("db.php");

if($_GET['error'] == "upload_failed")
{
	echo "<script type=\"text/javascript\">alert(\"Upload failed.\")</script>";
}
if($_GET['error'] == "timefail")
{
	echo "<script type=\"text/javascript\">alert(\"Search video with time failed.\")</script>";
}

if($_SESSION['username'] == "sadmin")
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
						<li><a href = "admin.php" >Admin</a></li>
						<li><a href = "cctv.php">CCTV</a></li>
						<li><a href = "location.php">Location</a></li>
						<li class = "active"><a href = "vm.php" style = "border-bottom: 3px solid #d200ff !important;">Video + Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>

		<div class = "container">

			<h2>Upload video and metalog file</h2><br>

			<form class = "form-horizontal" method = "post" action = "upload.php" enctype = "multipart/form-data">
				<div class="form-group">
			  <label class = "control-label col-sm-2" for="sel1">Select cctv:</label>
			  <div class = "col-sm-6">
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
			  <div class = "col-sm-6">
			  <select class="form-control" name="location_details">

				<?php

				require("db.php");

				$query = "SELECT * FROM location";
				$result = mysqli_query($connection, $query);
				while($r = mysqli_fetch_array($result))
				{
					echo "<option value =" . $r['details'] . ">" . $r['details'] . "</option>";
				}

				?>
			  </select>
			  </div>
			</div>
				<div class = "form-group">
					<label class="control-label col-sm-2">Date:</label>
					<div class="col-sm-6">
						<input type="date" class="form-control" name="the_date" placeholder="Enter location" required/>
					</div>
				</div>
				<div class = "form-group">
					<label class="control-label col-sm-2">Time:</label>
					<div class="col-sm-6">
						<input type="time" class="form-control" name="the_time" placeholder="Enter location" required/>
					</div>
				</div>
				<div class = "form-group">
					<label class="control-label col-sm-2">Video:</label>
					<div class="col-sm-6">
						<input type="file" class="form-control" name="imageupload1"/>
					</div>
				</div>
				<div class = "form-group">
					<label class="control-label col-sm-2">Metalog:</label>
					<div class="col-sm-6">
						<input type="file" class="form-control" name="imageupload2"/>
					</div>
				</div>
				<div class = "form-group">
					<div class = "col-sm-offset-2 col-sm-10">
						<input class = "btn btn-default" type = "submit" name = "save" value = "Submit">
					</div>
				</div>
			    
			</form>

		</div>

		<div class = "container">
			<h2>Search video with CCTV id</h2>
			<form class="form-inline" method = "post" action = "vm.php?go">
			  <div class="form-group">
			    <label>CCTV id:</label>
			    <input type="number" class="form-control" name="cctv_id" required>
			  </div>
			  <button type="submit" name = "search_submit5" class="btn btn-default" style = "margin-left: 5px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Search</button>
			</form>
		
			<h3>Search result stats</h3>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Object total</th>
			        <th>avg(x)</th>
			        <th>avg(y)</th>
			        <th>avg(size)</th>
			        <th>avg(speed)</th>
			      </tr>
			    </thead>
			    <tbody>

			<?php
			if(isset($_POST['search_submit5']))
			{
			if(isset($_GET['go']))
			{
				//if($_POST['model_name'])
				
				$the_cctv_id = $_POST['cctv_id'];

				// stats file columns: timeend,object,avg(x),avg(y),avg(size),avg(speed) 
				// stats file example: 20170101055959,object2,42.6119444444,124.622777778,200,90.1258333333


				if($the_cctv_id) // search city only (a)
				{
					$sql = "SELECT * FROM video WHERE cctv_id = $the_cctv_id";
				}
				

				$object_total = 0;
				$x_total = 0;
				$y_total = 0;
				$size_total = 0;
				$speed_total = 0;


				//$sql = "SELECT * FROM cctv WHERE model_name = '$model_name'";
				$resultsql = mysqli_query($connection, $sql);
				while($row = mysqli_fetch_array($resultsql))
				{
					$result_file_name = $row['file_name'];
					$result_video_id = $row['video_id'];
					$result_file_name_array = explode("-", $result_file_name);
					$result_file_time = $result_file_name_array[2];

					
						$sql2 = "SELECT * FROM video WHERE video_id = $result_video_id";
						$resultsql2 = mysqli_query($connection, $sql2);
						while($row2 = mysqli_fetch_array($resultsql2))
						{
							$the_file_name = $row2["file_name"];
					      	$the_video_file = $the_file_name . ".mp4";
					      	$the_metalog_file = $the_file_name . ".csv";
					      	$the_stats_file = $the_file_name . "-s.csv";
					      	$file_name_array = explode("-", $the_file_name);
					      	$location_name = $file_name_array[1];
					      	$path_name = "Files/" . $location_name . "/";
					      	$the_video_path = $path_name . $the_video_file;
					      	$the_metalog_path = $path_name . $the_metalog_file;
					      	$the_stats_path = $path_name . $the_stats_file;
					      	$download_video = "<a href = \"" . $the_video_path . "\">" . $the_video_file . "</a>";
					      	$download_metalog = "<a href = \"" . $the_metalog_path . "\">" . $the_metalog_file . "</a>";
					      	$download_stats = "<a href = \"" . $the_stats_path . "\">" . $the_stats_file . "</a>";
					      	//echo
					      	//"<tr>".
					      	//"<td>". $row2["video_id"] ."</td>".
					      	//"<td>". $download_video ."</td>".
					      	//"<td>". $download_metalog ."</td>".
					      	//"<td>". $download_stats ."</td>".
					      	//"</tr>";
					      	//echo $the_stats_path;
					      	$myfile = fopen($the_stats_path, "r"); //or die("Unable to open file");
					      	$the_line = fgets($myfile);
					      	$line_array = explode(",", $the_line);
					      	$object_total += 1;
					      	$x_total += $line_array[2];
					      	$y_total += $line_array[3];
					      	$size_total += $line_array[4];
					      	$speed_total += $line_array[5];


					      	fclose($myfile);

							
						}

						//$final_object = $object_total;
						//$final_x = $x_total / $object_total;
						//$final_y = $y_total / $object_total;
						//$final_size = $size_total / $object_total;
						//$final_speed = $speed_total / $object_total;


						//echo
					    //"<tr>".
					    //"<td>". $final_object ."</td>".
					    //"<td>". $final_x ."</td>".
					    //"<td>". $final_y ."</td>".
					    //"<td>". $final_size ."</td>".
					    //"<td>". $final_speed ."</td>".
					    //"</tr>";
					
				}
				$final_object = $object_total;
				$final_x = $x_total / $object_total;
				$final_y = $y_total / $object_total;
				$final_size = $size_total / $object_total;
				$final_speed = $speed_total / $object_total;


				echo
				"<tr>".
				"<td>". $final_object ."</td>".
				"<td>". $final_x ."</td>".
				"<td>". $final_y ."</td>".
				"<td>". $final_size ."</td>".
				"<td>". $final_speed ."</td>".
				"</tr>";
				
			}
			}
			?>
			</tbody>
			</table>

		
			<h3>Search results</h3>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Video id</th>
			        <th>Video file</th>
			        <th>Metalog file</th>
			        <th>Stats file</th>
			      </tr>
			    </thead>
			    <tbody>

			<?php
			if(isset($_POST['search_submit5']))
			{
			if(isset($_GET['go']))
			{
				//if($_POST['model_name'])
				
				$the_cctv_id = $_POST['cctv_id'];

				


				if($the_cctv_id) // search city only (a)
				{
					$sql = "SELECT * FROM video WHERE cctv_id = $the_cctv_id";
				}
				

				


				//$sql = "SELECT * FROM cctv WHERE model_name = '$model_name'";
				$resultsql = mysqli_query($connection, $sql);
				while($row = mysqli_fetch_array($resultsql))
				{
					$result_file_name = $row['file_name'];
					$result_video_id = $row['video_id'];
					$result_file_name_array = explode("-", $result_file_name);
					$result_file_time = $result_file_name_array[2];

					
						$sql2 = "SELECT * FROM video WHERE video_id = $result_video_id";
						$resultsql2 = mysqli_query($connection, $sql2);
						while($row2 = mysqli_fetch_array($resultsql2))
						{
							$the_file_name = $row2["file_name"];
					      	$the_video_file = $the_file_name . ".mp4";
					      	$the_metalog_file = $the_file_name . ".csv";
					      	$the_stats_file = $the_file_name . "-s.csv";
					      	$file_name_array = explode("-", $the_file_name);
					      	$location_name = $file_name_array[1];
					      	$path_name = "Files/" . $location_name . "/";
					      	$the_video_path = $path_name . $the_video_file;
					      	$the_metalog_path = $path_name . $the_metalog_file;
					      	$the_stats_path = $path_name . $the_stats_file;
					      	$download_video = "<a href = \"" . $the_video_path . "\">" . $the_video_file . "</a>";
					      	$download_metalog = "<a href = \"" . $the_metalog_path . "\">" . $the_metalog_file . "</a>";
					      	$download_stats = "<a href = \"" . $the_stats_path . "\">" . $the_stats_file . "</a>";
					      	echo
					      	"<tr>".
					      	"<td>". $row2["video_id"] ."</td>".
					      	"<td>". $download_video ."</td>".
					      	"<td>". $download_metalog ."</td>".
					      	"<td>". $download_stats ."</td>".
					      	"</tr>";
							
						}
					
				}
				
			}
			}
			?>
			</tbody>
			</table>
			<?php
			if(isset($_POST['search_submit5']))
			{
				if(isset($_GET['go']))
				{
					echo "<a type=\"submit\" href = \"vm.php\" class=\"btn btn-primary\">Done</a>";
				}
			}
			else
			{
				echo "<p>Please enter search query</p>";
			}

			?>
		</div>


		<div class = "container">
			<h2>Search video with location</h2>
			<form class="form-inline" method = "post" action = "vm.php?go">
			  <div class="form-group">
			    <label>City:</label>
			    <input type="text" class="form-control" name="city">
			  </div>
			  <div class="form-group">
			    <label>Province:</label>
			    <input type="text" class="form-control" name="province">
			  </div>
			  <div class="form-group">
			    <label>Building name:</label>
			    <input type="text" class="form-control" name="bld_name">
			  </div>
			  <div class="form-group">
			    <label>Floor number:</label>
			    <input type="text" class="form-control" name="floor_number">
			  </div>
			  <div class="form-group">
			    <label>Details:</label>
			    <input type="text" class="form-control" name="details">
			  </div>
			  <button type="submit" name = "search_submit" class="btn btn-default" style = "margin-left: 5px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Search</button>
			</form>
		
			<h3>Search result stats</h3>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Object total</th>
			        <th>avg(x)</th>
			        <th>avg(y)</th>
			        <th>avg(size)</th>
			        <th>avg(speed)</th>
			      </tr>
			    </thead>
			    <tbody>

			<?php
			if(isset($_POST['search_submit']))
			{
			if(isset($_GET['go']))
			{
				//if($_POST['model_name'])
				
				$city = $_POST['city'];
				$province = $_POST['province'];
				$bld_name = $_POST['bld_name'];
				$floor_number = $_POST['floor_number'];
				$details = $_POST['details'];

				if($city && !$province && !$bld_name && !$floor_number && !$details) // search city only (a)
				{
					$sql = "SELECT * FROM location WHERE city = '$city'";
				}
				else if(!$city && $province && !$bld_name && !$floor_number && !$details) // search province only (b)
				{
					$sql = "SELECT * FROM location WHERE province = '$province'";
				}
				else if(!$city && !$province && $bld_name && !$floor_number && !$details) // search building name only (c)
				{
					$sql = "SELECT * FROM location WHERE bld_name = '$bld_name'";
				}
				else if(!$city && !$province && !$bld_name && $floor_number && !$details) // search floor number only (d)
				{
					$sql = "SELECT * FROM location WHERE floor_number = '$floor_number'";
				}
				else if(!$city && !$province && !$bld_name && !$floor_number && $details) // search details only (e)
				{
					$sql = "SELECT * FROM location WHERE details = '$details'";
				}
				else if($city && $province && !$bld_name && !$floor_number && !$details) // search city and province (ab)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province'";
				}
				else if($city && !$province && $bld_name && !$floor_number && !$details) // search city and building name (ac)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND bld_name = '$bld_name'";
				}
				else if($city && !$province && !$bld_name && $floor_number && !$details) // search city and floor number (ad)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND floor_number = '$floor_number'";
				}
				else if($city && !$province && !$bld_name && !$floor_number && $details) // search city and details (ae)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND details = '$details'";
				}
				else if(!$city && $province && $bld_name && !$floor_number && !$details) // search province and building name (bc)
				{
					$sql = "SELECT * FROM location WHERE province = '$province' AND bld_name = '$bld_name'";
				}
				else if(!$city && $province && !$bld_name && $floor_number && !$details) // search province and floor number (bd)
				{
					$sql = "SELECT * FROM location WHERE province = '$province' AND floor_number = '$floor_number'";
				}
				else if(!$city && $province && !$bld_name && !$floor_number && $details) // search province and details (be)
				{
					$sql = "SELECT * FROM location WHERE province = '$province' AND details = '$details'";
				}
				else if(!$city && !$province && $bld_name && $floor_number && !$details) // search building name and floor number (cd)
				{
					$sql = "SELECT * FROM location WHERE bld_name = '$bld_name' AND floor_number = '$floor_number'";
				}
				else if(!$city && !$province && $bld_name && !$floor_number && $details) // search building name and details (ce)
				{
					$sql = "SELECT * FROM location WHERE bld_name = '$bld_name' AND details = '$details'";
				}
				else if(!$city && !$province && !$bld_name && $floor_number && $details) // search floor_number and details (de)
				{
					$sql = "SELECT * FROM location WHERE floor_number = '$floor_number' AND details = '$details'";
				}
				else if($city && $province && $bld_name && !$floor_number && !$details) // search city, province and building name (abc)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND bld_name = '$bld_name'";
				}
				else if($city && $province && !$bld_name && $floor_number && !$details) // search city, province and floor number (abd)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND floor_number = '$floor_number'";
				}
				else if($city && $province && !$bld_name && !$floor_number && $details) // search city, province and details (abe)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND details = '$details'";
				}
				else if($city && !$province && $bld_name && $floor_number && !$details) // search city, building name, and floor number (acd)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND bld_name = '$bld_name' AND floor_number = '$floor_number'";
				}
				else if($city && !$province && $bld_name && !$floor_number && $details) // search city, building name, and details (ace)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND bld_name = '$bld_name' AND details = '$details'";
				}
				else if($city && !$province && !$bld_name && $floor_number && $details) // search city, floor number, and details (ade)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND floor_number = '$floor_number' AND details = '$details'";
				}
				else if(!$city && $province && $bld_name && $floor_number && !$details) // search province, building name, and floor number (bcd)
				{
					$sql = "SELECT * FROM location WHERE province = '$province' AND bld_name = '$bld_name' AND floor_number = '$floor_number'";
				}
				else if(!$city && $province && $bld_name && !$floor_number && $details) // search province, building name, and details (bce)
				{
					$sql = "SELECT * FROM location WHERE province = '$province' AND bld_name = '$bld_name' AND details = '$details'";
				}
				else if(!$city && !$province && $bld_name && $floor_number && $details) // search building name, floor number, and details (cde)
				{
					$sql = "SELECT * FROM location WHERE bld_name = '$bld_name' AND floor_number = '$floor_number' AND details = '$details'";
				}
				else if($city && $province && $bld_name && $floor_number && !$details) // search city, province, building name, and floor number (abcd)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND bld_name = '$bld_name' AND floor_number = '$floor_number'";
				}
				else if($city && $province && $bld_name && !$floor_number && $details) // search city, province, building name, and details (abce)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND bld_name = '$bld_name' AND details = '$details'";
				}
				else if($city && $province && $bld_name && $floor_number && $details) // search city, province, building name, floor number and details (abcde)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND bld_name = '$bld_name' AND floor_number = '$floor_number' AND details = '$details'";
				}

				$object_total = 0;
				$x_total = 0;
				$y_total = 0;
				$size_total = 0;
				$speed_total = 0;


				//$sql = "SELECT * FROM cctv WHERE model_name = '$model_name'";
				$resultsql = mysqli_query($connection, $sql);
				while($row = mysqli_fetch_array($resultsql))
				{
					$result_location_id = $row['location_id'];
					$result_city = $row['city'];
					$result_province = $row['province'];
					$result_bld_name = $row['bld_name'];
					$result_floor_number = $row['floor_number'];
					$result_details = $row['details'];

					$sql2 = "SELECT * FROM video";
					$resultsql2 = mysqli_query($connection, $sql2);
					while($row2 = mysqli_fetch_array($resultsql2))
					{
						$location_search_file_array = explode("-", $row2['file_name']);
						if($location_search_file_array[1] == $result_details)
						{
							$the_file_name = $row2["file_name"];
				      		$the_video_file = $the_file_name . ".mp4";
				      		$the_metalog_file = $the_file_name . ".csv";
				      		$the_stats_file = $the_file_name . "-s.csv";
				      		$file_name_array = explode("-", $the_file_name);
				      		$location_name = $file_name_array[1];
				      		$path_name = "Files/" . $location_name . "/";
				      		$the_video_path = $path_name . $the_video_file;
				      		$the_metalog_path = $path_name . $the_metalog_file;
				      		$the_stats_path = $path_name . $the_stats_file;
				      		$download_video = "<a href = \"" . $the_video_path . "\">" . $the_video_file . "</a>";
				      		$download_metalog = "<a href = \"" . $the_metalog_path . "\">" . $the_metalog_file . "</a>";
				      		$download_stats = "<a href = \"" . $the_stats_path . "\">" . $the_stats_file . "</a>";

				      		$myfile = fopen($the_stats_path, "r"); //or die("Unable to open file");
					      	$the_line = fgets($myfile);
					      	$line_array = explode(",", $the_line);
					      	$object_total += 1;
					      	$x_total += $line_array[2];
					      	$y_total += $line_array[3];
					      	$size_total += $line_array[4];
					      	$speed_total += $line_array[5];


					      	fclose($myfile);
						}
					}
				}
				$final_object = $object_total;
				$final_x = $x_total / $object_total;
				$final_y = $y_total / $object_total;
				$final_size = $size_total / $object_total;
				$final_speed = $speed_total / $object_total;


				echo
				"<tr>".
				"<td>". $final_object ."</td>".
				"<td>". $final_x ."</td>".
				"<td>". $final_y ."</td>".
				"<td>". $final_size ."</td>".
				"<td>". $final_speed ."</td>".
				"</tr>";
				
			}
			}
			?>
			</tbody>
			</table>
		
			<h3>Search results</h3>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Video id</th>
			        <th>Video file</th>
			        <th>Metalog file</th>
			        <th>Stats file</th>
			      </tr>
			    </thead>
			    <tbody>

			<?php
			if(isset($_POST['search_submit']))
			{
			if(isset($_GET['go']))
			{
				//if($_POST['model_name'])
				
				$city = $_POST['city'];
				$province = $_POST['province'];
				$bld_name = $_POST['bld_name'];
				$floor_number = $_POST['floor_number'];
				$details = $_POST['details'];

				if($city && !$province && !$bld_name && !$floor_number && !$details) // search city only (a)
				{
					$sql = "SELECT * FROM location WHERE city = '$city'";
				}
				else if(!$city && $province && !$bld_name && !$floor_number && !$details) // search province only (b)
				{
					$sql = "SELECT * FROM location WHERE province = '$province'";
				}
				else if(!$city && !$province && $bld_name && !$floor_number && !$details) // search building name only (c)
				{
					$sql = "SELECT * FROM location WHERE bld_name = '$bld_name'";
				}
				else if(!$city && !$province && !$bld_name && $floor_number && !$details) // search floor number only (d)
				{
					$sql = "SELECT * FROM location WHERE floor_number = '$floor_number'";
				}
				else if(!$city && !$province && !$bld_name && !$floor_number && $details) // search details only (e)
				{
					$sql = "SELECT * FROM location WHERE details = '$details'";
				}
				else if($city && $province && !$bld_name && !$floor_number && !$details) // search city and province (ab)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province'";
				}
				else if($city && !$province && $bld_name && !$floor_number && !$details) // search city and building name (ac)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND bld_name = '$bld_name'";
				}
				else if($city && !$province && !$bld_name && $floor_number && !$details) // search city and floor number (ad)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND floor_number = '$floor_number'";
				}
				else if($city && !$province && !$bld_name && !$floor_number && $details) // search city and details (ae)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND details = '$details'";
				}
				else if(!$city && $province && $bld_name && !$floor_number && !$details) // search province and building name (bc)
				{
					$sql = "SELECT * FROM location WHERE province = '$province' AND bld_name = '$bld_name'";
				}
				else if(!$city && $province && !$bld_name && $floor_number && !$details) // search province and floor number (bd)
				{
					$sql = "SELECT * FROM location WHERE province = '$province' AND floor_number = '$floor_number'";
				}
				else if(!$city && $province && !$bld_name && !$floor_number && $details) // search province and details (be)
				{
					$sql = "SELECT * FROM location WHERE province = '$province' AND details = '$details'";
				}
				else if(!$city && !$province && $bld_name && $floor_number && !$details) // search building name and floor number (cd)
				{
					$sql = "SELECT * FROM location WHERE bld_name = '$bld_name' AND floor_number = '$floor_number'";
				}
				else if(!$city && !$province && $bld_name && !$floor_number && $details) // search building name and details (ce)
				{
					$sql = "SELECT * FROM location WHERE bld_name = '$bld_name' AND details = '$details'";
				}
				else if(!$city && !$province && !$bld_name && $floor_number && $details) // search floor_number and details (de)
				{
					$sql = "SELECT * FROM location WHERE floor_number = '$floor_number' AND details = '$details'";
				}
				else if($city && $province && $bld_name && !$floor_number && !$details) // search city, province and building name (abc)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND bld_name = '$bld_name'";
				}
				else if($city && $province && !$bld_name && $floor_number && !$details) // search city, province and floor number (abd)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND floor_number = '$floor_number'";
				}
				else if($city && $province && !$bld_name && !$floor_number && $details) // search city, province and details (abe)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND details = '$details'";
				}
				else if($city && !$province && $bld_name && $floor_number && !$details) // search city, building name, and floor number (acd)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND bld_name = '$bld_name' AND floor_number = '$floor_number'";
				}
				else if($city && !$province && $bld_name && !$floor_number && $details) // search city, building name, and details (ace)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND bld_name = '$bld_name' AND details = '$details'";
				}
				else if($city && !$province && !$bld_name && $floor_number && $details) // search city, floor number, and details (ade)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND floor_number = '$floor_number' AND details = '$details'";
				}
				else if(!$city && $province && $bld_name && $floor_number && !$details) // search province, building name, and floor number (bcd)
				{
					$sql = "SELECT * FROM location WHERE province = '$province' AND bld_name = '$bld_name' AND floor_number = '$floor_number'";
				}
				else if(!$city && $province && $bld_name && !$floor_number && $details) // search province, building name, and details (bce)
				{
					$sql = "SELECT * FROM location WHERE province = '$province' AND bld_name = '$bld_name' AND details = '$details'";
				}
				else if(!$city && !$province && $bld_name && $floor_number && $details) // search building name, floor number, and details (cde)
				{
					$sql = "SELECT * FROM location WHERE bld_name = '$bld_name' AND floor_number = '$floor_number' AND details = '$details'";
				}
				else if($city && $province && $bld_name && $floor_number && !$details) // search city, province, building name, and floor number (abcd)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND bld_name = '$bld_name' AND floor_number = '$floor_number'";
				}
				else if($city && $province && $bld_name && !$floor_number && $details) // search city, province, building name, and details (abce)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND bld_name = '$bld_name' AND details = '$details'";
				}
				else if($city && $province && $bld_name && $floor_number && $details) // search city, province, building name, floor number and details (abcde)
				{
					$sql = "SELECT * FROM location WHERE city = '$city' AND province = '$province' AND bld_name = '$bld_name' AND floor_number = '$floor_number' AND details = '$details'";
				}

				


				//$sql = "SELECT * FROM cctv WHERE model_name = '$model_name'";
				$resultsql = mysqli_query($connection, $sql);
				while($row = mysqli_fetch_array($resultsql))
				{
					$result_location_id = $row['location_id'];
					$result_city = $row['city'];
					$result_province = $row['province'];
					$result_bld_name = $row['bld_name'];
					$result_floor_number = $row['floor_number'];
					$result_details = $row['details'];

					$sql2 = "SELECT * FROM video";
					$resultsql2 = mysqli_query($connection, $sql2);
					while($row2 = mysqli_fetch_array($resultsql2))
					{
						$location_search_file_array = explode("-", $row2['file_name']);
						if($location_search_file_array[1] == $result_details)
						{
							$the_file_name = $row2["file_name"];
				      		$the_video_file = $the_file_name . ".mp4";
				      		$the_metalog_file = $the_file_name . ".csv";
				      		$the_stats_file = $the_file_name . "-s.csv";
				      		$file_name_array = explode("-", $the_file_name);
				      		$location_name = $file_name_array[1];
				      		$path_name = "Files/" . $location_name . "/";
				      		$the_video_path = $path_name . $the_video_file;
				      		$the_metalog_path = $path_name . $the_metalog_file;
				      		$the_stats_path = $path_name . $the_stats_file;
				      		$download_video = "<a href = \"" . $the_video_path . "\">" . $the_video_file . "</a>";
				      		$download_metalog = "<a href = \"" . $the_metalog_path . "\">" . $the_metalog_file . "</a>";
				      		$download_stats = "<a href = \"" . $the_stats_path . "\">" . $the_stats_file . "</a>";
				      		echo
				      		"<tr>".
				      		"<td>". $row2["video_id"] ."</td>".
				      		"<td>". $download_video ."</td>".
				      		"<td>". $download_metalog ."</td>".
				      		"<td>". $download_stats ."</td>".
				      		"</tr>";
						}
					}
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
					echo "<a type=\"submit\" href = \"vm.php\" class=\"btn btn-primary\">Done</a>";
				}
			}
			else
			{
				echo "<p>Please enter search query</p>";
			}

			?>
		</div>


		<div class = "container">
			<h2>Search video with time</h2>
			<form class="form-inline" method = "post" action = "vm.php?go">
			  <div class="form-group">
			    <label>Date:</label>
			    <input type="date" class="form-control" name="date" required>
			  </div>
			  <div class="form-group">
			    <label>Time start:</label>
			    <input type="time" class="form-control" name="time1" required>
			  </div>
			  <div class="form-group">
			    <label>Time end:</label>
			    <input type="time" class="form-control" name="time2" required>
			  </div>
			  <button type="submit" name = "search_submit3" class="btn btn-default" style = "margin-left: 5px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Search</button>
			</form>
		
		
			<h3>Search results</h3>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Video id</th>
			        <th>Video file</th>
			        <th>Metalog file</th>
			        <th>Stats file</th>
			      </tr>
			    </thead>
			    <tbody>

			<?php
			if(isset($_POST['search_submit3']))
			{
			if(isset($_GET['go']))
			{
				//if($_POST['model_name'])
				
				$date_before = $_POST['date'];
				$time_before1 = $_POST['time1'];
				$time_before2 = $_POST['time2'];

				$date_before_array = explode("-", $date_before);
				$date_after = $date_before_array[0] . $date_before_array[1] . $date_before_array[2];

				$time_before_array1 = explode(":", $time_before1);
				$time_after1 = $time_before_array1[0] . $time_before_array1[1];

				$time_before_array2 = explode(":", $time_before2);
				$time_after2 = $time_before_array2[0] . $time_before_array2[1];

				$timeall1 = $date_after . $time_after1 . "00";
				$timeall2 = $date_after . $time_after2 . "00";

				//echo "<h1>" . $time_after1 . " " . $time_after2 . "</h1>";

				if($time_after2 > $time_after1)
				{
					$j = $time_after1 - 100;
					for($i = $j + 100; $i < $time_after2; $i += 100)
					{
						$time_index = $date_after . "0" . $i . "00";
						//echo "<h1>" . $time_index . "</h1>";

						if($date_before && $time_before1 && $time_before2) // search city only (a)
						{
							$sql = "SELECT * FROM video";
							$resultsql = mysqli_query($connection, $sql);
							while($row = mysqli_fetch_array($resultsql))
							{
								$result_file_name = $row['file_name'];
								$result_video_id = $row['video_id'];
								$result_file_name_array = explode("-", $result_file_name);
								$result_file_time = $result_file_name_array[2];
								//echo "the_result = " . $result_file_time . " ";
								//echo "the_time = " . $time_index . " ";

								if($result_file_time == $time_index)
								{
									//echo $timeall1 . " ";
									$sql2 = "SELECT * FROM video WHERE video_id = $result_video_id";
									$resultsql2 = mysqli_query($connection, $sql2);
									while($row2 = mysqli_fetch_array($resultsql2))
									{
										//$location_search_file_array = explode("-", $row2['file_name']);
										//if($location_search_file_array[1] == $result_details)
										//{
											$the_file_name = $row2["file_name"];
								      		$the_video_file = $the_file_name . ".mp4";
								      		$the_metalog_file = $the_file_name . ".csv";
								      		$the_stats_file = $the_file_name . "-s.csv";
								      		$file_name_array = explode("-", $the_file_name);
								      		$location_name = $file_name_array[1];
								      		$path_name = "Files/" . $location_name . "/";
								      		$the_video_path = $path_name . $the_video_file;
								      		$the_metalog_path = $path_name . $the_metalog_file;
								      		$the_stats_path = $path_name . $the_stats_file;
								      		$download_video = "<a href = \"" . $the_video_path . "\">" . $the_video_file . "</a>";
								      		$download_metalog = "<a href = \"" . $the_metalog_path . "\">" . $the_metalog_file . "</a>";
								      		$download_stats = "<a href = \"" . $the_stats_path . "\">" . $the_stats_file . "</a>";
								      		echo
								      		"<tr>".
								      		"<td>". $row2["video_id"] ."</td>".
								      		"<td>". $download_video ."</td>".
								      		"<td>". $download_metalog ."</td>".
								      		"<td>". $download_stats ."</td>".
								      		"</tr>";
										//}
									}
								}
							}
						}



					}
					//echo "<h1>Yes</h1>";
				}
				//else($time_after1 > $time_after2)
				//{
					header("Location: vm.php?error=timefail");
				//}

				
				
			}
			}
			?>
			</tbody>
			</table>
			<?php
			if(isset($_POST['search_submit3']))
			{
				if(isset($_GET['go']))
				{
					echo "<a type=\"submit\" href = \"vm.php\" class=\"btn btn-primary\">Done</a>";
				}
			}
			else
			{
				echo "<p>Please enter search query</p>";
			}

			?>
		</div>


		<div class = "container">
			<h2>Search video with sequence</h2>
			<form class="form-inline" method = "post" action = "vm.php?go">
			  <div class="form-group">
			    <label>Sequence name:</label>
			    <input type="text" class="form-control" name="sequence_name">
			  </div>
			  <button type="submit" name = "search_submit2" class="btn btn-default" style = "margin-left: 5px;"><span class="glyphicon glyphicon-search" aria-hidden="true"></span>  Search</button>
			</form>
			
			<h3>Search result stats</h3>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Object total</th>
			        <th>avg(x)</th>
			        <th>avg(y)</th>
			        <th>avg(size)</th>
			        <th>avg(speed)</th>
			      </tr>
			    </thead>
			    <tbody>

			<?php
			if(isset($_POST['search_submit2']))
			{
			if(isset($_GET['go']))
			{
				//if($_POST['model_name'])
				
				$sequence_name = $_POST['sequence_name'];

				if($sequence_name)
				{
					$sql3 = "SELECT * FROM sequence WHERE sequence_name = '$sequence_name'";
				}
				

				$object_total = 0;
				$x_total = 0;
				$y_total = 0;
				$size_total = 0;
				$speed_total = 0;


				//$sql = "SELECT * FROM cctv WHERE model_name = '$model_name'";
				$resultsql3 = mysqli_query($connection, $sql3);
				while($row3 = mysqli_fetch_array($resultsql3))
				{
					$neighbors_list_substring = substr($row3['neighbors_list'], 1);
					$result_neighbors_list_array = explode("-", $neighbors_list_substring);
					$total_result_neighbors_list_array = count($result_neighbors_list_array);
					//echo "success 1";

					for($i = 0; $i < $total_result_neighbors_list_array; $i++)
					{
						$the_result_neighbors_list_array = $result_neighbors_list_array[$i];
						$sql4 = "SELECT * FROM neighbors_of WHERE neighbors_id = $the_result_neighbors_list_array";
						$resultsql4 = mysqli_query($connection, $sql4);
						//echo "success 2";
						//echo $result_neighbors_list_array[$i];
						while($row4 = mysqli_fetch_array($resultsql4))
						{
							//echo "success 3";
							$the_row4_location_id = $row4['location_id'];
							$sql5 = "SELECT * FROM location WHERE location_id = $the_row4_location_id";
							$resultsql5 = mysqli_query($connection, $sql5);
							while($row5 = mysqli_fetch_array($resultsql5))
							{
								//echo "success 4";
								$result_details = $row5['details'];
								$sql2 = "SELECT * FROM video";
								$resultsql2 = mysqli_query($connection, $sql2);
								while($row2 = mysqli_fetch_array($resultsql2))
								{
									//echo "success 4";
									$location_search_file_array = explode("-", $row2['file_name']);
									if($location_search_file_array[1] == $result_details)
									{
										//echo "success 5";
										$the_file_name = $row2["file_name"];
							      		$the_video_file = $the_file_name . ".mp4";
							      		$the_metalog_file = $the_file_name . ".csv";
							      		$the_stats_file = $the_file_name . "-s.csv";
							      		$file_name_array = explode("-", $the_file_name);
							      		$location_name = $file_name_array[1];
							      		$path_name = "Files/" . $location_name . "/";
							      		$the_video_path = $path_name . $the_video_file;
							      		$the_metalog_path = $path_name . $the_metalog_file;
							      		$the_stats_path = $path_name . $the_stats_file;
							      		$download_video = "<a href = \"" . $the_video_path . "\">" . $the_video_file . "</a>";
							      		$download_metalog = "<a href = \"" . $the_metalog_path . "\">" . $the_metalog_file . "</a>";
							      		$download_stats = "<a href = \"" . $the_stats_path . "\">" . $the_stats_file . "</a>";
							      		$myfile = fopen($the_stats_path, "r"); //or die("Unable to open file");
								      	$the_line = fgets($myfile);
								      	$line_array = explode(",", $the_line);
								      	$object_total += 1;
								      	$x_total += $line_array[2];
								      	$y_total += $line_array[3];
								      	$size_total += $line_array[4];
								      	$speed_total += $line_array[5];


								      	fclose($myfile);
									}
								}
							}
						}
					}


					
				}
				$final_object = $object_total;
				$final_x = $x_total / $object_total;
				$final_y = $y_total / $object_total;
				$final_size = $size_total / $object_total;
				$final_speed = $speed_total / $object_total;


				echo
				"<tr>".
				"<td>". $final_object ."</td>".
				"<td>". $final_x ."</td>".
				"<td>". $final_y ."</td>".
				"<td>". $final_size ."</td>".
				"<td>". $final_speed ."</td>".
				"</tr>";
				
			}
			}
			?>
			</tbody>
			</table>	

		
			<h3>Search results</h3>

			<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Video id</th>
			        <th>Video file</th>
			        <th>Metalog file</th>
			        <th>Stats file</th>
			      </tr>
			    </thead>
			    <tbody>

			<?php
			if(isset($_POST['search_submit2']))
			{
			if(isset($_GET['go']))
			{
				//if($_POST['model_name'])
				
				$sequence_name = $_POST['sequence_name'];

				if($sequence_name)
				{
					$sql3 = "SELECT * FROM sequence WHERE sequence_name = '$sequence_name'";
				}
				

				


				//$sql = "SELECT * FROM cctv WHERE model_name = '$model_name'";
				$resultsql3 = mysqli_query($connection, $sql3);
				while($row3 = mysqli_fetch_array($resultsql3))
				{
					$neighbors_list_substring = substr($row3['neighbors_list'], 1);
					$result_neighbors_list_array = explode("-", $neighbors_list_substring);
					$total_result_neighbors_list_array = count($result_neighbors_list_array);
					echo "success1" . " ";

					for($i = 0; $i < $total_result_neighbors_list_array; $i++)
					{
						$the_result_neighbors_list_array = $result_neighbors_list_array[$i];
						$sql4 = "SELECT * FROM neighbors_of WHERE neighbors_id = $the_result_neighbors_list_array";
						$resultsql4 = mysqli_query($connection, $sql4);
						echo "success2" . " ";
						//echo $result_neighbors_list_array[$i];
						while($row4 = mysqli_fetch_array($resultsql4))
						{
							echo "success3" . " ";
							$the_row4_location_id = $row4['location_id'];
							$sql5 = "SELECT * FROM location WHERE location_id = $the_row4_location_id";
							$resultsql5 = mysqli_query($connection, $sql5);
							while($row5 = mysqli_fetch_array($resultsql5))
							{
								echo "success4" . " ";
								$result_details = $row5['details'];
								$sql2 = "SELECT * FROM video";
								$resultsql2 = mysqli_query($connection, $sql2);
								while($row2 = mysqli_fetch_array($resultsql2))
								{
									echo "success4" . " ";
									$location_search_file_array = explode("-", $row2['file_name']);
									if($location_search_file_array[1] == $result_details)
									{
										echo "success5" . " ";
										$the_file_name = $row2["file_name"];
							      		$the_video_file = $the_file_name . ".mp4";
							      		$the_metalog_file = $the_file_name . ".csv";
							      		$the_stats_file = $the_file_name . "-s.csv";
							      		$file_name_array = explode("-", $the_file_name);
							      		$location_name = $file_name_array[1];
							      		$path_name = "Files/" . $location_name . "/";
							      		$the_video_path = $path_name . $the_video_file;
							      		$the_metalog_path = $path_name . $the_metalog_file;
							      		$the_stats_path = $path_name . $the_stats_file;
							      		$download_video = "<a href = \"" . $the_video_path . "\">" . $the_video_file . "</a>";
							      		$download_metalog = "<a href = \"" . $the_metalog_path . "\">" . $the_metalog_file . "</a>";
							      		$download_stats = "<a href = \"" . $the_stats_path . "\">" . $the_stats_file . "</a>";
							      		echo
							      		"<tr>".
							      		"<td>". $row2["video_id"] ."</td>".
							      		"<td>". $download_video ."</td>".
							      		"<td>". $download_metalog ."</td>".
							      		"<td>". $download_stats ."</td>".
							      		"</tr>";
									}
								}
							}
						}
					}


					
				}
				
			}
			}
			?>
			</tbody>
			</table>
			<?php
			if(isset($_POST['search_submit2']))
			{
				if(isset($_GET['go']))
				{
					echo "<a type=\"submit\" href = \"vm.php\" class=\"btn btn-primary\">Done</a>";
				}
			}
			else
			{
				echo "<p>Please enter search query</p>";
			}

			?>
		</div>



		<div class = "container">

			<h2>Video table</h2>
			
			  <p>The .table-hover class enables a hover state on table rows:</p>            
			  <table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Video id</th>
			        <th>Video File</th>
			        <th>Metalog File</th>
			        <th>Stats File</th>
			      </tr>
			    </thead>
			    <tbody>
			      

			    <?php
			      require("db.php");

			      $sql = "SELECT * FROM video";
			      $result = mysqli_query($connection, $sql);

			      if(mysqli_num_rows($result) > 0)
			      {
			      	while($row = mysqli_fetch_array($result))
			      	{
			      		$the_file_name = $row["file_name"];
			      		$the_video_file = $the_file_name . ".mp4";
			      		$the_metalog_file = $the_file_name . ".csv";
			      		$the_stats_file = $the_file_name . "-s.csv";
			      		$file_name_array = explode("-", $the_file_name);
			      		$location_name = $file_name_array[1];
			      		$path_name = "Files/" . $location_name . "/";
			      		$the_video_path = $path_name . $the_video_file;
			      		$the_metalog_path = $path_name . $the_metalog_file;
			      		$the_stats_path = $path_name . $the_stats_file;
			      		$download_video = "<a href = \"" . $the_video_path . "\">" . $the_video_file . "</a>";
			      		$download_metalog = "<a href = \"" . $the_metalog_path . "\">" . $the_metalog_file . "</a>";
			      		$download_stats = "<a href = \"" . $the_stats_path . "\">" . $the_stats_file . "</a>";
			      		echo
			      		"<tr>".
			      		"<td>". $row["video_id"] ."</td>".
			      		"<td>". $download_video ."</td>".
			      		"<td>". $download_metalog ."</td>".
			      		"<td>". $download_stats ."</td>".
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
else
{

?>


<!-- admin html goes here-->

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
						<li><a href = "#">Home</a></li>
						<li><a href = "admin.php" >Admin</a></li>
						<li><a href = "cctv.php">CCTV</a></li>
						<li><a href = "location.php">Location</a></li>
						<li class = "active"><a href = "#" style = "border-bottom: 3px solid #d200ff !important;">Video + Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>

		<div class = "container">

			<h2>Upload video and metalog file</h2><br>

			<form class = "form-horizontal" method = "post" action = "upload.php" enctype = "multipart/form-data">
				<div class="form-group">
			  <label class = "control-label col-sm-2" for="sel1">Select cctv:</label>
			  <div class = "col-sm-6">
			  <select class="form-control" name="cctv_id">

				<?php

				require("db.php");
				$the_id = $_SESSION['id'];
				$query = "SELECT * FROM cctv WHERE admin_id = $the_id";
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
			  <div class = "col-sm-6">
			  <select class="form-control" name="location_details">

				<?php

				require("db.php");

				$query = "SELECT * FROM location";
				$result = mysqli_query($connection, $query);
				while($r = mysqli_fetch_array($result))
				{
					echo "<option value =" . $r['details'] . ">" . $r['details'] . "</option>";
				}

				?>
			  </select>
			  </div>
			</div>
				<div class = "form-group">
					<label class="control-label col-sm-2">Date:</label>
					<div class="col-sm-6">
						<input type="date" class="form-control" name="the_date" placeholder="Enter location" required/>
					</div>
				</div>
				<div class = "form-group">
					<label class="control-label col-sm-2">Time:</label>
					<div class="col-sm-6">
						<input type="time" class="form-control" name="the_time" placeholder="Enter location" required/>
					</div>
				</div>
				<div class = "form-group">
					<label class="control-label col-sm-2">Video:</label>
					<div class="col-sm-6">
						<input type="file" class="form-control" name="imageupload1"/>
					</div>
				</div>
				<div class = "form-group">
					<label class="control-label col-sm-2">Metalog:</label>
					<div class="col-sm-6">
						<input type="file" class="form-control" name="imageupload2"/>
					</div>
				</div>
				<div class = "form-group">
					<div class = "col-sm-offset-2 col-sm-10">
						<input class = "btn btn-default" type = "submit" name = "save" value = "Submit">
					</div>
				</div>
			    
			</form>

		</div>

		<div class = "container">

			<h2>Video table</h2>
			
			  <p>The .table-hover class enables a hover state on table rows:</p>            
			  <table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Video id</th>
			        <th>Video File</th>
			        <th>Metalog File</th>
			        <th>Stats File</th>
			      </tr>
			    </thead>
			    <tbody>
			      

			    <?php
			      require("db.php");

			      $query1 = "SELECT * FROM cctv WHERE admin_id = $the_id";
			      $result1 = mysqli_query($connection, $query1);
			      if(mysqli_num_rows($result1) > 0)
			      {
			      	while($r1 = mysqli_fetch_array($result1))
			      	{
			      		$the_cctv_id = $r1['cctv_id'];
			      		//echo "<h1>" . $the_cctv_id . "</h1>";
			      		$sql = "SELECT * FROM video WHERE cctv_id = $the_cctv_id";
					      $resultsql = mysqli_query($connection, $sql);

					      if(mysqli_num_rows($resultsql) > 0)
					      {
					      	while($row = mysqli_fetch_array($resultsql))
					      	{
					      		$the_file_name = $row["file_name"];
					      		$the_video_file = $the_file_name . ".mp4";
					      		$the_metalog_file = $the_file_name . ".csv";
					      		$the_stats_file = $the_file_name . "-s.csv";
					      		$file_name_array = explode("-", $the_file_name);
					      		$location_name = $file_name_array[1];
					      		$path_name = "Files/" . $location_name . "/";
					      		$the_video_path = $path_name . $the_video_file;
					      		$the_metalog_path = $path_name . $the_metalog_file;
					      		$the_stats_path = $path_name . $the_stats_file;
					      		$download_video = "<a href = \"" . $the_video_path . "\">" . $the_video_file . "</a>";
					      		$download_metalog = "<a href = \"" . $the_metalog_path . "\">" . $the_metalog_file . "</a>";
					      		$download_stats = "<a href = \"" . $the_stats_path . "\">" . $the_stats_file . "</a>";
					      		echo
					      		"<tr>".
					      		"<td>". $row["video_id"] ."</td>".
					      		"<td>". $download_video ."</td>".
					      		"<td>". $download_metalog ."</td>".
					      		"<td>". $download_stats ."</td>".
					      		"</tr>";
					      	}
					      }
					      else
					      {
					      	echo "<h3>No videos</h3>";
					      }
			      	}
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
?>