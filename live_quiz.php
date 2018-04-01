<?php
session_start();
	if(!isset($_SESSION["ty"]))
		header("location:logout.php");
$con=new mysqli('localhost','root','',"ding");
	date_default_timezone_set("Asia/Kolkata");
$na=$_SESSION["uname"];

?>
<html>
    <head>
        <meta charset="UTF-8">

   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <link rel="stylesheet" href="css/w3m.css">
<script>

</script>
 </head>

<body>


<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
<div class="w3-container">

<div>
<form method="post" action="live_quiz.php" name="myform">
<?php

		$sql="select *from swift where uname='$na'";
		$result = $con->query($sql);
		$row = $result->fetch_assoc();
		if ($result->num_rows > 0) 
		{
			$c_c=$row['ccode'];
			$m_n=$row['mdl'];
			$q_n=$row['quz'];
			$qid=$row['qno'];
			$q=$row['ques'];
			$o_type=$row['otype'];	
			$q_a=$row['ans'];
			$tim1=$row['tim'];
			$pts=$row['points'];
			$t=date("H:i:s");
			
			
			$tn=$c_c."_".$m_n."_cnt";
			$sql="select qname from $tn where no='$q_n'";
			$result1 = $con->query($sql);
			$row1 = $result1->fetch_assoc();
			if ($result1->num_rows > 0) 
			{
				$qname=$row1['qname'];
			}
			
			$sql="select cname from course where ccode='$c_c'";
			$result1 = $con->query($sql);
			$row1 = $result1->fetch_assoc();
			if ($result1->num_rows > 0) 
			{
				$course_name=$row1['cname'];
			}
if(!isset($_SESSION[$t])){
		$_SESSION[$t]=$t;
		}
		

	list($hm,$ms,$sh)=explode(':',$tim1);
	//$s=str_replace("'","",$s);
	//$h=str_replace("'","",$h);
	//$m=str_replace("'","",$m);
	if(!isset($_SESSION['hm'])){
	$_SESSION['hm']=$hm;
	}if(!isset($_SESSION['sh'])){
	$_SESSION['sh']=$sh;
	}
	
	if(!isset($_SESSION['ms'])){
	$_SESSION['ms']=$ms;
	}
$dd=date(DATE_RFC822);
list($d,$da,$mo,$y,$hm)=explode(' ',$dd);
$mo=date('M');
$mm=date('m');
$da=date('d');
$y=date('Y');
$hh=$_SESSION[$t];
list($h1,$m1,$s1)=explode(':',$hh);
$dt=date('t');
//$s1=$s1+$s+2;
if($s1>59){
	$s1=$s1-60;
	$m1=$m1+1;
}
//$m1=$m1+$m;
if($m1>59){
	$m1=$m1-60;
	$h1=$h1+1;
}
// $h1=$h1+$h;
if($h1>23){
	$h1=$h1-24;
	$da=$da+1;
	if($da>$dt){
		$da=$da-$dt;
		if($mm==12){
			$y=$y+1;
		}
		$mo=date('M',strtotime('+1 month',$mo));
	}
}
$t1=$mo." ".$da.",".$y." ".$h1.":".$m1.":".$s1; 

		?>
		<script>

var seconds=<?php echo $_SESSION['sh'];?>;
var hours=<?php echo $_SESSION['hm'];?>;
var minutes=<?php echo $_SESSION['ms'];?>;	

var x = setInterval(function() {
if(sessionStorage.sh)
{
	seconds=sessionStorage.sh;
}
if(sessionStorage.ms)
{
	minutes=sessionStorage.ms;
}
if(sessionStorage.hm)
{
	hours=sessionStorage.hm;
}
seconds--;
sessionStorage.sh=seconds;
sessionStorage.ms=minutes;
sessionStorage.hm=hours;
        if(seconds == -1) {
            seconds = 59;
			sessionStorage.sh=seconds;
            minutes--;
			sessionStorage.ms=minutes;

            if(minutes == -1) {
                minutes = 59;
                hours--;sessionStorage.hm=hours;

                if(hours==-1) {
                nn();
	 document.myform.live_ans.click();
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
    document.getElementById("dem").innerHTML =  k;
    }
   
}, 1000);  
function nn(){
	sessionStorage.removeItem('sh');
				 sessionStorage.removeItem('ms');
				  sessionStorage.removeItem('hm');
} </script>
<div class="w3-panel" >
	   <h4><?php echo $course_name."  ".$qname;?></h4>
      <h3 ><?php echo "Question ".$q;?></h3><p id="dem" align="left"></p>
	 
   <div class="w3-panel w3-border w3-round-small">
  <p><?php echo nl2br(htmlspecialchars($row['ques']));?></p>
   </div>
<?php
	$parts = explode( '~~~', $row['opt']);
	if($row['otype']=="Radio")
	{
	for($x=1;$x<=$row['nopts'];$x++)
	{
	?>
	 <p>
	 <input class="with-gap" name="op" 
	 value="<?php echo $x;?>" type="radio" id="<?php echo "op".$x;?>"/>
     <label for="<?php echo "op".$x;?>"><?php echo nl2br(htmlspecialchars($parts[$x-1]));?></label>
    </p><?php
	}
	}
	else if($row['otype']=="Check Box")
	{
		
	for($x=1;$x<=$row['nopts'];$x++)
	{
	?>
	 <p>
	 <input type="checkbox" name="op[]" 
	 value="<?php echo $x;?>" id="<?php echo "op".$x;?>"/>
    <label for="<?php echo "op".$x;?>"><?php echo nl2br(htmlspecialchars($parts[$x-1]));?></label>
	</p><?php
	}
	}
	else if($row['otype']=="Text Box")
	{
		
	for($x=1;$x<=$row['nopts'];$x++)
	{
	?>
	 <p>
	 <input class="w3-input w3-border w3-round-large" type="text" 
	 name="op[]" id="<?php echo "op".$x;?>"/>
   </p><?php
	}
	}
	?>
<button  name="live_ans" value="Submit" onclick="nn()">Submit</button><?php	} ?>


  </form>
  </div>
  </div>
  </div>
  <?php
  if(isset($_POST['live_ans']))
	{		

unset($_SESSION['hm']);
	unset($_SESSION['sh']);
	unset($_SESSION['ms']);
	$res_tn=$c_c."_".$m_n."_q".$q_n."_res";
	$qi="q".$qid;
	$q_ans=$_POST['op'];
	
	if($o_type=="Check Box")
	{
		
		$rr= $q_ans;
		$rr=implode("",$rr);
		if($q_a==$rr)
		{
			$c_flag=1;$q_ans=$rr;
		}
		$q_value=$rr;
	}
	else if($o_type=="Radio")
	{
		if($q_a==$q_ans)
		{	
			$c_flag=1;
		}
	}
	else if($o_type=="Text Box")
	{
		
		$rr=implode("~~~",$q_ans);
		
		if($row['opt']==$rr)
		{
			$c_flag=1;$q_ans=1;
		}
		else
			$q_ans=0;
	}
	if($c_flag==1)
	{
		$sql="update $res_tn set $qi='$q_ans',tot=tot+'$pts' where uname='$na'";
	}
	else
		$sql="update $res_tn set $qi='$q_ans' where uname='$na'";

	if(empty($_POST['op']))
	{
		$q_ans=0;
	}
	
	if (!mysqli_query($con,$sql)) 
		echo "Error anse: " . $con->error;
	
	$sql="delete from swift where ccode='$c_c' and mdl='$m_n' 
	and quz='$q_n' and qno='$qid' and uname='$na'";
	if (!$con->query($sql) == TRUE) 
			echo "Error del: " . $con->connect_error;
	header("location:courses.php");
	exit();
	}?>
 </body>
  </html>