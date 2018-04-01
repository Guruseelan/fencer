<?php
include("content.php");
	if(!isset($_SESSION["ty"]))
	header("location:logout.php");
	$con=new mysqli('localhost','root','',"ding");
$na=$_SESSION["uname"];

?>
<html>
    <head>
        <meta charset="UTF-8">

 
     <link rel="stylesheet" href="css/w3m.css">
	 <link rel="stylesheet" href="css/w3.css">
	 
	
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script type="text/javascript" src="js/materialize.js"></script>
	   	<script src="js/init.js"></script>
		  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
 <script>

</script>
 </head>
<body>
  <body>
 

<div class="w3-bar orange">
<?php  
	if($_SESSION["ty"]=="tec")
	{?>
    <a href="p1.php"  class="w3-bar-item w3-button w3-hover-blue"><u>Add Question</u></a>
	<?php }
?>
<a href="p2.php"  class="w3-bar-item w3-button w3-hover-blue"><u>Quiz</u></a>
    <a href="ans.php"  class="w3-bar-item w3-button w3-hover-blue"><u>Answer</u></a>
    <a href="lboard.php"  class="w3-bar-item w3-button w3-hover-blue"><u>Score Card</u></a>
	<?php  
	if($_SESSION["ty"]=="tec")
	{?>
	<a href="sta.php"  class="w3-bar-item w3-button w3-hover-blue"><u>Statistics</u></a> <?php } ?>
  </div>

</body>
	</html>