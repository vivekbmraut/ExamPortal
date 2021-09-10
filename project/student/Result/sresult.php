<?php
include '../../conn.php';
session_start();
$name=$_SESSION['name'];
$id=$_SESSION['sid'];
$res=pg_query($dbcon,"select * from attempted where sid='$id'");
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="SResultStyle.css">
</head>
<body>
<div class="header">
  <span id="stud">STUDENT</span><span id="lout"><a href="../logout.php">Logout</a></span>
</div>
<div class="sidebar">
<div id="pic"><img src="avatar.png"></div><br>
<span id="nam"><?php echo "$name" ?></span><br><br>
<div class="sid_b"><a href="../Timetable/Timetable.php">TIMETABLE</a></div>
<div class="sid_b"><a href="../Exam/Sexam.php">EXAM</a></div>
<div class="sid_b"><a href="sresult.php">RESULT</a></div>
</div>
<div class="content">
  <h1 align="center">RESULT</h1>
<table border=1px align="center">
  <tr>
    <th>Category</th><th>Total Questions</th><th>Correct Questions</th><th>date</th>
  </tr>
  <?php 
  while($row=pg_fetch_object($res))
  {
    echo"<tr><td>$row->category</td><td>$row->total</td><td>$row->correct</td><td>$row->date</td></tr>";
  }
  ?>
</table>
</div>
</body>
</html>