<?php
session_start();
$date=date("Y-m-d H:i:s");
$_SESSION['end_time']=date("Y-m-d H:i:s",strtotime($date."+$_SESSION[exam_time] minutes"));
include"../../conn.php";
$sid=$_SESSION['sid'];
$correct=0;
$wrong=0;
$cat=$_SESSION["exam_category"];
if(isset($_SESSION["answer"]))
{
	for ($i=1; $i<=sizeof($_SESSION["answer"]) ; $i++) { 
		$ans="";

		$res=pg_query($dbcon,"select * from qbank where category='$cat' and qno='$i'");
		while($row=pg_fetch_object($res))
		{
			$ans=$row->correct;
		}
		if(isset($_SESSION["answer"][$i]))
		{
			if($ans==$_SESSION["answer"][$i])
			{
				$correct=$correct+1;
			}
			else{
				$wrong=$wrong+1;
			}
		}
		else{
			$wrong=$wrong+1;
		}
	}
}
$count=0;
$rest=pg_query($dbcon,"select * from qbank where category='$cat'");
$count=pg_num_rows($rest);
$wrong=$count-$correct; 
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="result.css">
	<script type="text/javascript">
		function home() {
			window.location="../TimeTable/Timetable.php";
		}
	</script>
</head>
<body>
	<div class="header">
		<span class="result">RESULT</span>
		<span class="lout"><a href="../logout">Logout</a></span>
	</div>
	<div class="content">
		<div class="main">
		<?php echo"Total Question= ".$count."<br>";?><br>
		<?php echo"Correct answer =".$correct."<br>";?><br>
		<?php echo"Wrong answer =".$wrong."<br>";?>
		<br><br>
		<input type="button" class="but" value="Return Home" onclick="home()">
		</div>
	</div>
	<?php
if(isset($_SESSION['exam_start']))
{
	$fet=pg_query($dbcon,"select * from attempted where category='$cat'");
	$date=date("Y-m-d");
	if(!($rot=pg_fetch_object($fet)))
	{
		$atr=pg_query($dbcon,"insert into attempted values('$sid','$cat','$count','$correct','$date')");
		$upd=pg_query($dbcon,"update result set $cat='$correct' , date='$date' where sid='$sid'");
	}
	unset($_SESSION['exam_start']);
	$_SESSION["$cat"]="over";
	echo"<script type=\"text/javascript\">
	window.location.href=window.location.href;
</script>";
}
?>

</body>
</html>
