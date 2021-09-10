<?php
session_start();
include"../../conn.php";

$quesno="";
$question="";
$opt1="";
$opt2="";
$opt3="";
$opt4="";
$answer="";
$count=0;
$ans="";

$cat=$_SESSION['exam_category'];
$quno=$_GET["qno"];

if(isset($_SESSION["answer"][$quno]))
{
	$ans=$_SESSION["answer"][$quno];
}

$res=pg_query($dbcon,"select * from qbank where category='$cat' and qno='$quno'");

$count=pg_num_rows($res);
if($count==0)
{
	echo "over";
  die();
}
else
{
	while($row=pg_fetch_object($res))
	{
		$quesno=$row->qno;
		$question=$row->question;
		$opt1=$row->opt1;
		$opt2=$row->opt2;
		$opt3=$row->opt3;
		$opt4=$row->opt4;
	}
}
?>
<br>
<table >
      <tr>
        <td>
        	<?php
        	echo "$quesno)$question";
        	?>
        </td>
      </tr>
      <tr>
        <td><input type="radio" name="opt" id="opt" value="<?php echo $opt1; ?>" onclick="radioclick(this.value,<?php echo $quesno; ?>)"
        	<?php
        	if($ans == $opt1)
        	{
        		echo" checked";
        	}
        ?>>
        <?php
        echo"$opt1";
        ?>
        </td>
      </tr>
      <tr>
        <td><input type="radio" name="opt" id="opt" value="<?php echo $opt2; ?>" onclick="radioclick(this.value,<?php echo $quesno; ?>)"
        	<?php
        	if($ans == $opt2)
        	{
        		echo" checked";
        	}
        ?>>
        <?php
        echo"$opt2";
        ?>
        </td>
      </tr>
      <tr>
        <td><input type="radio" name="opt" id="opt" value="<?php echo $opt3; ?>" onclick="radioclick(this.value,<?php echo $quesno; ?>)"
        <?php
        	if($ans == $opt3)
        	{
        		echo" checked";
        	}
        ?>>
        <?php
        echo"$opt3";
        ?>
        </td>
      </tr>
      <tr>
        <td><input type="radio" name="opt" id="opt" value="<?php echo $opt4; ?>" onclick="radioclick(this.value,<?php echo $quesno; ?>)"
        <?php
        	if($ans == $opt4)
        	{
        		echo" checked";
        	}
        ?>>
        <?php
        echo"$opt4";
        ?>
        </td>
      </tr>
</table>