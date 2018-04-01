<?php
include("modules.php");
	$con=new mysqli('localhost','root','',"ding");
	$tr=$_SESSION['cn'].'_'.$_SESSION['mdl'].'_q'.$_SESSION['qn'].'_res';
?>
<!DOCTYPE html>
<html>
    <head>
       <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	   
	   <link rel="stylesheet" href="css/w3m.css">
	    <link rel="stylesheet" href="css/w3.css">
       <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script type="text/javascript" src="js/materialize.js"></script>
	  
	  
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

<div class="w3-responsive">
<table class="w3-table-all w3-card-4">
    <tr>
	  <th>Rank</th>
      <th>User Name</th>
      <th>Points</th>
	  <th>Time</th>
    </tr>
 <?php
  $rank=1;
  
   $sql = "select *from $tr ORDER by tot desc, tim desc";
   $result = $con->query($sql);
   if ($result->num_rows > 0) {
	   
    while($row = $result->fetch_assoc()) {
       
		
		?>
      <tr>
	  <td><?php echo $rank; ?></td>
      <td><?php echo $row["uname"]; ?></td>
	  <td>
			<?php if($row["tot"]==-1)
				echo "0";
				else
					echo $row["tot"];?>
	 </td>
	 <td>
			<?php if($row["tot"]==-1)
				echo "NA";
				else
					echo $row["tim"];?>
	</td>
    </tr>
       
  <?php  $rank++;  }
}
 else {
    echo "0 results";
}
	?>
  </table>
</div>
    </body>
</html>
