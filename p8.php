<?php
	session_start();
	if(!isset($_SESSION["ty"]))
	header("location:logout.php");
$con=new mysqli('localhost','root','',"ding");
$tq=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_'.$_SESSION['qn'].'_que';
?>
<html>
<head>
   <meta charset="UTF-8">

   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <link rel="stylesheet" href="css/w3.css">
     <style>
	 body {
	 background-color:rgb(255,255,255);}


	      
	 </style>
	 <script>
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}

	
</script>
</head>
<body>
<?php 
$tn="swift";
$tc=$_SESSION['cn'];
if(isset($_POST['add']))
{
	
	$ques=$_POST['ques'];
	$ans=$_POST['ans'];
	$op1=$_POST['op1'];
	$op2=$_POST['op2'];
	$op3=$_POST['op3'];
	$op4=$_POST['op4'];
	$sql="insert into $tq(ccode,pub,ques,ans,op1,op2,op3,op4) values('$tc',0,'$ques','$ans','$op1','$op2','$op3','$op4')";
	if (!mysqli_query($con,$sql)) 
    echo "Error create: " . $con->error;
}
?>
 <button onclick="myFunction('D1')" class="w3-button w3-block w3-left-align">
+Add Question</button>

<div id="D1" class="w3-container w3-hide">
<div class="card-panel">
<form method="post">
question <textarea class="w3-input w3-border" name="ques" required ></textarea>
 <div class="w3-row-padding">
 <div class="w3-half">
Answer<input type="text" class="w3-input w3-border" name="ans" required>
</div>
 <div class="w3-half">
 

  
 <div class="w3-row-padding">
   <div class="w3-half">
 <textarea class="w3-input w3-border" name="op1" required placeholder="Option 1" ></textarea>    </div>
 
  <div class="w3-half">
 <textarea class="w3-input w3-border" name="op2" required placeholder="Option 2" ></textarea>
  </div></div>
<br>

 <div class="w3-row-padding">
  <div class="w3-half">
 <textarea class="w3-input w3-border" name="op3" required placeholder="Option 3" ></textarea>
  </div>
<div class="w3-half">
 <textarea class="w3-input w3-border" name="op4" required placeholder="Option 4" ></textarea>
  </div>
</div>
<div class="card-action"><button name="add">ADD</button></div>


</form></div></div></div>
</div>
<div class="row">
<div class="col s12 m12">

 <?php

	$sql = "select *from $tq";
   $result = $con->query($sql);
   if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {?>
 
 <div class="w3-card-4">

<header class="w3-container w3-light-grey">
  <h3>Qestion id <?php echo $row['qid'];?></h3>
</header>

<div class="w3-container">
  <p><?php echo  nl2br($row['ques']);?></p>
  <hr>
  <p><?php echo " Ans:Option: ". $row['ans'];?></p>
</div>

<button class="w3-button w3-dark-grey">Launch</button>
</div>
	
      <?php    }
}
 else {
    echo "0 results";
}
	?>





</body></html>