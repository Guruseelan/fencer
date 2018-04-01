<?php
session_start();
if(!isset($_SESSION["ty"]))
header("location:logout.php");
		$res=0;
		$con=new mysqli('localhost','root','',"ding");
	
		$na=$_SESSION["uname"];
		$sql = "select *from swift where uname='$na'";
		$result = $con->query($sql);
		if ($result->num_rows > 0) 
		{
			echo "1";
		}
		else
			echo "0";
?>