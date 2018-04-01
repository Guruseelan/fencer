<?php
//edit 
session_start();
if(!isset($_SESSION["ty"]))
	header("location:logout.php");
$con = new mysqli('localhost','root','','ding');
?>
<html>
<title>Edit course</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <head>
        <meta charset="UTF-8">

   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <link rel="stylesheet" href="css/w3m.css">
	  <link rel="stylesheet" href="css/w3.css">

  </head>
<body>

<!-- Sidebar -->
<div class="w3-sidebar w3-light-grey w3-bar-block" style="width:10%">
  <h3 class="w3-bar-item">Edit</h3>
  <a href="co_rename.php" target="edit_fra" target="edit_fra" class="w3-bar-item w3-button">Course</a>
    <a href="edit_mdl.php" target="edit_fra" class="w3-bar-item w3-button">Modules</a>
	<a href="people.php" target="edit_fra" class="w3-bar-item w3-button">People</a>

  
</div>

<!-- Page Content -->
<div style="margin-left:10%">
<div class="w3-container">


 <div zclass="w3-main" id="ed_fr">

  <iframe src="" name="edit_fra" height="90%" width="100%"></iframe>
</div> 
</div>
      
</body>
</html>