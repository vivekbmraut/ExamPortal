<?php
session_start();
$name=$_SESSION['name'];
$id=$_GET['id'];
include '../../conn.php';
$disp=pg_query($dbcon,"select * from qbank where id='$id'");
$row=pg_fetch_object($disp);
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="create.css">
  <script type="text/javascript">
  function validt() {
      var opt1=document.forms["formst"]["opt1"].value;
      var opt2=document.forms["formst"]["opt2"].value;
      var opt3=document.forms["formst"]["opt3"].value;
      var opt4=document.forms["formst"]["opt4"].value;
      var corr=document.forms["formst"]["corr"].value;
      if((opt1.localeCompare(corr)==0) || (opt2.localeCompare(corr)==0) || (opt3.localeCompare(corr)==0) || (opt4.localeCompare(corr)==0))
        return true;
      else
      {
        alert('Correct answer should be from options');
        return false;
      }
    }
  </script>
</head>
<body>
<div class="header">
  <span id="stud">TEACHER</span><span id="lout"><a href="../logout.php">Logout</a></span>
</div>
<div class="sidebar">
<div id="pic"><img src="../result/t.png"></div><br>
<span id="nam"><?php echo"$name" ?></span><br><br>
<div class="sid_b"><a href="../timetabl/timetable.php">TIMETABLE</a></div>
<div class="sid_b"><a href="selectcat.php">CREATE QUESTIONS</a></div>
<div class="sid_b"><a href="../result/allres.php">RESULT</a></div>
</div>
<div class="content">
  <h2>UPDATE</h2>
<form action="" name="formst" method="POST" onsubmit="return validt()">
  <table>
  <tr>
    <td>Question</td>
  </tr>
  <tr>
    <td><input type="text" name="ques" value="<?php echo $row->question ?>"></td>
  </tr>
   <tr>
    <td>Option 1</td>
  </tr>
  <tr>
    <td><input type="text" name="opt1" value="<?php echo $row->opt1 ?>"></td>
  </tr>
   <tr>
    <td>Option 2</td>
  </tr>
  <tr>
    <td><input type="text" name="opt2" value="<?php echo $row->opt2 ?>"></td>
  </tr>
   <tr>
    <td>Option 3</td>
  </tr>
  <tr>
    <td><input type="text" name="opt3" value="<?php echo $row->opt3 ?>"></td>
  </tr>
  <tr>
    <td>Option 4</td>
  </tr>
  <tr>
    <td><input type="text" name="opt4" value="<?php echo $row->opt4 ?>"></td>
  </tr>
  <tr>
    <td>Correct answer</td>
  </tr>
  <tr>
    <td><input type="text" name="corr" value="<?php  echo $row->correct ?>"></td>
  </tr>
  <tr>
    <td><input type="submit" name="submitq" value="UPDATE"></td>
  </tr>
</table>
</form>
</div>
<?php
if(isset($_POST['submitq']))
{
  $ques=$_POST['ques'];
  $opt1=$_POST['opt1'];
  $opt2=$_POST['opt2'];
  $opt3=$_POST['opt3'];
  $opt4=$_POST['opt4'];
  $corr=$_POST['corr'];
  $res=pg_query($dbcon,"update qbank set question='$ques',opt1='$opt1',opt2='$opt2',opt3='$opt3',opt4='$opt4',correct='$corr' where id='$id'");
    if($res)
    {
      echo"<script>alert(\"Question updated\");</script>";
      echo"<script>window.location=\"create.php\";</script>";
    }
}
?>
</body>
</html>