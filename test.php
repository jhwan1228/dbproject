<html>
	
	<head>
		
		<meta charset="utf-8">
		<title>Test</title>
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
						<li><a href = "cctv.php">CCTV</a></li>
						<li><a href = "location.php"  style = "border-bottom: 3px solid #d200ff !important;">Location</a></li>
						<li><a href = "#">Video</a></li>
						<li><a href = "#">Metalog</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<br>

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
