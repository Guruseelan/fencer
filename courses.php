<?php
//course display and add page
include("main.php");
	$con=new mysqli('localhost','root','',"ding");
?><html>
    <head>
        <meta charset="UTF-8">

   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <link rel="stylesheet" href="css/w3m.css">

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

if(isset($_POST['ch']))
{
	
	$_SESSION["cn"]=$_POST['ch'];
	header("location:content.php");
}
else if(isset($_POST['course_add']))
{
	$jc=$_POST['cde'].$_POST['jcde'];
	$sql = "SELECT *FROM course where cname='$_POST[cnme]' or ccode='$_POST[cde]' or jcode='$jc'";
    $result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) 
	{
  
		?><script>	alert("course already exist enter new name");</script> <?php
	}
	else
	{
	$sql = "insert into course(cname,uname,ccode,dis,jcode)values('$_POST[cnme]','$_SESSION[uname]','$_POST[cde]','$_POST[dis]','$jc')";
	if (!$con->query($sql) == TRUE) 
    echo "Error create: " . $con->connect_error;
	else
	{
		$na=$_POST['cde'].'_std';
		$sql="create table $na(no int auto_increment,primary key(no),sname varchar(40))";
		if (!$con->query($sql) == TRUE) 
			echo "Error del1: " . $con->error;
		$na=$_POST['cde'].'_mdl';

		$sql="create table $na(no int auto_increment,primary key(no),mname varchar(40),dis varchar(200))";
		if (!$con->query($sql) == TRUE) 
			echo "Error del2: " . $con->error;
		
	}
	}

}
else if(isset($_POST['join_cou']))
{
	$sql="select *from course where jcode='$_POST[jcde]'";
	$res=$con->query($sql);
	if($res->num_rows > 0)
	{
		$row = $res->fetch_assoc();
		$uname=$_SESSION["uname"];
		$tn=$row["ccode"]."_std";
		$sql="select * from $tn where sname='$uname'";  
		$res=$con->query($sql);
	if($res->num_rows == 0)
	{
	$sql="insert into $tn (sname) values ('$uname')";
	mysqli_query($con,$sql);
	$sql="insert into stdcou (uname,cname,ccode) values ('$uname','$row[cname]','$row[ccode]')";
	mysqli_query($con,$sql);
	}
	else{?>
		<script>	alert("Already joined"); </script><?php
	}
	}
else{
	?>
		<script>	alert("Course code Invalid"); </script><?php
	}
}
?>
<div class="w3-panel w3-border-top w3-border-bottom">
<h3>All Courses</h3>
<?php
if($_SESSION["ty"]=="std")
  {?>
 <button onclick="document.getElementById('jcou').style.display='block'" class="w3-button w3-green">Join Course</button>
  <?php } ?>
</div>  <?php 
 if($_SESSION["ty"]=="tec")
  {?>
 <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-left-align">
+Add Course</button>

<div id="Demo1" class="w3-container w3-hide">
<form  method="post" action="courses.php" class="w3-container">

<label class="w3-text-blue"><b>Course Name</b></label>
<input class="w3-input w3-border" name="cnme" type="text">

<label class="w3-text-blue"><b>Course Code</b></label>
<input class="w3-input w3-border" name="cde" type="text">


<label class="w3-text-blue"><b>Join Code</b></label>
<input class="w3-input w3-border" name="jcde" type="text" id="jcde1">

<label class="w3-text-blue"><b>Discription</b></label>
<input class="w3-input w3-border" name="dis" type="text">
 <button class="w3-btn w3-blue" name="course_add" value="add" >Add</button>
 
</form>
</div>
   <?php } 
 
if($_SESSION["ty"]=="tec")
	$sql = "select *from course where uname='$_SESSION[uname]'";
else
	$sql = "select *from stdcou where uname='$_SESSION[uname]'";
   $result = $con->query($sql);?>
<div class="row">
           
            <div class="col s12 m12">
            
<form method="post" action="courses.php">
<?php 

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {?>
	
	  <div class="col s12 m7">
       <div class="card horizontal">
      <div class="card-image">
        <img src="book.png">
      </div>
      <div class="card-stacked">
      
        <div class="card-action">
           <button value="<?php echo $row["ccode"]?>" name="ch" class="w3-button w3-block w3-left-align w3-blue" ><?php  echo $row["cname"]?></button><br>
        </div>
		
      </div>
</div>
  </div>
  
       
		
 <?php    }
}
 else {
    echo "0 results";
}
	?>	
	</form>
	
  
</div> 
<div class="w3-container">
<div id="jcou" class="w3-modal">
<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
<div class="w3-panel w3-border-top w3-border-bottom">
<h3>Join Course</h3>
</div>

<span onclick="document.getElementById('jcou').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>

<form  method="post" class="w3-container">

<label class="w3-text-blue"><b>Join Code</b></label>
<input class="w3-input w3-border" name="jcde" type="text">

<div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
 <button class="w3-btn w3-blue" name="join_cou" value="Join" >Join</button>  
 <button onclick="document.getElementById('jcou').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>

</div>
</form>
</div>
</div> 
</div>
</body>
</html>