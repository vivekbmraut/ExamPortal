<?php
session_start();
$name=$_SESSION['name'];
$sid=$_SESSION["sid"];
include '../../conn.php';
$res=pg_query($dbcon,"select * from timetable");
$rost=pg_query($dbcon,"select * from timetable");
$ret=pg_fetch_object($rost);
$rat=pg_query($dbcon,"select * from attempted where category='$ret->subject' and sid='$sid'");
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="SExamDashStyle.css">
  <script type="text/javascript">
    function startc(cate) {
      var xhr=new XMLHttpRequest();
      xhr.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200)
        {
          window.location="dashexam.php";
        }
      };
      xhr.open("GET", "setex.php?exam_category="+cate,true);
      xhr.send();
    }
  </script>
</head>
<body>
  <div class="header">
  <span id="stud">STUDENT</span><span id="lout"><a href="../logout.php">Logout</a></span>
  </div>
  <div class="sidebar">
      <div id="pic"><img src="avatar.png"></div><br>
      <span id="nam"><?php echo"$name" ?></span><br><br>
     <div class="sid_b"><a href="../TimeTable/Timetable.php">TIMETABLE</a></div>
    <div class="sid_b"><a href="Sexam.php">Exam</a></div>
  <div class="sid_b"><a href="../result/sresult.php">RESULT</a></div>
</div>

  <div class="container">
    <?php
    while($row=pg_fetch_object($res))
      {?>
        <input type="button" class="btn" id="<?php echo"$row->subject"; ?>" value="<?php echo"$row->subject"; ?>" style="margin-top:2%;margin-left: 4%; background-color: rgb(0, 255, 0); color:black; padding: 2% 40%; cursor: pointer;border-radius: 4px; font-size: 1.2em;width: 90%; "  onclick="startc(this.value)">
    <?php  
    }
    ?>
  </div>
<?php
if($dis=pg_fetch_object($rat))
{
  echo"<script type=\"text/javascript\">document.getElementById(\"$ret->subject\").disabled=true</script>";
}
?>
</body>
</html>