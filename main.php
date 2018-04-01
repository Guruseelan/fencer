<?php
	session_start();
	if(!isset($_SESSION["ty"]))
		header("location:logout.php");
$con=new mysqli('localhost','root','',"ding");
$na=$_SESSION["uname"];

?>
 <html>
  <head>
       <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	   <link rel="stylesheet" href="css/w3m.css">
	     <link rel="stylesheet" href="css/w3.css">
       <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script type="text/javascript" src="js/materialize.js"></script>
	  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	 <script>


function drp_menu() {
    var x = document.getElementById("drp_cnt");
    if (x.className.indexOf("w3-show") == -1) {  
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}

	
function fun()
{
	
	var xmlhttp = new XMLHttpRequest();
		
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                f=this.responseText;
            }
        };
		xmlhttp.open("GET", "lchk.php", true);
        xmlhttp.send();
if(f>0)
{	
document.getElementById('live_load').style.display='block';  
$('#live_load').load('live_quiz.php');
clearInterval(myTimer);
}
}

var myTimer = setInterval(myClock, 1000);
function myClock() 
{
    fun();
}
</script>
<style>
html, body, {
    position:fixed;
    top:0;
    bottom:0;
    left:0;
    right:0;
	width:100%;
	height:100%;
}
</style>
	
  </head>
<body>
<div class="w3-bar w3-orange">
 
   
  <div class="w3-dropdown-click w3-right">
   <button onclick="drp_menu()" class="w3-button w3-large w3-orange">&#9776; Menu</button>
 
      <div id="drp_cnt" class="w3-dropdown-content w3-bar-block w3-border">
    <a class="w3-bar-item w3-button" onclick="drp_menu()" href="home.php" >Dashboard</a>
   <a class="w3-bar-item w3-button" onclick="drp_menu()" href="courses.php" >Courses</a>
     <a class="w3-bar-item w3-button" onclick="drp_menu()" href="logout.php">Logout</a>
   </div>
  </div>

     <img src="fen.png">
	
</div>


<div id="live_load" class="w3-modal">


</div>
  


</body>
</html>