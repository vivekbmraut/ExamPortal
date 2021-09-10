<!-- TEACHER -->
<html>
<head>
	<title>Login Form</title>
	<script type="text/javascript">
		function validt() {
			var x=document.forms["formst"]["email"].value;
			var p=document.forms["formst"]["pwd"].value;
			var patt=/(.+)@(.+)\.(..)/;
			if(patt.test(x) && p.length>=7)
				return true;
			else 
			{
				alert('please enter email in correct format OR password with length 8');
				return false;
			}
		}
	</script>
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
	<div class="student-login-box">
	<img src="avatar.jpg" class="avatar">
	<h1>Teacher Login</h1>
	<form method="post" name="formst" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit=" return validt()">
		<p>Email</p>
		<input type="text" name="email" placeholder="Enter Email">
		<p>Password</p>
		<input type ="password" name="pwd" placeholder="Enter Password">
		<input type ="submit" name="submitt" value="Login">
		<a href="Lost_Password.html">Lost your Password?</a>
		<a href="dont_have_acc.html"> Don't have an Account?</a>
	</form>
</div>
<?php
session_start();
if(isset($_POST['submitt']))
{
$usern=$_POST['email'];
$pwd=$_POST['pwd'];
include "../conn.php";
$res=pg_query($dbcon,"select * from tlogin where username='$usern' and password='$pwd'");
$row=pg_fetch_object($res);
if($row)
{
	$_SESSION['tid']=$row->tid;
	$_SESSION['name']=$row->name;
	header("Location:/project/teacher/timetabl/timetable.php");
	pg_free_result($res);
	pg_close();
	die();
}
else{
	echo"<script>alert(\"Enter proper username or password\")</script>";
}
}
?>
</body>
</html>