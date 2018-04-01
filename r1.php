
<?php
//live ques
include("swift.php");
	if(!isset($_SESSION["ty"]))
	header("location:logout.php");
	$con=new mysqli('localhost','root','',"ding");
	$tn=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_q'.$_SESSION['qn'];
	$tq=$tn.'_que';
	$tr=$tn.'_res';
?>
<html>
<head>
   <meta charset="UTF-8">

   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <link rel="stylesheet" href="css/w3.css">
     <style>
	 body {
	 background-color:rgb(255,255,255);
	 }


	      
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

	function add_in()
	{
		n_in=document.getElementById('nof_ans').value;
		o_type=document.getElementById('opt_type').value;
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
				document.getElementById("ans").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","add_inputs.php?no_in="+n_in+"&opt_type="+o_type, true);
        xmlhttp.send();
	}
</script>
</head>
<body><?php 
$tc=$_SESSION['cn'];
if(isset($_POST['liveque_add']))
{

	if($_POST['opt_type']=="Check Box"&&empty($_POST["chk_ans"]))
      echo("You didn't select any Answer- Filed to add.");
	else
	{
	$ques=mysql_real_escape_string($_POST['ques']);
	$opt_type=$_POST['opt_type'];
	$nof_opt=$_POST['nof_ans'];
	if($opt_type=="Check Box")
	{
		$ans=implode("",$_POST["chk_ans"]);
	}		
	else if($opt_type=="Radio")
		$ans=$_POST['crt_ans'];
	else if($opt_type=="Text Box")
		$ans="txt";
	
	$p=$_POST['pts'];
	$opt_ans = mysql_real_escape_string(implode("~~~", $_POST["ans"])); 
	
	$ex=mysql_real_escape_string($_POST['exp']);
	
	$ttim=date($_POST['hh'].":".$_POST['mm'].":".$_POST['ss']);



$sql="insert into $tq(ques,otype,nopts,ans,points,opt,expl,tim,pub)
 values('$ques','$opt_type','$nof_opt','$ans','$p','$opt_ans','$ex','$ttim',0)";
	if (!mysqli_query($con,$sql))
		echo "Error create: " . $con->error;
  $sql = "select *from $tq order by qid desc limit 1";
  $result = $con->query($sql);
  $row = $result->fetch_assoc();
  $id='q'.$row['qid'];
  $sql="alter table $tr add($id varchar(25))";
	if (!mysqli_query($con,$sql)) 
		echo "Error lnch: " . $con->error;
	}
}


if(isset($_POST['qs_lnch']))
{
	
	$sql="update $tq set pub=1 where qid='$_POST[qs_lnch]'";//set pub=1
	if (!mysqli_query($con,$sql)) 
		echo "Error lnch: " . $con->error;
	
	$sql="select *from $tq where qid='$_POST[qs_lnch]'";//get ques
	$result = mysqli_query($con, $sql);
	$que_dtl = $result->fetch_assoc();
	
	$c_c=$_SESSION['cn'];
	$m_n=$_SESSION['mdl'];
	$q_n=$_SESSION['qn'];
	
	$qid=$que_dtl['qid'];
	$qu=mysql_real_escape_string($que_dtl['ques']);
	$qotype=$que_dtl['otype'];
	$qnopts=$que_dtl['nopts'];
	$qans=mysql_real_escape_string($que_dtl['ans']);
	
	$p=$que_dtl['points'];
	$ttim=$que_dtl['tim'];
	$qopt=mysql_real_escape_string($que_dtl['opt']);
	
	$t_name_std=$_SESSION['cn']."_std";
	$sql = "select *from $t_name_std";//get stud
	$result = $con->query($sql);
	while($row = $result->fetch_assoc())//insert to swift each stud
	{
	$u_n=$row["sname"];
    $sql="insert into swift(uname,ccode,mdl,quz,qno,ques,otype,nopts,ans,points,
	opt,tim)
	values('$u_n','$c_c','$m_n','$q_n','$qid','$qu','$qotype','$qnopts','$qans',
	'$p','$qopt','$ttim')";
	if (!mysqli_query($con,$sql)) 
		echo "Error insert: " . $con->error;
	
	}
}
?>
 <button onclick="myFunction('D1')" class="w3-button w3-block w3-left-align">
+Add Question</button>


<div class="row w3-container w3-hide" id="D1">
   
<div class="w3-panel w3-border w3-hover-border-red">
<form method="post" action="r1.php" class="w3-container">

<div class="w3-row-padding w3-panel w3-border w3-hover-border-red w3-round-large">
 <div class="w3-half">
Question <textarea class="w3-input w3-small w3-border" name="ques" required ></textarea>
</div>

 <div class="w3-half">
   <div class="w3-half">
Type
<select name="opt_type" id="opt_type" oninput="add_in()" class="w3-input w3-border">

<option value="Radio">Radio</option>
<option value="Check Box">Check Box</option>
<option value="Text Box">Text Box</option>

</select>
</div>
 <div class="w3-half">
Duration

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
</div></div></div>

  <div class="w3-half">
No.Of Ans
 <select name="nof_ans" id="nof_ans" oninput="add_in()" class="w3-input w3-border">
<?php for($i=0;$i<=5;$i++)
{?>
<option value="<?php echo $i;?>"><?php echo $i;?></option>
<?php } ?>
</select>
 </div>


  <div class="w3-half">
Points
<select name="pts" class="w3-input w3-border">
<?php for($i=0;$i<=10;$i++)
{?>
<option value="<?php echo $i;?>"><?php echo $i;?></option>
<?php } ?>
</select>
</div></div></div>
 <div class="w3-row-padding w3-panel w3-border w3-hover-border-red w3-round-large">
  <div class="w3-half">
 
 <div id="ans">
 </div>
 
 </div>
 <div class="w3-half">

Explanation<textarea class="w3-input w3-border" name="exp" placeholder="Explanation(optional)" ></textarea>
<div class="card-action"><button name="liveque_add">ADD</button></div>
</div>
</div>
</div>
</form></div>


<form method="post">
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
  <p><?php echo  "op1:".nl2br($row['opt']);?></p>
  <p><?php echo " Ans:Option: ". $row['ans'];?></p>
</div>
<?php if($row['pub']==0)
{?>
<button class="w3-button w3-dark-grey" value="<?php echo $row["qid"]?>" name="qs_lnch">Launch</button><?php } ?>
</div>
	
      <?php    }
}
 else {
    echo "0 results";
}
	?>
</form>
</body></html>