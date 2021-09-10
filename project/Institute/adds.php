<?php
session_start();
if(!isset($_SESSION['aid']))
  echo "<script>window.location=\"index.php\";</script>";
include "../conn.php";
$ret=pg_query($dbcon,"select * from slogin");
?>
<!DOCTYPE html>
<html>
<head>
	<title>THE INSTITUTE</title>
   <script type="text/javascript">
    function validt() {
      var flag=true;
      var npat=/^[A-Za-z]+$/;
      var x=document.forms["formst"]["usrn"].value;
      var p=document.forms["formst"]["pwd"].value;
      var t=document.forms["formst"]["sid"].value;
      var tn=document.forms["formst"]["sname"].value;
      var rn=document.forms["formst"]["resid"].value;
      var patt=/(.+)@(.+)\.(..)/;
      if(isNaN(t))
      {
        alert('ENTER A NUMBER IN STUDENT ID');
        return false;
      }
      if(npat.test(tn))
        flag=true;
      else{
        alert('Enter student name properly');
        return false;
      }
      if(!patt.test(x))
      {
        alert('please enter username in email format');
        return false;
      }
      if(p.length<7) 
      {
        alert('please enter password with length 8');
        return false;
      }
      if(isNaN(rn))
      {
        alert('ENTER A NUMBER IN RESULT ID');
        return false;
      }
      return flag;
    }
  </script>
</head>
<body>
		<h1>Admin portal</h1>
<link rel="stylesheet" href="adds.css">
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
  <td><h2>Student id</h2></td>
  <td><input type="text" name="sid" placeholder="Sid" required></td>
  </tr>

  <tr>
  <td><h2>Student Name</h2></td>
  <td><input type="text" name="sname" placeholder="NAME" required><td>
  </tr>

  
  <tr>
    <td><h2>Username</h2></td>
    <td><input type="text" name="usrn" placeholder="email" required></td>
  </tr>

  <tr>
    <td><h2>Password</h2></td>
    <td><input type="password" name="pwd" placeholder="8digit" required></td>
  </tr>

  <tr>
    <td><h2>Result id</h2></td>
    <td><input type="text" name="resid" placeholder="rid" required></td>
  </tr>
</table>
<input type="submit" name="sut" value="insert">
</div>
</form>

<?php
if(isset($_POST['sut']))
{
  $sid=$_POST['sid'];
  $sname=$_POST['sname'];
  $usr=$_POST['usrn'];
  $pwd=$_POST['pwd'];
  $resid=$_POST['resid'];
  $res=pg_query($dbcon,"insert into slogin values('$sid','$usr','$pwd')");
  $res=pg_query($dbcon,"insert into result values('$resid','$sid')");
  $res=pg_query($dbcon,"insert into sdetail values('$sid','$sname','$resid')");
  if($res)
  {
    echo "<script>alert(\"Student inserted\")</script>";
    echo"<script>window.location.href=window.location.href;</script>";
  }

}
?>

<div class="ltab">
  <br><br>
  <table border=1px align="center">
  <tr>
    <th>SID</th><th>USERNAME</th><th>PASSWORD</th><th></th>
  </tr>
  <?php
  while($log=pg_fetch_object($ret))
    echo"<tr><td>$log->sid</td><td>$log->username</td><td>$log->password</td><td><a href=\"deletes.php?id=$log->sid\">Delete<a></td></tr>";
  ?>
</table>
</div>

</body>
</html>