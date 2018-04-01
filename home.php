<?php
	include("main.php");
if(!isset($_SESSION["ty"]))
	header("location:logout.php");
	
?>
<html>
    <head>
   <meta charset="UTF-8">

   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <link rel="stylesheet" href="css/w3.css">
     <style>
	 body {
	 background-color:rgb(255,255,255);
	<!--   background-image: url("1.jpg");
background-repeat: no-repeat;
 background-attachment: fixed;
 background-size: cover;-->}
	      
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

</script>
</head>
    <body>
	<br>
	<br>
	<br>
  <div class="col s12 m7">
    <div class="w3-right-align"><h2 class="header"><?php echo $_SESSION["uname"];?></h2></div>
    <div class="card horizontal">
      <div class="card-image">
        <img src="l.png">
      </div>
      <div class="card-stacked">
        <div class="card-content">
          <p>"Make it as simple as possible, but not simpler." - Albert Einstein</p>
        </div>
        <div class="card-action">
          Every day do something that will inch you closer to better tomorrow! - Guru Seelan
        </div>
      </div>
    </div>
  </div>

	</body>
	</html>