<?php
include '../conn.php';
$sid=$_GET['id'];
$res=pg_query($dbcon,"delete from slogin where sid='$sid'");
echo "<script>window.location=\"adds.php\";</script>";
die();
?>