<!-- Institute login -->
<!DOCTYPE html>
<html lang="en">
<head>
	<title>THE INSTITUTE</title>
	<script type="text/javascript">
		function validt() {
			var x=document.forms["formst"]["username"].value;
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
  <link rel="stylesheet" href="ILoginStyle.css">
</head>
<body>
	<h1>Admin portal</h1>
	<div class="menu">
		<form method="POST" name="formst" action="<?php echo $_SERVER['PHP_SELF']?>" onsubmit="return validt()">
			<p>Username</p>
			<input type="text" name="username" placeholder="Enter Username" >
			<p>Password</p>
			<input type ="password" name="pwd" placeholder="Enter Password">
			<input type ="submit" name="submiti" value="Login">
			<a href="Lost_Password.html">Lost your Password?</a>
		</form>
		</div>
	</body>
</html>
<?php
session_start();
if(isset($_POST['submiti']))
{
$usern=$_POST['username'];
$pwd=$_POST['pwd'];
include "../conn.php";
$res=pg_query($dbcon,"select * from alogin where username='$usern' and password='$pwd'");
$row=pg_fetch_object($res);
if($row)
{
	$_SESSION['aid']=$row->aid;
	header("Location:/project/Institute/inserttb.php");
	pg_free_result($res);
	pg_close();
	die();
}
else{
	echo"<script>alert(\"Enter proper username or password\")</script>";
}
}
?>