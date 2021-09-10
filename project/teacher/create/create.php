<?php
session_start();
$name=$_SESSION['name'];
if(isset($_GET['id']))
{
  $id=$_GET['id'];
  $_SESSION['subid']=$id;
}
else
{
  $id=$_SESSION['subid'];
}
include '../../conn.php';
$ret=pg_query($dbcon,"select * from timetable where subid='$id'");//fetching subject 
$ro=pg_fetch_object($ret);
$disp=pg_query($dbcon,"select * from qbank where category='$ro->subject'");//table display purpose
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
  <h2 >CREATE FOR <?php echo"$ro->subject" ?></h2>
<form action="" name="formst" method="POST" onsubmit="return validt()">
  <table>
  <tr>
    <td>Enter Question</td>
  </tr>
  <tr>
    <td><input type="text" name="ques"></td>
  </tr>
   <tr>
    <td>Option 1</td>
  </tr>
  <tr>
    <td><input type="text" name="opt1"></td>
  </tr>
   <tr>
    <td>Option 2</td>
  </tr>
  <tr>
    <td><input type="text" name="opt2"></td>
  </tr>
   <tr>
    <td>Option 3</td>
  </tr>
  <tr>
    <td><input type="text" name="opt3"></td>
  </tr>
  <tr>
    <td>Option 4</td>
  </tr>
  <tr>
    <td><input type="text" name="opt4"></td>
  </tr>
  <tr>
    <td>Correct answer</td>
  </tr>
  <tr>
    <td><input type="text" name="corr"></td>
  </tr>
  <tr>
    <td><input type="submit" name="submitq" id="instyle" value="INSERT"></td>
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
  $res=pg_query($dbcon,"select * from qbank where category='$ro->subject' order by id asc");
  $count=pg_num_rows($res);
  $i=0;
  if($count>0)
  {
    while($row=pg_fetch_object($res))
    {
      $i++;
      pg_query($dbcon,"update qbank set qno='$i' where id='$row->id'");
    }
  }
    $i++;
    $alrt=pg_query($dbcon,"insert into qbank values(Default,'$i','$ques','$opt1','$opt2','$opt3','$opt4','$corr','$ro->subject')");
    if($alrt)
    {
      echo"<script>alert(\"Question inserted\");</script>";
      echo"<script>window.location.href=window.location.href;</script>";
    }
}
?>
<div class="ltab">
  <br><br>
  <table border=1px>
  <tr>
    <th>Qno</th><th>Question</th><th>opt1</th><th>opt2</th><th>opt3</th><th>opt4</th><th>correct</th><th>category</th><th>Update</th><th>Delete</td>
  </tr>
  <?php
  while($qbank=pg_fetch_object($disp))
    echo"<tr><td>$qbank->qno</td><td>$qbank->question</td><td>$qbank->opt1</td><td>$qbank->opt2</td><td>$qbank->opt3</td><td>$qbank->opt4</td><td>$qbank->correct</td><td>$qbank->category</td><td><a href=\"updateq.php?id=$qbank->id\">Update</td><td><a href=\"deleteq.php?id=$qbank->id\">Delete</td></tr>";
  ?>
</table>
</div>
</body>
</html>