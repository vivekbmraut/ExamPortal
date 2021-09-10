<?php
session_start();
$name=$_SESSION['name'];
include '../../conn.php';
$res=pg_query($dbcon,"select * from result");
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="all.css">
</head>
<body>
<div class="header">
	<span id="stud">TEACHER</span><span id="lout"><a href="../logout.php">Logout</a></span>
</div>
<div class="sidebar">
<div id="pic"><img src="t.png"></div><br>
<span id="nam"><?php echo"$name" ?></span><br><br>
<div class="sid_b"><a href="../timetabl/timetable.php">TIMETABLE</a></div>
<div class="sid_b"><a href="../create/selectcat.php">CREATE QUESTIONS</a></div>
<div class="sid_b"><a href="allres.php">RESULT</a></div>
</div>
<div class="content">
  <h1 align="center">RESULTS</h1>
<table border=1px align="center">
  <tr>
    <th>Student Id</th><th>Name</th><th>PHP</th><th>OS</th><th>JAVA</th><th>CG</th>
  </tr>
  <?php
  while($row=pg_fetch_object($res))
  {
  	$na=pg_query($dbcon,"select name from sdetail where sid='$row->sid'");
  	$nam=pg_fetch_object($na);
  	echo"<tr>
  		<td>$row->sid</td><td>$nam->name</td><td>$row->php</td><td>$row->os</td><td>$row->java</td><td>$row->cg</td>
  	</tr>";
  }
  ?>
  
</table>
</div>
</body>
</html>