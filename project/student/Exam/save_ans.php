<?php 
session_start();
$quesno=$_GET['qno'];
$value1=$_GET['value1'];
$_SESSION["answer"][$quesno]=$value1;
?>