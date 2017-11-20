<?php

include("auth.php");

if($_SESSION['username'] == "sadmin")
{



?>

<!--
sadmin html goes here
-->

<h1><p>Welcome <?php echo $_SESSION['username']; ?>!</p></h1>
<h1><?php echo $_SESSION['id']; ?></h1>
<h2>This is sadmin</h2>
<a href = "admin.php">admin.php</a><br>
<a href = "cctv.php">cctv.php</a><br>
<a href = "logout.php">logout.php</a>

<?
}

else
{
?>

<!--
admin html goes here
-->

<h1><p>Welcome <?php echo $_SESSION['username']; ?>!</p></h1>
<h1><?php echo $_SESSION['id']; ?></h1>
<h2>This is admin</h2>
<a href = "admin.php">admin.php</a><br>
<a href = "cctv.php">admin.php</a><br>
<a href = "logout.php">logout.php</a>


<?
}
?>