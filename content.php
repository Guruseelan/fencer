<?php
//display module
include("main.php");
if(!isset($_SESSION["ty"]))
	header("location:logout.php");
$con = new mysqli('localhost','root','','ding');


$co_code=$_SESSION["cn"];

$sql="select cname from course where ccode='$co_code'";
		$result = $con->query($sql);
		$row = $result->fetch_assoc();
		if ($result->num_rows > 0) 
		{
			$c_name=$row['cname'];
		}
?>
<html>
<head>
<meta charset="UTF-8">
<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
<link rel="stylesheet" href="css/w3m.css">
  <link rel="stylesheet" href="css/w3.css">
  
  <script>
  var x=0;
  function w3_sd_nav()
  {
	  if(x==0)
	  {x=1;w3_open();  }
	  else
	  {x=0;w3_close();}  
  }
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}

</script>
</head>
<body>

<div class="w3-card-4 w3-white">
  
<button class="w3-button white  w3-xlarge" onclick="w3_sd_nav()">
<a class="btn-floating pulse orange">&#9776;</a></button><?php echo $c_name;?>
<div class="w3-sidebar w3-bar-block w3-border-right" style="display:none" id="mySidebar">
 <?php 
 if($_SESSION["ty"]=="tec")
  {?>
 <button onclick="document.getElementById('add_mdl').style.display='block'" class="w3-button w3-block w3-left-align w3-green">Add Module</button>
  <?php } 
$tn=$_SESSION['cn'].'_mdl';
$sql = "select *from $tn";
$result = $con->query($sql);
if(isset($_POST['add_module']))
{
	$sql = "SELECT *FROM $tn where mname='$_POST[mnme]'";
    $result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
  
		?><script>	alert("module already exist enter new name");</script> <?php
	}
	else
	{
	$sql = "insert into $tn(mname,dis)values('$_POST[mnme]','$_POST[dis]')";
	if (!$con->query($sql) == TRUE) 
    echo "Error crt: " . $con->connect_error;
	else
	{
		
		$sql = "SELECT no FROM $tn where mname='$_POST[mnme]'";
		$result = $con->query($sql);
		$row = $result->fetch_assoc();
		if ($result->num_rows > 0) 
		{
			$mno="m".$row['no'];
		}
		
		$na=$_SESSION['cn'].'_'.$mno.'_cnt';

		$sql="create table $na(no int auto_increment,primary key(no),qname varchar(20),dis varchar(200),pub int,qtype varchar(20),tim time);";
		if (!$con->query($sql) == TRUE) 
			echo "Error del2: " . $con->con->error;
		
	}
	}

}
?>
<ul class="w3-ul">

<?php

$tn=$_SESSION['cn'].'_mdl';
 
$sql = "select *from $tn";
$result = $con->query($sql);  



if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {?>
  <li class="w3-hover-blue">
  <a href="quiz.php?val=<?php echo "m".$row["no"];?>"  onclick="w3_sd_nav()"><u><?php echo $row["mname"];?></u></a>
		</li>
	<?php }
	}

 else {
    echo "No Modules";
}
	?>
 <li class="w3-hover">
  <a href="people.php" onclick="w3_sd_nav()"><u>People</u></a>
</li>
<?php	if($_SESSION["ty"]=="tec")
  {?> 
 <li class="w3-hover">
  <a href="edit_course.php" onclick="w3_sd_nav()"><u>Edit</u></a>
</li><?php } ?>  
 <li class="w3-hover-red">
  <a href="courses.php" onclick="w3_sd_nav()"><u>Exit</u></a>
</li>
	
</ul>
</div>
	
</div>



 
 
<div class="w3-container">
<div id="add_mdl" class="w3-modal">
<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

<div class="w3-panel w3-border-top w3-border-bottom">
<h3>Add Module</h3>
</div>

<span onclick="document.getElementById('add_mdl').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>

<form  method="post" action="content.php" class="w3-container">

<label class="w3-text-blue"><b>Module Name</b></label>
<input class="w3-input w3-border w3-margin-bottom" name="mnme" type="text">
<label class="w3-text-blue"><b>Discription</b></label>
<input class="w3-input w3-border" name="dis" type="text">

<div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
 <button class="w3-btn w3-blue" name="add_module" value="add" >Add</button>  
 <button onclick="document.getElementById('add_mdl').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>

</div>
</form>
</div>
</div>
</div> 	
</body>
</html>