<?php

include("auth.php");
require('db.php');

if(isset($_POST['save']))
{

	$path = "Files/";
	$name = $_FILES['cctvupload']['name']; // name of the video file uploaded
    $temp = $_FILES['cctvupload']['tmp_name']; // 'tmp_name'

    $length = strlen($name);
    $file_extension = substr($name, $length - 4);

    $filesok = 0;
    if($file_extension == ".csv")
    {
    	$filesok = 1;
    }
    if($filesok == 1 && move_uploaded_file($temp, $path . $name))
    {
    	$myfile = fopen($path . $name, "r") or die("Unable to open file!");
    	//echo "hi";
    	$file_array = file($path . $name);



    	$total_file_array = count($file_array);



    	

    	for($i = 0; $i < $total_file_array; $i++)
    	{
    		$line_file_array = explode(",", $file_array[$i]);
    		$the_model_name = $line_file_array[0];
	    	$the_installation_date = $line_file_array[1];
	    	$the_admin_incharge = $line_file_array[2];
	    	print_r($line_file_array);

	    	$sql = "INSERT INTO cctv(model_name, installation_date, admin_id) VALUES ('$the_model_name', '$the_installation_date', '$the_admin_incharge')";
	    	$result = mysqli_query($connection, $sql);

    	}
    	if($result)
    	{
    		header("Location: cctv.php");
    	}

    	fclose($myfile);



    }

}


?>