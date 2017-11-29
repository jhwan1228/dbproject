<?php

$connection = mysqli_connect('165.132.105.47', 'database2017', 'db20170101');


if (!$connection)
{
    die("Database connection failed" . mysqli_error());
}



$select_db = mysqli_select_db($connection,'database2017');


if (!$select_db)
{
    die("Database Selection Failed" . mysqli_error());
}


$table1 = "
CREATE TABLE if NOT EXISTS admin (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(150) NOT NULL 	UNIQUE,
    password VARCHAR(180) NOT NULL,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    phone_number VARCHAR(50) DEFAULT NULL,
    is_sadmin INT(1) NOT NULL
);

";

$table2 = "

CREATE TABLE if NOT EXISTS cctv (
    cctv_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    model_name VARCHAR(100) NOT NULL,
    installation_date VARCHAR(50) NOT NULL,
    admin_id INT,
    FOREIGN KEY(admin_id) REFERENCES admin(id)
);

";

$table3 = "

CREATE TABLE if NOT EXISTS location (
    location_id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,	
    city VARCHAR(100),
    province VARCHAR(100),
    bld_name VARCHAR(100),
    floor_number VARCHAR(100),
    details VARCHAR(100) NOT NULL
);

";


$table4 = "

CREATE TABLE if NOT EXISTS neighbors (
    neighbors_id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    neighbors_name VARCHAR(100) UNIQUE
);

";




$table5 = "

CREATE TABLE if NOT EXISTS sequence (
    sequence_id INT(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sequence_name VARCHAR(100) UNIQUE,
    neighbors_list VARCHAR(100)
);

";


$table6 = "

CREATE TABLE if NOT EXISTS captures (
    cctv_id INT,
    location_id INT,
    FOREIGN KEY(cctv_id) REFERENCES cctv(cctv_id),
    FOREIGN KEY(location_id) REFERENCES location(location_id)
);

";

$table7 = "

CREATE TABLE if NOT EXISTS neighbors_of(
    location_id INT,
    neighbors_id INT,
    FOREIGN KEY(location_id) REFERENCES location(location_id),
    FOREIGN KEY(neighbors_id) REFERENCES neighbors(neighbors_id)
);

";

$table8 = "

CREATE TABLE if NOT EXISTS video(
    video_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cctv_id INT NOT NULL,
    file_name VARCHAR(255) UNIQUE,
    FOREIGN KEY(cctv_id) REFERENCES cctv(cctv_id)
);

";

$table9 = "

CREATE TABLE if NOT EXISTS metalog(
    video_id INT NOT NULL,
    time_start VARCHAR(100),
    time_end VARCHAR(100),
    FOREIGN KEY(video_id) REFERENCES video(video_id)
);

";


if(!mysqli_query($connection, $table1))
{
	die("Table 1 (admin) creation failed. " . mysqli_error($connection));
}


if(!mysqli_query($connection, $table2))
{
	die("Table 2 (cctv) creation failed" . mysqli_error($connection));
}

if(!mysqli_query($connection, $table3))
{
	die("Table 3 (location) creation failed" . mysqli_error($connection));
}

if(!mysqli_query($connection, $table4))
{
	die("Table 4 (neighbors) creation failed" . mysqli_error($connection));
}

if(!mysqli_query($connection, $table5))
{
	die("Table 5 (sequence) creation failed" . mysqli_error($connection));
}

if(!mysqli_query($connection, $table6))
{
	die("Table 6 (captures) creation failed" . mysqli_error($connection));
}

if(!mysqli_query($connection, $table7))
{
	die("Table 7 (neighbors_of) creation failed" . mysqli_error($connection));
}

if(!mysqli_query($connection, $table8))
{
	die("Table 8 (video) creation failed" . mysqli_error($connection));
}

if(!mysqli_query($connection, $table9))
{
	die("Table 9 (metalog) creation failed" . mysqli_error($connection));
}


?>
