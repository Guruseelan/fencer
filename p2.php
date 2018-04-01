<?php 
  $i=1;
  $l=0;
include("modules.php");
if(!isset($_SESSION["ty"]))
header("location:logout.php");
$con=new mysqli('localhost','root','',"ding");
$na=$_SESSION["uname"];


$tn=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_cnt';

$tq=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_q'.$_SESSION['qn'].'_que';
$tr=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_q'.$_SESSION['qn'].'_res';
$qn="q".$_SESSION['qn'];
$qq=$_SESSION['qn'];
$sql="select qname from $tn where no='$_SESSION[qn]'";
$result = $con->query($sql);
$row = $result->fetch_assoc();

if ($result->num_rows > 0) 
{
$qname=$row['qname'];
}
?>
<html>
<head>
   <meta charset="UTF-8">

   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <link rel="stylesheet" href="css/w3.css">
     <style>
	 body {
	 background-color:rgb(255,255,255);}
	 h3{
  font-family: "Comic Sans MS", cursive, sans-serif;
}
p#id {
  text-align: right-side;
  font-size: 60px;
  word-wrap: break-word;
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
 function chk_box(a,b)
 {
	 var str1 = document.getElementById(a).value;
	var str2 = b;
	var pos = str1.search(str2);
	if(pos>=0)
		str1= str1.replace(b,"");
	else
		str1= str1.concat(str2);
	document.getElementById(a).value= str1;
 }
  function txt_box(a,b)
 {
	 var str1 = document.getElementById(a).value;
	var str2 = b;
	document.getElementById(a).value= str1;
 }
	
</script>
</head>
<body>

<?php

if(isset($_POST['sub_quiz']))
{	
	
	$ttim=$_POST['rtim'];

unset($_SESSION['h']);
	unset($_SESSION['s']);
	unset($_SESSION['m']);
	unset($_SESSION[$qn]);
  	
	$sql="select tot from $tr where uname='$na'";
	$result = mysqli_query($con, $sql);
	$row = $result->fetch_assoc();
	if ($result->num_rows <= 0) 
	{
		$sql="insert into $tr(uname,tot) values ('$na',-1)";
		if (!$con->query($sql) == TRUE) 
			echo "Error ins: " . $con->connect_error;
		$sql="select tot from $tr where uname='$na'";
		$result = mysqli_query($con, $sql);
		$row = $result->fetch_assoc();
	}
	
	if($row['tot']==-1)
	{ 
	$sql="update $tr set tot=0 where uname='$na'";
	mysqli_query($con, $sql);
	if(!empty($_POST["o"]))
	{
		 $arr = $_POST["o"];
	$score=0;
	foreach($arr as $q => $q_value) 
	{
    $c_flag=0;
	$sql="select otype,ans,points,opt from $tq where qid='$q'";
	$result = mysqli_query($con, $sql);
	$row = $result->fetch_assoc();
	if($row['otype']=="Check Box")
	{
		
		$rr= $q_value;
		$rr=implode("",$rr);
		if($row['ans']==$rr)
		{
			$c_flag=1;$q_value=$rr;
		}
		$q_value=$rr;
	}
	else if($row['otype']=="Radio")
	{
		if($row['ans']==$q_value)
		{	
			$c_flag=1;
		}
	}
	else if($row['otype']=="Text Box")
	{
		
		$rr=implode("~~~", $q_value);
		
		if($row['opt']==$rr)
		{
			$c_flag=1;$q_value=1;
		}
		else
			$q_value=0;
	}
	if($c_flag==1)
	{
		$pts=$row['points'];
		$score=$score+$pts;
		$qi="q".$q;
		$sql="update $tr set $qi='$q_value' where uname='$na'";
		mysqli_query($con, $sql);
		$sql="update $tr set tot=tot+'$pts' where uname='$na'";
		mysqli_query($con, $sql);
	}
	else
	{
		$qi="q".$q;
		$sql="update $tr set $qi='$q_value' where uname='$na'";	
	mysqli_query($con, $sql);		
	}
	}
	$sql="update $tr set tim='$ttim' where uname='$na'";
	mysqli_query($con, $sql);
	?><script>alert("<?php echo "Your Score: ". $score; ?>");</script> <?php
	}
	}
	else
	{
		?><script>alert("<?php echo "Already Submitted! Your Score: ". $score;?>");</script> <?php
	}
	
}


