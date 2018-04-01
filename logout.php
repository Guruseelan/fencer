<?php  
ini_set('display_errors','0');
?>
<script>sessionStorage.clear();</script>
<?php
$_SESSION=array();
			session_destroy();
session_start();
session_unset(); 
session_destroy();


header("location:login.php");	
?>