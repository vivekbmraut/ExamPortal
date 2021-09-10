<?php
session_start();
$ovex=$_SESSION['exam_category'];
if(isset($_SESSION["$ovex"]))
{
  header("Location:/project/student/TimeTable/Timetable.php");
}
$name=$_SESSION['name'];
include '../../conn.php';
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="StudentExamStyle.css">
    <script type="text/javascript">
      setInterval(function(){
        timer();
      },1000);
    function timer() {
      var xhr=new XMLHttpRequest();
      xhr.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200)
        {
          if(xhr.responseText=='00:00:01')
          {
            window.location="result.php";
          }
          document.getElementById("timecut").innerHTML=xhr.responseText;
        }
      };
      xhr.open("GET","loadtime.php",true);
      xhr.send(null);
    }
  </script>
</head>
<body>
  <div class="header">
      <span id="nam"><?php echo"$name"; ?></span>
      <span id="lout"><a href="../logout.php">Logout</a></span>
  </div>
  <div class="timer">
    <span id="categ"><?php echo $_SESSION['exam_category']; ?></span>
    <span id="timecut" style="display: block;">00:00:00</span>
  </div>
   <div class="container">
    <span id="curr_que">0</span><span>/</span><span id="tot_que">0</span>

    <div id="load_que">
      
    </div>
       <input type="button" class="prev" name="prev" value="back" onclick="load_prev();">
       <input type="button" class="next" name="next" value="next" onclick="load_next();">
   </div>
   <script type="text/javascript">
     function load_tot() {
      var xhr1=new XMLHttpRequest();
      xhr1.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200)
        {
          document.getElementById("tot_que").innerHTML=xhr1.responseText;
        }
      };
      xhr1.open("GET","load_tot.php",true);
      xhr1.send(null);
    }

    var qno="1";
    load_que(qno);
    function load_que(queno)
    {
      document.getElementById("curr_que").innerHTML=queno;
      var xhr2=new XMLHttpRequest();
      xhr2.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200)
        {
          if(xhr2.responseText=="over"){
            window.location="result.php";
          }
          else{
          document.getElementById("load_que").innerHTML=xhr2.responseText;  
          load_tot();
          }
          
        }
      };
      xhr2.open("GET","load_ques.php?qno="+queno,true);
      xhr2.send(null);
    }

    function radioclick(radiovalue,quesno) {
      var xhr3=new XMLHttpRequest();
      xhr3.onreadystatechange=function(){
        if (this.readyState == 4 && this.status == 200)
        {
        }
      };
      xhr3.open("GET","save_ans.php?qno="+quesno+"&value1="+radiovalue,true);
      xhr3.send(null);
    }
    

    function load_prev() {
      if(qno=="1")
      {
        load_que(qno);
      }
      else{
        qno=eval(qno)-1;
        load_que(qno);
      }
    }
    function load_next() {
      qno=eval(qno)+1;
        load_que(qno);
      
    }
   </script>
           
</body>
</html>