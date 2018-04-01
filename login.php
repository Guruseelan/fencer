<?php
session_start();

$con = new mysqli('localhost','root','','ding');

if(isset($_POST['login']))
{
	$sql = "SELECT *FROM login where uname='$_POST[name]'";
    $result = mysqli_query($con,$sql);
	$row=mysqli_fetch_array($result);
	
	if($_POST['name']==$row['uname'] and $_POST['pass']==$row['pword'])
		{
		if($row[utype]=="admin")
			header("location:admin.php");
		if($row[utype]=="teacher")
		{
			$_SESSION["ty"]="tec";
		}
		if($row[utype]=="student")
		{
			$_SESSION["ty"]="std";
		}
		$_SESSION["uname"] = $row['uname'];
		
		header("location:courses.php");
		
		}
		else
		{
		?><script>	alert("Email-Id or Password invalid"); </script> <?php	
		}
	

}
?>
<html>
    <head>
        <meta charset="UTF-8">

   <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
     <link rel="stylesheet" href="css/w3m.css">
	   <link rel="stylesheet" href="css/w3.css">
     <style>
	 body {
         background-color:rgb(255,255,255);
	 }
	 .w3-myfont {
  font-family: "Comic Sans MS", cursive, sans-serif;
}
	 </style>
	 <style>
body {
  background-color:white;
}

</style>

    </head>
<body>

 <div class="card-panel header #ef6c00 orange">
<img src="fen.png"></div>  
		<br><br>	   
		<div class="container">

		<div class="col s12 push-s3">
         <div class="col s12 m3">
		 <div class="card">
            <form method="post">   
            <div class="card-content black-text text-darken-2">
          	
            UserName:
             <input type="text" name="name" required placeholder="enter e-mail" title="enter valid user name"><br>
             Password:
			<input type="password" name="pass"  required placeholder="enter password" title="enter valid user name">
            
			<div class="card-action">
           <button class="btn waves-effect #ef6c00 orange" type="submit" name="login" value="login">Login</button>
			<br><br><u><a href="reg.php">New Register</a>
             
			 
			</u>
			<a href="">Forget Password?</a></div>
           
       
       </div> </form> 
       </div>
	     </div>
       </div>
		  </div> 
    </body>
</html>

