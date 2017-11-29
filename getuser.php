
<?php
$q = intval($_GET['q']);

require("db.php");


$text2 = "<div class=\"col-sm-offset-2 col-sm-6\"><button type=\"submit\" id = \"submitt\" class=\"btn btn-default\">Submit</button></div>";

$text3 = "<input type=\"hidden\" name = \"qty\" value = \"". $q ."\">";

$text4 = "<div class=\"form-group\">
    <label class = \"control-label col-sm-2\">Sequence name:</label>
    <div class = \"col-sm-6\"><input type = \"text\" class = \"form-control\" placeholder = \"Enter sequence name\" name = \"s_name\" required></div></div>";

if($q &&  $q > 1)
{
    echo $text4;
}

if($q &&  $q > 1)
{
for($i = 1; $i < $q + 1; $i++)
{

    echo "<div class=\"form-group\">
    <label class = \"control-label col-sm-2\">". $i ."</label>
    <div class = \"col-sm-6\">
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
}

if($q &&  $q > 1)
{
    echo $text3;
    echo $text2;
}


mysqli_close($con);
?>

