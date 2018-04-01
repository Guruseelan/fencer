<?php
//modify reanme course
session_start();
if(!isset($_SESSION["ty"]))
	header("location:logout.php");
	$con = new mysqli('localhost','root','','ding');	
	$code=$_SESSION["cn"];	
	$sql = "SELECT *FROM course where ccode ='$code'";
    $result = $con->query($sql);
	if ($result->num_rows >= 0)
	{
  		while($row = $result->fetch_assoc()) 
		{
			$c_name=$row['cname'];
			$c_dis=$row['dis'];
		}
	}

if(isset($_POST['rename']))
{
	$c_n=$_POST['c_nme'];
	$c_c=$_POST['c_cde'];
	$c_d=$_POST['c_dis'];
	$sql="update course set cname='$c_n' ,ccode= '$c_c', dis='$c_d' where ccode='$code'";
	if (!mysqli_query($con,$sql)) 
		echo "Error rename: " . $con->error;
	
	$sql="update stdcou set cname='$c_n' ,ccode= '$c_c' where ccode='$code'";
	if (!mysqli_query($con,$sql)) 
		echo "Error rename: " . $con->error;
	
	if($code!=$c_c)
	{
	$t=$code."_mdl";
	echo $t;
	$sql="select *from $t";// module table
	
	$result = $con->query($sql);
	if ($result->num_rows > 0) 
	{
	while($row = $result->fetch_assoc()) 
	{
	$t=$code."_".$row['mname']."_cnt";// for each module cnt_table
	$sql="select *from $t";
	$result1 = $con->query($sql);
	if ($result1->num_rows > 0) 
	{
	while($row1 = $result1->fetch_assoc()) 
	{
		$t=$code."_".$row['mname']."_".$row1['qname']."_que";//old quiz que
		$tr=$c_c."_".$row['mname']."_".$row1['qname']."_que";//new 
		$sql="rename table $t to $tr";
		if (!mysqli_query($con,$sql)) 
			echo "Error rename:".$t;
		$t=$code."_".$row['mname']."_".$row1['qname']."_res";//old qiz res
		$tr=$c_c."_".$row['mname']."_".$row1['qname']."_res";//new
		$sql="rename table $t to $tr";
		if (!mysqli_query($con,$sql)) 
			echo "Error rename:".$t;
	}
	}
	$t=$code."_".$row['mname']."_cnt";//old 
	$tr=$c_c."_".$row['mname']."_cnt";//new
	$sql="rename table $t to $tr";
	if (!mysqli_query($con,$sql)) 
		echo "Error rename:".$t;
	}
	}
	$t=$code."_mdl";//old
	$tr=$c_c."_mdl";//new
	$sql="rename table $t to $tr";
	if (!mysqli_query($con,$sql)) 
		echo "Error rename:".$t;
	
	$t=$code."_std";//old
	$tr=$c_c."_std";//new
	$sql="rename table $t to $tr";
	if (!mysqli_query($con,$sql)) 
		echo "Error rename:".$t;
	
	$_SESSION["cn"]=$c_c;
	header("location:co_rename.php");
	}	
	
}

?>
<html>
<head>
<meta charset="UTF-8">
<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
<link rel="stylesheet" href="css/w3m.css">
  <link rel="stylesheet" href="css/w3.css">
  
</head>
<body>
<script>

function rename_c() 
  {
	  var f=0;
	  var c_name=document.getElementById("c_nme").value;
	  var c_cde = document.getElementById("c_cde").value;
	  var c_dis = document.getElementById("c_dis").value;
	  if(c_name==""||c_cde==""||c_dis=="")
		  alert("null");
	 
	

		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				f=this.responseText;
				if(f==1)
					alert("Renamed");
            }
        };
        xmlhttp.open("GET","edit.php?c_name="+c_name+"&c_cde="+c_cde+"&c_dis="+c_dis, true);
        xmlhttp.send();
		
  }
  </script>
  <body>
  <form  method="post" class="w3-container">
<label class="w3-text-blue"><b>Course Name</b></label>
<input class="w3-input w3-border" name="c_nme" value="<?php echo $c_name;?>" type="text" required>

<label class="w3-text-blue"><b>Course Code</b></label>
<input class="w3-input w3-border" name="c_cde" value="<?php echo $_SESSION["cn"];?>" type="text" required>

<label class="w3-text-blue"><b>Discription</b></label>
<input class="w3-input w3-border" name="c_dis" value="<?php echo $c_dis;?>"type="text" required>
 <button type="submit" class="w3-btn w3-blue" name="rename">Modify</button>
<button class="w3-btn w3-blue" name="delete">Delete</button>
</div>

</form>
</body>
</html>
