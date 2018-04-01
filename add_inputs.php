<?php 
$n=$_GET['no_in'];
$o_type=$_GET['opt_type'];
if($o_type=="Radio")
{
for($x=0;$x<$n;$x++)
{
echo  "<div class='w3-half'> Answer ".($x+1).
"<textarea class='w3-input w3-border' name=ans[] required></textarea>";
echo  "<input class='with-gap' name='crt_ans' value='".($x+1)."' type='radio' 
id='<?php echo $x+1;?>' required/><label for='<?php echo $x+1;?>'>Correct Answer</label></div>";
}
}

else if($o_type=="Check Box")
{
for($x=0;$x<$n;$x++)
{
echo  "<div class='w3-half'> Answer ".($x+1).
"<textarea class='w3-input w3-border' name=ans[] required></textarea>";
	
echo "<input type='checkbox' name='chk_ans[]' value='".($x+1)."'
id='".($x+1)."'/><label for='".($x+1)."'>Correct Answer</label></div>";

}  
}

else if($o_type=="Text Box")
{
for($x=0;$x<$n;$x++)
{
echo  "<div class='w3-half'>Correct Answer ".($x+1).
"<textarea class='w3-input w3-border' name=ans[] required></textarea></div>";
}     
}
?>