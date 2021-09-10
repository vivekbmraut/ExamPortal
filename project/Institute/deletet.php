<?php
include '../conn.php';
$tid=$_GET['id'];
$res=pg_query($dbcon,"delete from tlogin where tid='$tid'");
echo "<script>window.location=\"addt.php\";</script>";
die();
?>