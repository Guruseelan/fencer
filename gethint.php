<?php

	$con=new mysqli('localhost','root','',"ding");
		$na="yasi@gmail.com";//$_SESSION["uname"];
		$sql = "select ccode from stdcou where uname='$na'";
	//echo $na;fdffSS
		$result = $con->query($sql);
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
		{		
		$cnm=$row['ccode'];
		
		$sql1="select *from swift where ccode='$cnm' and pub=1";
		$result1 = $con->query($sql1);
		echo $result1->num_rows;
		//echo "guru";
		//header("location:login.php");
		/*if ($result1->num_rows > 0) 
		{
		while($row1 = $result1->fetch_assoc()) 
		{
		//	echo $row1['ques'];
		
		}
		}*/
		}
		}
		?>