<?php
/**
 * Created by PhpStorm.
 * User: juhyun-park
 * Date: 17. 12. 6
 * Time: 오전 3:00
 */

    include("auth.php");
    require('db.php');

    $city = $_POST['city'];
    $province = $_POST['province'];
    $bld_name = $_POST['bld_name'];
    $floor_number = $_POST['floor_number'];
    $details = $_POST['details'];

    if($city == '') {
        $city = NULL;
    }
    if ($province==''){
        $province=NULL;
    }
    if($bld_name == '') {
        $bld_name = NULL;
    }
    if($floor_number == '') {
        $floor_number = NULL;
    }
    if($details == '') {
        $details = NULL;
    }

    $sql = "SELECT * FROM location WHERE"
            ."city = '$city' OR"
            ."province = '$province' OR"
            ."bld_name='$bld_name' OR"
            ."floor_number = '$floor_number' OR"
            ."details = '$details'";

    $ret = mysqli_query($connection, $sql);
    if($ret){
        //      location search 성공.
        $arr = array();
        while ($row = mysqli_fetch_array($ret)){
            array_push($arr, $row);
        }

        print("succeeded..");

        session_start();
        $_SESSION['arr'] = $arr;

    } else{
        //      internal server error.
        print("failed..");
        header("Location: location.php");
    }

    //mysqli_close($connection);
?>