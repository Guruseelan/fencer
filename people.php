<?php
	include("content.php");
	if(!isset($_SESSION["ty"]))
	header("location:logout.php");
	$con=new mysqli('localhost','root','',"ding");
	 $tn=$_SESSION["cn"]."_std";
?>
<!DOCTYPE html>
<html>
    <head>
       <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	   
	   <link rel="stylesheet" href="css/w3m.css">
	    <link rel="stylesheet" href="css/w3.css">
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

if(isset($_POST['add']))
{
   if(empty($_POST["ckarr"]))
      echo("You didn't select any people.");
  else
  {
	$sql="select cname from course where ccode='$_SESSION[cn]'";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($res);
	$tt=$row['cname'];
	
	mysqli_query($con,$sql);
	$arr = $_POST["ckarr"];
    $N = count($arr);
    for($i=0; $i < $N; $i++)
	{
    $sql="insert into $tn (sname) values ('$arr[$i]')";
	mysqli_query($con,$sql);

    $sql="insert into stdcou (uname,cname,ccode) values ('$arr[$i]','$tt','$_SESSION[cn]')";
	mysqli_query($con,$sql);
   }
  }
}
if(isset($_POST['delete']))
{
   if(empty($_POST["ckarr_del"]))
      echo("You didn't select any people.");
  else
  {
	$arr = $_POST["ckarr_del"];
    $N = count($arr);
    for($i=0; $i < $N; $i++)
	{
    $sn=$arr[$i];
	$sql = "delete from $tn where sname='$sn'";
	if(!$con->query($sql) == TRUE) 
			echo "Error delete: " . $con->connect_error;
	$t_ccode=$_SESSION["cn"];
	$sql = "delete from stdcou where uname='$sn' and ccode='$t_ccode'";
	if(!$con->query($sql) == TRUE) 
			echo "Error delete: " . $con->connect_error;
		
   }
  }
}
  if($_SESSION["ty"]=="tec")
  {?>
 <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-left-align">
+Add People</button>

<div id="Demo1" class="w3-container w3-hide">
<form method="post">
	
 <?php
 
  $tn=$_SESSION["cn"]."_std";
   $sql = "select *from stud where uname not in (select sname from $tn)";
   $result = $con->query($sql);
   if ($result->num_rows > 0) {
	   
    while($row = $result->fetch_assoc()) {?>
       
		<input type="checkbox" name="ckarr[]" value="<?php echo $row["uname"];?>" id="<?php echo $row["uname"];?>"/>
      <label for="<?php echo $row["uname"];?>"><?php echo $row["uname"]."  -   ".$row["sname"];?></label><br>
       
      <?php    }
}
 else {
    echo "0 results";
}
  ?>
<input type="submit" name="add" value="Add" />

    </form>  
</div>

<form method="post">
<input type="submit" name="delete" value="Remove"/>
  <?php } ?>
<div class="w3-container">
    <table class="w3-table-all w3-card-4">
    <tr>
		<th>User Name</th>
      <th>Points</th>
	
    </tr>
 <?php
  
 
   $sql = "select *from $tn";
   $result = $con->query($sql);
   if ($result->num_rows > 0) {
	   
    while($row = $result->fetch_assoc()) {
       
		
		 
	 if($_SESSION["ty"]=="tec")
  {?> 
      <tr>
	 <td><input type="checkbox" name="ckarr_del[]" value="<?php echo $row["sname"];?>" id="<?php echo $row["sname"];?>"/>
      <label for="<?php echo $row["sname"];?>"><?php echo $row["sname"];?></label><br>
       </td>
	   <?php 
  }
  else
  {
	 ?>  
	   <td><?php echo $row["sname"]; ?></td>
  <?php } ?>
	   <td>0</td>
    </tr>
       
  <?php    }
}
 else {
    echo "0 results";
}
	?>
  </table>
</div>
</form>
    </body>
</html>
