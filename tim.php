<!DOCTYPE HTML>
<html>
<head>
<style>
p {
  text-align: right-side;
  font-size: 60px;
}
</style>
</head>
<body>


<p id="demo"></p>

<script>
var tt='<?php 
	$sql = "select *from $tn where qname='$_SESSION[qn]'";
		
//hours='<?php echo $h;?>';
//minutes='<?php echo $m;?>';
//seconds='<?php echo $s;?>';
   $result = $con->query($sql);
    $row = $result->fetch_assoc();
	list($h,$m,$s)=explode(':',$row['tim']);
$h=00;$m=30;$s=50;
$dd=date(DATE_RFC822);
list($d,$da,$m,$y,$hh,$mm,$ss)=explode(' ',$dd);
$mm=$m;
$y=date('Y');
list($h1,$m1,$s1)=explode(':',$hh);
$h1=$h1+4;
$t1=$mm." ".$da.",".$y." ".$h1.":".$m1.":".$s1;?>';
// Set the date we're counting down to
var t="dec 13, 2017 22:37:25";
var countDownDate = new Date(t).getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    var now = new Date().getTime();
    
    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML =  hours + "h "    + minutes + "m " + seconds + "s ";
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
    }
}, 1000);
</script>

</body>
</html>