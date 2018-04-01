<?php
	include("content.php");
	date_default_timezone_set("Asia/Kolkata");
	if(!isset($_SESSION["ty"]))
	header("location:logout.php");
	$con=new mysqli('localhost','root','',"ding");
	
	$mdl=$_GET['val'];
	$_SESSION['mdl']=$mdl;
	$tn=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_cnt';
	$ts=$_SESSION['cn'].'_std';
	
?>

<html>
    <head>
       <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	   <link rel="stylesheet" href="css/w3m.css">
	  
       <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script type="text/javascript" src="js/materialize.js"></script>
	  
	  
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
if(isset($_POST['qui']))
{
	$_SESSION['qn']=$_POST['qui'];
				
		echo '<script type="text/javascript">
				location.replace("p2.php");
			  </script>';
}
if(isset($_POST['quilve']))
{
		$_SESSION["qn"]=$_POST['quilve'];
		echo '<script type="text/javascript">
				location.replace("lboard_swift.php");
			  </script>';
}

if(isset($_POST['quil']))
{
	$sql = "update $tn set pub=1 where no='$_POST[quil]'";
    if (!$con->query($sql) == TRUE) 
			echo "Error del: " . $con->connect_error;
}

if(isset($_POST['quiz_add']))
{
	
	$sql = "SELECT *FROM $tn where qname='$_POST[qnme]'";
    $result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
  
		?><script>alert("quiz already exist enter new");</script> <?php
	}
	else
	{
		$ttim=date($_POST['hh'].":".$_POST['mm'].":".$_POST['ss']);
	
	$sql = "insert into $tn(qname,dis,pub,qtype,tim)values('$_POST[qnme]','$_POST[dis]',0,'$_POST[qt]','$ttim')";

   if (!$con->query($sql) == TRUE) 
    echo "Error in create: " . $con->connect_error;
	else
	{
		
		$sql = "SELECT no FROM $tn where qname='$_POST[qnme]'";
		$result = $con->query($sql);
		$row = $result->fetch_assoc();
		if ($result->num_rows > 0) 
		{
			$qno="q".$row['no'];
		}
		
		$na=$_SESSION['cn'].'_'.$mdl.'_'.$qno.'_que';
		
		if($_POST['qt']=="Live")
		{
	
$sql="CREATE TABLE $na(qid int auto_increment,primary key(qid),ques varchar(2000),
otype varchar(10),nopts int,ans varchar(25),points int,opt varchar(5100),expl varchar(1000),tim time,pub int default 0);";
		}
		else
		{
	
$sql="CREATE TABLE $na(qid int auto_increment,primary key(qid),ques varchar(2000),
otype varchar(10),nopts int,ans varchar(25),points int,opt varchar(5100),expl varchar(1000));";

		}
		
		if (!$con->query($sql) == TRUE) 
			echo "Error CREATE: " . $con->connect_error;
		
		$na=$_SESSION['cn'].'_'.$mdl.'_'.$qno.'_res';
		
		$sql="create table $na(no int auto_increment,primary key(no),uname varchar(40),
		tot int default -1,tim time)";
		
		if (!$con->query($sql) == TRUE) 
			echo "Error creTE: " . $con->connect_error;
		
		$sql="select *from $ts";
		$result = $con->query($sql);
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc())
			{
				$sql1="insert into $na(uname) values ('$row[sname]')";
				if (!$con->query($sql1) == TRUE) 
					echo "Error del: " . $con->connect_error;
				
			}

		}
	}
}
}

 if($_SESSION["ty"]=="tec")
  {?>
 <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-left-align">
+Add Quiz</button>

<div id="Demo1" class="w3-container w3-hide">
<form  method="post"  class="w3-container">

<label class="w3-text-blue"><b>Add Quiz</b></label>
<input class="w3-input w3-border" name="qnme" type="text">
<label class="w3-text-blue"><b>Discription</b></label>
<input class="w3-input w3-border" name="dis" type="text">

<label class="w3-text-blue"><b>Duration</b></label>

  <div class="w3-tag w3-round w3-orange" style="padding:3px">
    <div class="w3-tag w3-round w3-white w3-border w3-border-white">
  <div class="w3-row-padding">  
<div class="w3-third">
   <input placeholder="hh" class="w3-input w3-border" type="number" name="hh" min="0" max="24">
 </div><div class="w3-third">
    <input placeholder="mm"class="w3-input w3-border" type="number" name="mm" min="0" max="60">
 </div><div class="w3-third">
  <input placeholder="ss" class="w3-input w3-border" type="number" name="ss" min="0" max="60">
</div>
</div>	
</div></div>

      <input class="with-gap" name="qt" value="Post" type="radio" id="sme" required />
      <label for="sme">Post</label>
    
      <input class="with-gap" name="qt" value="Live" type="radio" id="sbn" />
      <label for="sbn">Live</label>
   
	<button class="w3-btn w3-blue" name="quiz_add" value="add" >Add</button>
</form>
</div>
   <?php
  }

  if($_SESSION["ty"]=="tec")
  	$sql = "select *from $tn";
  else
	  $sql = "select *from $tn where pub=1";
  $result = $con->query($sql);
?>
<form method="post">
<?php 

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {?>



<div class="w3-panel  w3-round w3-border w3-border-red w3-hover-border-green">
<h3 class="w3-text-orange"/>
<?php  echo $row["qname"];?>
<div class="w3-right-align">
<?php 
if($row['qtype']=='Post')	
{ 
?>
<button class="w3-button w3-round w3-orange w3-text-white" value="<?php echo $row["no"]?>" name="qui">Enter</button>	
<?php
}
else
{
?>
<button class="w3-button w3-round w3-orange w3-text-white" value="<?php echo $row["no"]?>" name="quilve">Enter</button>		
<?php 
}
	if($_SESSION["ty"]=="tec")
	{
	if($row['pub']==0) 
	{ ?>
	<button class="w3-button w3-round w3-orange w3-text-white" value="<?php echo $row["no"]?>" name="quil">Show</button> <?php 
	}
	}
	?>	</div>	</div>
  
		
<?php  }  }
 else 
    echo "0 results";

  ?>  
</form>        
  		
    </body>
</html>
