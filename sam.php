<?php
 
if(isset($_POST['add']))
{
	$c="ckarr";

	$arr = $_POST[$c];
    $flavours = implode(',', $_POST[$c]);
    foreach($arr as $q => $q_value) 
	{
   //echo $q."   ".$q_value."<br>";
  
	  }
	  echo $flavours;
}

?><html>
    <head>
	  
       <link rel="stylesheet" href="css/w3.css">
       <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
      <script type="text/javascript" src="js/materialize.min.js"></script>
	  <script type="text/javascript" src="js/materialize.js"></script>
	  
	<script>  
 function fun(a,b)
 {
	 //alert(a);
	 document.getElementById(a).value&=b;
	// alert( document.getElementById(1).value);
 }
 </script>
	  </head>
<body>
<form method="post">
<input type="text" name="ckarr[1]" id="1" >
<input class="w3-check" name="1" onclick="fun('1','1')" value="Milk" type="checkbox">
<label>Milk</label>

<input class="w3-check" name="1" onclick="fun('1','2')" value="Sugar" type="checkbox">
<label>Sugar</label>

<input class="w3-check" name="1" onclick="fun('1','3')" value="Lemon" type="checkbox">
<label>Lemon </label>

<input type="text" name="ckarr[2]" id="2" >
<input class="w3-check"  onclick="fun('1')" value="Milk2" type="checkbox">
<label>Milk2</label>

<input class="w3-check"  onclick="fun('2')" value="Sugar2" type="checkbox">
<label>Sugar2</label>

<input class="w3-check"  onclick="fun('3')" value="Lemon 2" type="checkbox">
<label>Lemon 2</label>
<input type="submit" name="add" value="Add" />
 </form>

    </body>
</html>