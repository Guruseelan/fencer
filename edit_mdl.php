<?php
session_start();
if(!isset($_SESSION["ty"]))
	header("location:logout.php");
$con = new mysqli('localhost','root','','ding');
$tn=$_SESSION['cn'].'_mdl';

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
  <script>
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace("w3-black", "w3-red");
    } else { 
        x.className = x.className.replace(" w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace("w3-red", "w3-black");
    }
}
</script>
<body>
<?php
$sql = "select *from $tn";
$result = $con->query($sql);  

if ($result->num_rows > 0) 
{
    while($row = $result->fetch_assoc()) 
	{

	?><button onclick="myFunction('<?php echo $row["mname"];?>')" class="w3-button w3-block w3-left-align" style="width:30%"><?php echo $row["mname"];?>
	</button><a href=""><u>edit</u></a>
<div id="<?php echo $row["mname"];?>" class="w3-hide w3-container">
 <?php
 $tn=$_SESSION['cn']."_".$row["mname"]."_cnt";
$sql = "select *from $tn";
$result1 = $con->query($sql);  

if ($result1->num_rows > 0) 
{
	 while($row1 = $result1->fetch_assoc()) 
	{
	echo $row1["qname"]."   ".$row1["dis"]."   ".$row1["qtype"]."<br>";
	}
}
else
	echo "empty"; ?>

</div>
	<?php }
}
 else 
 {
    echo "No Modules";
}?>
<button onclick="document.getElementById('ided').style.display='block'" class="w3-button-small w3-block w3-left-align w3-green">Edit</button>
<class="w3-modal">
<div id="ided" class="w3-modal">
<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

<div class="w3-panel w3-border-top w3-border-bottom">
<h3>EDit</h3>
</div>

<span onclick="document.getElementById('ided').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
<div class="w3-container">
sdgvb
</div>
</div>

<body>
</html>