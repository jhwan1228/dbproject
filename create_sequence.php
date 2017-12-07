<?php

    include("auth.php");
    require('db.php');

    $total = $_POST['qty'];
    $s_name = $_POST['s_name'];
    $i = 1;

    $sql3 = "SELECT * FROM sequence WHERE sequence_name = '$s_name'";
    $resultsql3 = mysqli_query($connection, $sql3);
    if(mysqli_num_rows($resultsql3) > 0)
    {
        //      sequence name 중복성 검사. unique하지 않기 때문에
        header("Location: location.php?error=lol");
    }
    else
    {

        for($i = 1; $i < $total + 1; $i++)
        {
            $value = 's' . "$i";
            $neigh = $_POST[$value];
            $neighbors_list = $neighbors_list . "-" . $neigh;
        }

        $list2 = $neighbors_list;
        $list = substr($list2, 1);

        $tr = explode("-", $list);

    $total_tr = count($tr);

    for($i = 0; $i < $total_tr - 1; $i++)
    {
        $j = $i + 1;
        $tr[$i]; // 31
        $tr[$j]; // 32

        $sql = "SELECT * FROM neighbors_of WHERE neighbors_id = $tr[$i]";
        $result = mysqli_query($connection, $sql);
        $count = 0;

        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $count += 1;
                $test = $row["location_id"];
                if($count == 1)
                {
                    $q = $test;
                }
                else if($count == 2)
                {
                    $w = $test;
                }
            }
        }

        $sql2 = "SELECT * FROM neighbors_of WHERE neighbors_id = $tr[$j]";
        $result2 = mysqli_query($connection, $sql2);
        $count = 0;

        if(mysqli_num_rows($result2) > 0)
        {
            while($row2 = mysqli_fetch_array($result2))
            {
                $count += 1;
                $test = $row2["location_id"];
                if($count == 1)
                {
                    $e = $test;
                }
                else if($count == 2)
                {
                    $r = $test;
                }
            }
        }

        //$ok = 0;
        if($q == $e || $q == $r || $w == $e || $w == $r)
        {
            $ok = 1;
        }
        else
        {
            $ok = 0;
            break;
        }

    }

$message = "hi";

if($ok == 1)
{

	$query = "INSERT INTO sequence(sequence_name, neighbors_list) VALUES ('$s_name','$neighbors_list')";
	$result = mysqli_query($connection, $query);
	if($result)
	{
		header("Location: location.php");
	}

}
else
{
	header("Location: location.php?error=lol");
}
}











?>