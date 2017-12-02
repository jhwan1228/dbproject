<?php

include("auth.php");
require('db.php');

if(isset($_POST['save']))
{

    $cctv_id = $_POST['cctv_id'];
    $location_details = $_POST['location_details'];
    $the_date = $_POST['the_date'];
    $the_time = $_POST['the_time'];

    //echo $cctv_id . " " .  $location_details . " " . $the_date . " " . $the_time;

    $date_array = explode("-", $the_date);
    $time_array = explode(":", $the_time);

    //print_r($date_array);
    //print_r($time_array);

    $final_time = $date_array[0] . $date_array[1] . $date_array[2] . $time_array[0] . $time_array[1] . "00";

    //echo $final_time . " ";

    $final_name = $cctv_id . "-" . $location_details . "-" . $final_time;

    $final_name_video = $final_name . ".mp4";
    $final_name_metalog = $final_name . ".csv";

    $name1 = $final_name_video;
    $name2 = $final_name_metalog;

    //echo  $final_name;

    $path1="Files/";
    $name3 = $_FILES['imageupload1']['name']; // name of the video file uploaded
    $temp1 = $_FILES['imageupload1']['tmp_name']; // 'tmp_name'
    $name4 = $_FILES['imageupload2']['name']; // name of the metalog file uploaded
    $temp2 = $_FILES['imageupload2']['tmp_name'];

    //----------//
    // read video name, and decide which folder to save to based on location
    //----------//


    // get length of string to remove extension .mp4
    $length = strlen($name1);

    // substring the string to really remove the extension .mp4
    $without_extension = substr($name1, 0, $length - 4);

    $video_extension = substr($name1, $length - 4);
    $metalog_extension = substr($name2, $length - 4);

    // explode the string in to array of 3 [cctv_id][location_details][time]
    $tr = explode("-" ,$without_extension);

    // get second string in the array and save as variable
    $cctv_file_id = $tr[0];
    $location_file_name = $tr[1];
    $time_file_start = $tr[2];

    // mkdir() in Files/
    $finalpath = $path1 . $location_file_name;
    mkdir($finalpath);

    $finalestpath = $finalpath . "/";

    $sql = "SELECT * FROM video WHERE file_name = '$without_extension'";
    $resultsql = mysqli_query($connection, $sql);
    if(mysqli_num_rows($resultsql) > 0)
    {
        echo "failed";
        //header("Location: vm.php?error=upload_failed");
    }
    else
    {

    $filesok = 0;
    if($video_extension == ".mp4" && $metalog_extension == ".csv")
    {
        $filesok = 1;
    }

    if($filesok == 1 && move_uploaded_file($temp1, $finalestpath . $name1) && move_uploaded_file($temp2, $finalestpath . $name2))
    {
        /*echo "success\n";
        echo "\$name1 = " . $name1 . "\n";
        echo "\$temp1 = " . $temp1 . "\n";
        echo "\$name2 = " . $name2 . "\n";
        echo "\$temp2 = " . $temp2 . "\n";
        echo "\$finalestpath = " . $finalestpath . "\n";*/

        $query1 = "INSERT INTO video(cctv_id, file_name) VALUES ('$cctv_file_id', '$without_extension')";
        $result1 = mysqli_query($connection, $query1);

        $query2 = "SELECT * FROM video WHERE file_name = '$without_extension'";
        $result2 = mysqli_query($connection, $query2);
        $row2 = mysqli_fetch_array($result2);
        $the_video_id = $row2['video_id'];


        $query3 = "INSERT INTO metalog(video_id, time_start) VALUES ('$the_video_id', '$time_file_start')";
        $result3 = mysqli_query($connection, $query3);

        $the_file_name = $name2;
        $myfile = fopen($finalestpath . $the_file_name, "r") or die("Unable to open file!");

        $length2 = strlen($finalestpath . $the_file_name);
        $without_extension2 = substr($the_file_name, 0, $length - 4);
        $stat_file_name = $without_extension2 . "-s.csv";

        $file_array = file($finalestpath . $the_file_name);

        $line_array1 = explode(",", $file_array[3599]);

        $the_time = $line_array1[0];
        $the_object = $line_array1[1];
        $total_x = 0;
        $total_y = 0;
        $total_size = 0;
        $total_speed = 0;

        for($i = 0; $i < 3600; $i++)
        {
            $line_array = explode(",", $file_array[$i]);
            $total_x += $line_array[2];
            $total_y += $line_array[3];
            $total_size += $line_array[4];
            $total_speed += $line_array[5];

        }

        $avg_x = $total_x / 3600;
        $avg_y = $total_y / 3600;
        $avg_size = $total_size / 3600;
        $avg_speed = $total_speed / 3600;

        $stat = $the_time . "," . $the_object . "," . $avg_x . "," . $avg_y . "," . $avg_size . "," . $avg_speed;

        $myfile2 = fopen($finalestpath . $stat_file_name, "w") or die("Unable to open file!");
        fwrite($myfile2, $stat);


        // in metalog file
        // 20170101050000,object2,55,107,200,93,Green
        // timestamp,object,x,y,size,speed,color

        // in stats file
        // timeend,object,avg(x),avg(y),avg(size),avg(speed)

        fclose($myfile);
        fclose($myfile2);



        if($result1 && $result3)
        {
            //echo "  " . "Upload to database success";
            header("Location: vm.php");
        }
        else
        {
            //echo "  " . "Upload to database failed";
            header("Location: vm.php?error=upload_failed");
        }


    }
    else
    {
        //echo "failed";
        header("Location: vm.php?error=upload_failed");
    }
    }
}
else
{
    header("Location: vm.php?error=upload_failed");
}


?>