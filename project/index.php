<!-- STUDENT HTML -->
<html>
<head>
	<title>Student Login</title>
	<script type="text/javascript">
		function validt() {
			var x=document.forms["formst"]["usern"].value;
			var p=document.forms["formst"]["pwd"].value;
			var patt=/(.+)@(.+)\.(..)/;
			if(patt.test(x) && p.length>=7)
				return true;
			else 
			{
				alert('Please enter email in correct format OR password with length 8');
				return false;
			}
		}
	</script>
</head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<body>
		<div class="student-login-box">
		<img src="avatar.jpg" class="avatar">
		<h1>Student Login</h1>
		<form method='post' name="formst" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit = "return validt()" >
			<br><br>
			<p>Email</p>
			<input type="text" name="usern" placeholder="Enter Email" required>
			<p>Password</p>
			<input type ="password" name="pwd" placeholder="Enter Password" required>
			<a href="second.html"><input type ="submit" name="submits" value="Login"></a>
			<a href="Lost_Password.html">Lost your Password?</a>
			<a href="dont_have_acc.html"> Don't have an Account?</a>
		</form>
	</div>
<?php
session_start();
if(isset($_POST['submits']))
{
$usern=$_POST['usern'];
$pwd=$_POST['pwd'];
include "conn.php";
$res=pg_query($dbcon,"select * from slogin where username='$usern' and password='$pwd'");
$row=pg_fetch_object($res);
if($row)
{
	$_SESSION['sid']=$row->sid;
	$res=pg_query($dbcon,"select name from sdetail where sid='$row->sid'");
	$row=pg_fetch_object($res);
	$_SESSION['name']=$row->name;
	header("Location:/project/student/TimeTable/Timetable.php");
	pg_free_result($res);
	pg_close();
	die();
}
else
{
	echo"<script>alert('input correct username or password');</script>";
}
}
?>
</body>
</html>
