<?php
include '../conn.php';
$subid=$_GET['id'];
$res=pg_query($dbcon,"delete from timetable where subid='$subid'");
echo "<script>window.location=\"inserttb.php\";</script>";
die();
?>