$sql="select tot from $tr where uname='$na'";
	$result = mysqli_query($con, $sql);
	$row = $result->fetch_assoc();
	if ($result->num_rows <= 0) 
	{
		$sql="insert into $tr(uname,tot) values ('$na',-1)";
		if (!$con->query($sql) == TRUE) 
			echo "Error ins: " . $con->connect_error;
		$sql="select tot from $tr where uname='$na'";
		$result = mysqli_query($con, $sql);
		$row = $result->fetch_assoc();
	}
	
	if($row['tot']==-1)
	{ ?>
 <div class="w3-bottom">
<span class="w3-tag pulse w3-round w3-red w3-right w3-spin w3-xlarge" id="dista" ></span>
</div> 
<div class="w3-panel w3-border w3-border-red">
  <h3><?php echo $qname;?></h3><p id="pp"></p><p id="dem"></p>
</div>
<form method="post" action="p2.php" name="myform">
<?php
$sql1="select *from $tn where no='$qq'";
		$result1 = $con->query($sql1);
		$row = $result1->fetch_assoc();
$sql="select * from $tq";
$result= mysqli_query($con, $sql);
if($result->num_rows)
{
	$i=1;
 
if(!isset($_SESSION[$qn])){
	$_SESSION[$qn]=$row['tim'];
list($h,$m,$s)=explode(':',$_SESSION[$qn]);
	$_SESSION['h']=$h;
	
	$_SESSION['s']=$s;

	$_SESSION['m']=$m;
	?><script>
sessionStorage.s=<?php echo $_SESSION['s'];?>;
sessionStorage.h=<?php echo $_SESSION['h'];?>;
sessionStorage.m=<?php echo $_SESSION['m'];?>;	</script><?php
	
	}
?>

<script>

var seconds;
//sessionStorage.s=<?php echo $_SESSION['s'];?>;
var hours;
//sessionStorage.h=<?php echo $_SESSION['h'];?>;
var minutes;
//sessionStorage.m=<?php echo $_SESSION['m'];?>;	

var x = setInterval(function() {
if(sessionStorage.s)
{
	seconds=sessionStorage.s;
}
if(sessionStorage.m)
{
	minutes=sessionStorage.m;
}
if(sessionStorage.h)
{
	hours=sessionStorage.h;
}
seconds--;
sessionStorage.s=seconds;
sessionStorage.m=minutes;
sessionStorage.h=hours;
        if(seconds == -1) {
            seconds = 59;
			sessionStorage.s=seconds;
            minutes--;
			sessionStorage.m=minutes;

            if(minutes == -1) {
                minutes = 59;
                hours--;sessionStorage.h=hours;

                if(hours==-1) {
                nn();
	 document.myform.sub_quiz.click();
                  clearInterval(x);
                 
                }
            }
			      
        }
    if(hours<=0&&minutes>0){
		var k=minutes + "m " + seconds + "s ";
	 	}
		else if(hours<=0&&minutes<=0){
		var k=seconds + "s";
		//var k='@Session["sec"]';
		}
	else{
	var k=hours + "h "    + minutes + "m " + seconds + "s ";}	
	if(hours>=0){
		document.getElementById("rtim").value =  hours +":"+ minutes +":"+ seconds;
    document.getElementById("dista").innerHTML =  k;
    }
   
}, 1000);  
function nn(){
	sessionStorage.removeItem('s');
				 sessionStorage.removeItem('m');
				  sessionStorage.removeItem('h');
} </script>
 <?php
while($row2=mysqli_fetch_array($result))
{?>


<div class="w3-container">
 
  <?php
 
  

	
	?><div class="w3-panel w3-border">
	  <div class="w3-panel w3-border-bottom">
  <h3><?php echo "Question ".$i?></h3>
</div>
  <div class="w3-panel w3-border-bottom">
  <p><?php echo nl2br(htmlspecialchars($row2['ques']));?></p>
</div>
<?php
	$parts = explode( '~~~', $row2['opt']);
	if($row2['otype']=="Radio")
	{
	for($x=1;$x<=$row2['nopts'];$x++)
	{
	?>
	 <p>
	 <input class="with-gap" name="o[<?php echo $row2['qid'];?>]" 
	 value="<?php echo $x;?>" type="radio" id="<?php echo "op".$i.$x;?>"/>
     <label for="<?php echo "op".$i.$x;?>"><?php echo nl2br(htmlspecialchars($parts[$x-1]));?></label>
    </p><?php
	}
	}
	else if($row2['otype']=="Check Box")
	{
		
	for($x=1;$x<=$row2['nopts'];$x++)
	{
	?>
	 <p>
	 <input type="checkbox" name="o[<?php echo $row2['qid'];?>][]" 
	 value="<?php echo $x;?>" id="<?php echo "op".$i.$x;?>"/>
    <label for="<?php echo "op".$i.$x;?>"><?php echo nl2br(htmlspecialchars($parts[$x-1]));?></label>
	</p><?php
	}
	}
	else if($row2['otype']=="Text Box")
	{
		
	for($x=1;$x<=$row2['nopts'];$x++)
	{
	?>
	 <p>
	 <input class="w3-input w3-border w3-round-large" type="text" 
	 name="o[<?php echo $row2['qid'];?>][]" id="<?php echo "op".$i.$x;?>"/>
   </p><?php
	}
	}
	$i++;
	?>
	</div>

</div>
</div><?php } }?>
<button  name="sub_quiz" value="Submit" class="w3-button w3-round w3-red" onclick="nn()">Submit</button>
<input type="text" id="rtim" name="rtim"/>
  </form>
  <?php
	}
	else{
		echo"Already Submitted";
	}
?>
  </body>
  </html>