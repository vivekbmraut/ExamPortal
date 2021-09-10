<?php
session_start();
include"../../conn.php";
$totq=0;
$cat=$_SESSION['exam_category'];
$res1=pg_query($dbcon,"select * from qbank where category='$cat'");
$totq=pg_num_rows($res1);
echo "$totq";
?>