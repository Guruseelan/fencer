<?php
include("swift.php");
	if(!isset($_SESSION["ty"]))
	header("location:logout.php");
$con=new mysqli('localhost','root','',"ding");
$tq=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_q'.$_SESSION['qn'].'_que';
$tr=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_q'.$_SESSION['qn'].'_res';
 global $val;
?>
<html>
<head>
   <meta charset="UTF-8">

   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
   <link rel="stylesheet" href="css/w3.css">
   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	   <link rel="stylesheet" href="css/w3m.css">
	     <link rel="stylesheet" href="css/w3.css">
       <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script type="text/javascript" src="js/materialize.js"></script>
	   <script src="https://www.w3schools.com/lib/w3data.js"></script>
     <style>
	 body 
	 {
	 background-color:rgb(255,255,255);}
	 textarea {
    width:850px;
	height:100px;
    padding: 3px;
    border: none;
    }
	      
	 </style>
	 <script>
function myFunction(id) 
{
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) 
	{
        x.className += " w3-show";
    } 
	else 
	{ 
        x.className = x.className.replace(" w3-show", "");
    }
}
	
function hh(f,h)
{


       var xmlhttp = new XMLHttpRequest();
		
        xmlhttp.onreadystatechange = function() 
		{
            if (this.readyState == 4 && this.status == 200) 
			{
                 document.getElementById("pppp").innerHTML=this.responseText;
				document.getElementById('id01').style.display='block';
            }
        };
		xmlhttp.open("GET","res.php?v="+f+"&u="+h, true);
        xmlhttp.send();
		
}


</script>
</head>
<body>
<center><h2>Statistics</h2></center>

<?php
	$i=1;
	$sql="select * from $tq";
	$result= mysqli_query($con, $sql);
	$sq="select * from $tr";
	$resul= mysqli_query($con, $sq);
	$nn=$resul->num_rows;
	if($nn>0){
		while($row=mysqli_fetch_array($result))
	{
				?>
<div class="w3-panel w3-border w3-light-grey w3-round-large">
 
	<p class="w3-panel w3-border w3-round-xxlarge"><?php echo $i.".".nl2br(htmlspecialchars($row['ques']));?></p><?php
		
	$id='q'.$row['qid'];
	$ans=$row['ans'];
	$sql1="select * from $tr where $id is not null";
	$result1= mysqli_query($con, $sql1);
	$n1=$result1->num_rows;
	$sql2="select * from $tr where $id=$ans";
	$result2= mysqli_query($con, $sql2);
	$n2=$result2->num_rows;
	$n3=$n1-$n2;
		$sql3="select * from $tr where $id=1";
	$result3= mysqli_query($con, $sql3);
	$op1=$result3->num_rows;
	$sql4="select * from $tr where $id=2";
	$result4= mysqli_query($con, $sql4);
	$op2=$result4->num_rows;
	$sql5="select * from $tr where $id=3";
	$result5= mysqli_query($con, $sql5);
	$op3=$result5->num_rows;
	$sql6="select * from $tr where $id=4";
	$result6= mysqli_query($con, $sql6);
	$op4=$result6->num_rows;
	?>
	<div class="w3-panel w3-border w3-round-small"><?php echo "total ans  ".$n1.(round((($n1/$nn)*100),2))."%)";
	?></p><a onclick="hh('<?php echo $row['qid'];?>',1)" ><u>
	
	<?php
	echo "correct ans   ".$n2."(".round((($n2/$n1)*100),2)."%)";?>
	</u></a><br>
	<a onclick="hh('<?php echo $row['qid'];?>',2)" ><u><?php
	echo "wrong ans   ".$n3."(".round((($n3/$n1)*100),2)."%)";?>
	</u></a><br>
	<a onclick="hh('<?php echo $row['qid'];?>',3)" ><u><?php
	echo "option1    ".$op1."(".round((($op1/$n1)*100),2)."%)";?>
	</u></a><br>
	<a onclick="hh('<?php echo $row['qid'];?>',4)" ><u><?php
	echo "option2    ".$op2."(".round((($op2/$n1)*100),2)."%)";?>
	</u></a><br>
	<a onclick="hh('<?php echo $row['qid'];?>',5)" ><u><?php
	echo "option3    ".$op3."(".round((($op3/$n1)*100),2)."%)";?>
	</u></a><br>
	<a onclick="hh('<?php echo $row['qid'];?>',6)" ><u><?php
	echo "option4    ".$op4."(".round((($op4/$n1)*100),2)."%)";?>
	</u></a></div></div>
	<?php 
		$i++;
	}
	}
	else{
		echo"<br><center>--None--</center>";
	}
  if(isset($_POST['tot']))
{	

?><script>alert ("ok");</script>

<?php

} ?>


  <div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-card-4" style="max-width:600px">
    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
        <h2><div id="pppp"> <div></h2>
		<div class="w3-container">
   
</div>
      </div>
    
    </div>

</body>
</html>