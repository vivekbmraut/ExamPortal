<?php
session_start();
$name=$_SESSION['name'];
include '../../conn.php';
$res=pg_query($dbcon,"select * from timetable");
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="tstyle.css">
</head>
<body>
<div class="header">
	<span id="stud">TEACHER</span><span id="lout"><a href="../logout.php">Logout</a></span>
</div>
<div class="sidebar">
<div id="pic"><img src="../result/t.png"></div><br>
<span id="nam"><?php echo"$name" ?></span><br><br>
<div class="sid_b"><a href="timetable.php">TIMETABLE</a></div>
<div class="sid_b"><a href="../create/selectcat.php">CREATE QUESTIONS</a></div>
<div class="sid_b"><a href="../result/allres.php">RESULT</a></div>
</div>
<div class="content">
  <h1 align="center">TIMETABLE</h1>
<table border=1px align="center">
  <tr>
    <th>DATE</th><th>SUBJECT</th><th>DURATION</th>
  </tr>
  <?php
  while($tim=pg_fetch_object($res))
    echo"<tr><td>$tim->date</td><td>$tim->subject</td><td>$tim->duration min</td></tr>";
  ?>
</table>
</div>
</body>
</html>