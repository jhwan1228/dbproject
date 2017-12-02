<?php

include("auth.php");
require("db.php");

$cctv_id = $_POST['cctv_id'];
$location_details = $_POST['location_details'];
$the_date = $_POST['the_date'];
$the_time = $_POST['the_time'];

echo $cctv_id . " " .  $location_details . " " . $the_date . " " . $the_time;

$date_array = explode("-", $the_date);
$time_array = explode(":", $the_time);

print_r($date_array);
print_r($time_array);

$final_time = $date_array[0] . $date_array[1] . $date_array[2] . $time_array[0] . $time_array[1];

echo $final_time . " ";

$final_name = $cctv_id . "-" . $location_details . "-" . $final_time;

echo  $final_name;


?>