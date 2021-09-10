<?php
session_start();
if(!isset($_SESSION['end_time']))
{
	echo"00:00:00";
}
else{
	$time1=gmdate("H:i:s",strtotime($_SESSION['end_time']) - strtotime(date("Y-m-d H:i:s")));
	if(strtotime($_SESSION['end_time'])< strtotime(date("Y-m-d H:i:s")))
	{
		echo"00:00:00";
	}
	else
	{
		echo"$time1";
	}
}

?>