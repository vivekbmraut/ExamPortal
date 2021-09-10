<script type="text/javascript">
	console.log('<?php echo $_GET['exam_category']; ?>');
</script>
<?php
session_start();
include"../../conn.php";
$exam_category=$_GET['exam_category'];
$_SESSION['exam_category']=$exam_category;
$res=pg_query($dbcon,"select * from timetable where subject='$exam_category'");
while($row=pg_fetch_object($res))
{
	$_SESSION['exam_time']=$row->duration;
}
$date=date("Y-m-d H:i:s");
$_SESSION['end_time']=date("Y-m-d H:i:s",strtotime($date."+$_SESSION[exam_time] minutes"));
$_SESSION['exam_start']="yes";
?>