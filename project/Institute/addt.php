<?php
session_start();
if(!isset($_SESSION['aid']))
  echo "<script>window.location=\"index.php\";</script>";
include"../conn.php";
$ret=pg_query($dbcon,"select * from tlogin");
?>
<!DOCTYPE html>
<html>
<head>
  <title>THE INSTITUTE</title>
  <script type="text/javascript">
    function validt() {
      var flag;
      var npat=/^[A-Za-z]+$/;
      var x=document.forms["formst"]["usrn"].value;
      var p=document.forms["formst"]["pwd"].value;
      var t=document.forms["formst"]["tid"].value;
      var tn=document.forms["formst"]["tname"].value;
      var patt=/(.+)@(.+)\.(..)/;
      if(isNaN(t))
      {
        alert('ENTER A NUMBER IN TEACHER ID');
        return false;
      }
      if(npat.test(tn))
        flag=true;
      else{
        alert('Enter teacher name properly');
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
      return flag;
    }
  </script>
</head>
<body>
  <link rel="stylesheet" href="addt.css">
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
  <td><h2>Teacher id</h2></td>
  <td><input type="text" name="tid" placeholder="Tid" required></td>
  </tr>

  <tr>
  <td><h2>Teacher Name</h2></td>
  <td><input type="text" name="tname" placeholder="NAME" required></td>
  </tr>

  
  <tr>
    <td><h2>Username</h2></td>
    <td><input type="text" name="usrn" placeholder="email" required></td>
  </tr>

  <tr>
    <td><h2>Password</h2></td>
    <td><input type="Password" name="pwd" placeholder="8 digit" required></td>
  </tr>
</table>
<input type="submit" name="sus" value="insert">
</div>
</form>
<?php
if(isset($_POST['sus']))
{
  $tid=$_POST['tid'];
  $tname=$_POST['tname'];
  $usr=$_POST['usrn'];
  $pwd=$_POST['pwd'];
  $res=pg_query($dbcon,"insert into tlogin values('$tid','$usr','$pwd','$tname')");
  if($res)
  {
    echo "<script>alert(\"inserted in teacher\");</script>";
    echo"<script>window.location.href=window.location.href;</script>";
  }
}
?>
<style type="text/css">
 .ltab table{
  border-collapse: collapse;  
  width: 50%;

}
.ltab th{
  background-color: rgb(156, 250, 130);
  height: 30px;
}
.ltab tr:nth-child(even){
  background-color: rgb(171, 171, 171);
}
.ltab td{
  height:30px;
}
</style>
<div class="ltab">
  <br><br>
  <table border=1px align="center">
  <tr>
    <th>TID</th><th>USERNAME</th><th>PASSWORD</th><th>NAME</th><th></th>
  </tr>
  <?php
  while($teac=pg_fetch_object($ret))
    echo"<tr><td>$teac->tid</td><td>$teac->username</td><td>$teac->password</td><td>$teac->name</td><td><a href=\"deletet.php?id=$teac->tid\">Delete<a></td></tr>";
  ?>
</table>
</div>
</body>
</html>