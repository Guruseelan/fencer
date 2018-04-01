<?php
session_start();


$con = new mysqli('localhost','root','','ding');
?>
<html>
    <head>
        <meta charset="UTF-8">

  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	 <link rel="stylesheet" href="css/w3m.css">
	  <link rel="stylesheet" href="css/w3.css">
  	
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script type="text/javascript" src="js/materialize.js"></script>
  <style>
  .w3-myfont {
  font-family: "Comic Sans MS", cursive, sans-serif;
}
    
	</style>
	
    </head>
<body class="#000000 white">
<?php

if(isset($_POST['reg']))
{
	$sql = "SELECT *FROM stud where uname='$_POST[uid]'";
   $result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) {
  
		?><script>	alert("Email id exists already enter new");</script> <?php
		}
	
	else
	{
		$sql ="insert into stud (uname,sname,dob,pword)values('$_POST[uid]','$_POST[name]','$_POST[da]','$_POST[pass]')";
		
		if ($con->query($sql) == TRUE)
			{
			
			$sql ="insert into login (uname,utype,pword)values('$_POST[uid]','student','$_POST[pass]')";
			
			if ($con->query($sql) == TRUE)
			{
			?><script>alert("Registered successfully");</script><?php
			header("location:login.php");
			}
			}			

	}
}
?>
       	<div class="row">
		 <div class="w3-panel #ef6c00 orange">
  <p class="w3-myfont"> Register into fENCEr to get started. A place to competative battle for students. A new way of 
  examing!!! <u><a href="teacher.php">Click To Teacher Registration</a> </u></p>
</div> 
		<div class="col s12 push-s3">
         <div class="col s12 m6">
		 <div class="card">
            <form method="post">   
            <div class="card-content black-text text-darken-2">
          	
             Entry Code:
             <input type="text" name="co" required placeholder="enter code" ><br>
			 UserName:
             <input type="text" name="name" required placeholder="enter user name" ><br>
             Email Id:
			 <input type="email" class="validate"  name="uid"  id="uid" required placeholder="enter user e-mail" ><br>
			 <label for="uid" data-error="wrong" data-success="right"></label>
			 Password:
			<input type="password" name="pass"  required placeholder="enter password" title="enter valid password">
           	 Date Of Birth:(mm/dd/yyyy)
            <input type="date"  name="da"  required>
			</div>
            <div class="card-action">
           <button class="btn waves-effect waves-light" type="submit" name="reg" value="reg">Register</button>	
			
             </div>
            </form> 
       
       </div>
       </div>
	     </div>
       </div>
        
      
		
    </body>
</html>

