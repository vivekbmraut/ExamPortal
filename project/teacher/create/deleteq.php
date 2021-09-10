<?php
include '../../conn.php';
$qid=$_GET['id'];
$res=pg_query($dbcon,"delete from qbank where id='$qid'");
echo "<script>window.location=\"create.php\";</script>";
die();
?>