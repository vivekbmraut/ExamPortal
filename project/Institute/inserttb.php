<!-- timetbl insert -->
<?php
session_start();
if(!isset($_SESSION['aid']))
  {echo "<script>window.location=\"index.php\";</script>";}
include "../conn.php";
$ret=pg_query($dbcon,"select * from timetable");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>THE INSTITUTE</title>
  <script type="text/javascript">
    function validt() {
      var flag;
      var npat=/^[A-Za-z]+$/;
      var t=document.forms["formst"]["subid"].value;
      var tn=document.forms["formst"]["subject"].value;
      var rn=document.forms["formst"]["duration"].value;
      if(isNaN(t))
      {
        alert('ENTER A NUMBER IN SUBJECT ID');
        return false;
      }
      if(npat.test(tn))
        flag=true;
      else{
        alert('Enter subject name properly');
        return false;
      }
      if(isNaN(rn))
      {
        alert('ENTER duration in NUMBER');
        return false;
      }
      return flag;
    }
  </script>
</head>
<body>
  <link rel="stylesheet" type="text/css" href="inserttim.css">
		<h1>Admin portal</h1>
	<div class="menu">
	  <a href="adds.php"><span class="menut">Add new Student</span></a> 
		 <a href="addt.php"><span class="menut">Add new Teacher</span></a> 
		 <a href="inserttb.php"><span class="menut">Schedule Exam</span></a> 
		 <a href="logout.php" id="lout">Logout</a>
</div>
<form method="POST" name="formst" action="<?php echo $_SERVER['PHP_SELF']?>" onsubmit="return validt()">
	<div id="tabl">
	<table align="center">
  <tr>
  <td><h1>Subject ID</h1></td>
  <td><input type="text" name="subid" placeholder="exam Code" required></td>
  </tr>

  <tr>
  <td><h1>Subject Name</h1></td>
  <td><input type="text" name="subject" placeholder="Sub Name" required><td>
  </tr>

  <tr>
    <td>
    <h1>Duration</h1></td>
    <td><input type="text" name="duration" placeholder="0minutes" required></td>
  </tr>

  <tr>
  <td><h1>Exam Date:</h1></td>
  <td><input type="date" id="exam date" name="date" placeholder="mm/dd/yy" required></td>
  </tr>
  
</table>
<input type="submit" id="sub" name="subi" value="insert">
</div>
</form>
<?php
if(isset($_POST['subi']))
{
  $subid=$_POST['subid'];
  $subj=$_POST['subject'];
  $dur=$_POST['duration'];
  $dat=$_POST['date'];
  $res=pg_query($dbcon,"insert into timetable values('$dat','$subj','$dur','$subid')");
  if($res)
  {
    echo"<script>alert(\"Subject inserted\");</script>";
    echo"<script>window.location.href=window.location.href;</script>";
  }
}
?>
<div class="ltab">
  <br><br>
  <table border=1px align="center">
  <tr>
    <th>DATE</th><th>SUBJECT</th><th>DURATION</th><th></th>
  </tr>
  <?php
  while($tim=pg_fetch_object($ret))
    echo"<tr><td>$tim->date</td><td>$tim->subject</td><td>$tim->duration min</td><td><a href=\"deletetb.php?id=$tim->subid\">Delete<a></td></tr>";
  ?>
</table>
</div>

</body>
</html>