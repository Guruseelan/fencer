<?php
	session_start();
	if(!isset($_SESSION["ty"]))
		header("location:logout.php");
$con=new mysqli('localhost','root','',"ding");
$tq=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_q'.$_SESSION['qn'].'_que';
$tr=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_q'.$_SESSION['qn'].'_res';
if(isset($_GET['v']))
{
	$id=$_GET['v'];
	$iv=$_GET['u'];
	//echo "<br>".$id;
	//echo "<br>".$iv;
	$sq="select * from $tq where qid=$id";
	$resul= mysqli_query($con, $sq);
		$row=mysqli_fetch_assoc($resul);
	$ans=$row['ans'];
	$qid='q'.$id;
	$sql="select * from $tr where ";
	if($iv==1)
	{
		$sql.="$qid=$ans";
	}
	else if($iv==2)
	{
	$sql.="$qid<>$ans";	
	}
	else if($iv==3)
	{
	$sql.="$qid=1";	
	}
	else if($iv==4)
	{
	$sql.="$qid=2";	
	}
	else if($iv==5)
	{
	$sql.="$qid=3";	
	}
	else if($iv==6)
	{
	$sql.="$qid=4";	
	}
	$result= mysqli_query($con, $sql);
	if($result->num_rows>0){
		while($row1=mysqli_fetch_array($result))
	{
	echo $row1['uname']."<br>";	
	}
	}
	else
	{
		echo"<br><center>--None--</center>"; 
	}
	
}
else{
	echo"<br><center>--None--</center>";
}
?>