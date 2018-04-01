<?php
include("modules.php");
	if(!isset($_SESSION["ty"]))
	header("location:logout.php");
$con=new mysqli('localhost','root','',"ding");
$tn=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_cnt';
$tq=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_q'.$_SESSION['qn'].'_que';
$tr=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_q'.$_SESSION['qn'].'_res';
$tt=$_SESSION['uname'];
?>
<html>
<head>
   <meta charset="UTF-8">

   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <link rel="stylesheet" href="css/w3.css">
</head>
<body>
<?php

$sql="select qname from $tn where no='$_SESSION[qn]'";
$result = $con->query($sql);
$row = $result->fetch_assoc();
if ($result->num_rows > 0) 
{
$qname=$row['qname'];
}

	$sql="select * from $tr where uname='$tt' and tot>=0";
	$result = mysqli_query($con, $sql);
	?><div class="w3-panel w3-border w3-border-red">
   <h3><?php echo $qname;?></h3>
   </div>
	<?php 
	if (mysqli_num_rows($result)==0) 
	{
  	?>
	
   <p>Answer will be visible after submission</p>
 <?php
	}
	else
	{
		?>
		<div class="w3-container">
		<?php
	$i=1;
	$sql="select * from $tq";
	$result= mysqli_query($con, $sql);
	while($row=mysqli_fetch_array($result))
	{
		$r="q".$row['qid'];
		$resul = $con->query("select $r from $tr where uname='$tt'");
		$rw = $resul->fetch_assoc();
	?>
	<div class="w3-panel w3-border">
	  <div class="w3-panel w3-border-bottom">
		<h3><?php echo "Question ".$i;?></h3>
	  </div>
		<div class="w3-panel w3-border-bottom">
	<p><?php echo nl2br(htmlspecialchars($row['ques']));?></p>
	</div>
	<p>Options</p>
	<?php
    $parts = explode( '~~~', $row['opt']);
	for($x=1;$x<=$row['nopts'];$x++)
	{
	?>
	 <p>
	<?php echo $x.".".nl2br(htmlspecialchars($parts[$x-1]));?>
    </p><?php
	}?>
	<div class="w3-panel w3-border-top">
	
	<p>Ans:-<?php echo "Option: ".$row['ans'];?><br></p>
	<?php 
	if($rw[$r]!=0)
	{ 
	if($row['otype']=="Radio")
	{?>
	<p>Your Ans:-<?php echo "Option: ".$rw[$r];?><br></p>
	<?php 
	}
	else if($row['otype']=="Check Box")
	{?>
	<p>Your Ans:-<?php echo "Option: ".$rw[$r];?><br></p>
	<?php 
	}
	else if($row['otype']=="Text Box")
	{
	if($rw[$r]==1)
	{?>	
	<p>Right Answer<br></p>
	<?php
	}
	else
	{?>	
	<p>Wrong Answer<br></p>
	<?php
	}
	}
	}
	else
	{ ?>
	<p>Your Ans:-<?php echo "No Answer";?><br></p>
	<?php 
	}
	
	?>
	<p>Explanation:-<?php echo nl2br(htmlspecialchars($row['expl']));?>
	</p>
	</div></div>
	
	<?php 
	$i++;
	} 
	}?>
	</div>

</body>
</html>