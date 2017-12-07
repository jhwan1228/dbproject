<?php
/**
 * Created by PhpStorm.
 * User: juhyun-park
 * Date: 17. 12. 6
 * Time: 오후 11:00
 */

    include ("auth.php");
    require ("db.php");

    $loc1_id = $_POST['loc1_id'];
    $loc2_id = $_POST['loc2_id'];
    $id1 = $loc1_id;
    $id2 = $loc2_id;

    $NN = $_POST['neigh_name'];


    if($NN==''){
        if($id1==0 || $id2==0){
            header("Location: location.php?error=INDEX");
        }
        if($id1 == $id2){
            header("Location: location.php?error=DUP");
        }

        $sql = "SELECT * FROM (SELECT A.location_id id1, B.location_id id2, B.neighbors_id FROM neighbors_of as A, neighbors_of as B WHERE A.neighbors_id = B.neighbors_id) C WHERE C.id1 = $id1 AND C.id2 = $id2";
        $ret = mysqli_query($connection, $sql);
        if($ret){
            if(mysqli_num_rows($ret)==0){
                header("Location: location.php?error=CANT");
            }
        } else{
            //      internal server error.
            exit();
        }

        $row = mysqli_fetch_array($ret);
        $_SESSION['row']=$row;
        header("Location: location.php");
    } else{
        $sql = "SELECT * from neighbors WHERE neighbors_name = '".$NN."'";
        $ret=mysqli_query($connection, $sql);
        if($ret){
            if(mysqli_num_rows($ret) == 0){
                header("Location: location.php?error=CANT");
            }
        } else{
            //      internal server error.
            exit();
        }

        $row = mysqli_fetch_array($ret);
        $id = $row['neighbors_id'];

        if($id1==0 || $id2==0){
            //      neighbor_name 으로만 이웃공간을 찾을 수 있다.
            $sql = "SELECT * from neighbors_of WHERE neighbors_id = $id";
            $ret=mysqli_query($connection, $sql);

            $arr = array();
            while($row = mysqli_fetch_array($ret)){
                array_push($arr, $row);
            }
            $_SESSION['arr']=$arr;
            header("Location: location.php");
        } else{
            if($id1 == $id2){
                header("Location: location.php?error=DUP");
            }

            $sql = "SELECT * FROM (SELECT A.location_id id1, A.neighbors_id id2, B.location_id id3, B.neighbors_id id4 FROM neighbors_of as A, neighbors_of as B WHERE A.neighbors_id = B.neighbors_id) C WHERE C.id1=$id1 AND C.id3=$id2 AND C.id4=$id";
            $ret=mysqli_query($connection, $sql);
            if($ret){
                if(mysqli_num_rows($ret) == 0){
                    header("Location: location.php?error=CANT");
                }
            } else{
                //      internal server error.
                exit();
            }

            $data = mysqli_fetch_array($ret);
            $_SESSION['data']=$data;
            header("Location: location.php");
        }
    }
?>