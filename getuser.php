
<?php
$q = intval($_GET['q']);

require("db.php");


$text2 = "<button type=\"submit\" id = \"submitt\" class=\"btn btn-default\">Submit</button>";

$text3 = "<input type=\"hidden\" name = \"qty\" value = \"". $q ."\">";

for($i = 1; $i < $q + 1; $i++)
{

    echo "<div class=\"form-group\">
    <label class = \"control-label col-sm-2\">". $i ."</label>
    <div class = \"col-sm-3\">
        <select class=\"form-control\" name=\"s". $i ."\">";

    require("db.php");

    $query = "SELECT * FROM neighbors";
    $result = mysqli_query($connection, $query);
    while($r = mysqli_fetch_array($result))
    {
        echo "<option value =" . $r['neighbors_id'] . ">" . $r['neighbors_name'] . "</option>";
    }
    echo "</select>
        </div>
</div>";
}

if($q)
{
    echo $text3;
    echo $text2;
}


mysqli_close($con);
?>

