<?php
$emel=$_POST['emel'];
$pwd=$_POST['pwd'];
$mem=$_POST['member'];
$dbcon=pg_connect("host=localhost port=5432 dbname=examsys user=postgres password=postgres");
if($mem=="teacher")
{
	$res=pg_query($dbcon,"select * from tlogin where tid='$emel' and password='$pwd'");
	$row=pg_fetch_object($res);
	if($row)
	{
		header("Location:/project/teach.html");
		die();
	}
	else
	{
		header("Location:/project/login.html");
		die();
	}
}
else
{
	$res=pg_query($dbcon,"select * from slogin where sid='$emel' and password='$pwd'");
	$row=pg_fetch_object($res);
	if($row)
	{
		header("Location:/project/stud.html");
		die();
	}
	else
	{
		header("Location:/project/login.html");
		die();
	}
}
pg_free_result($res);
pg_close();
?>