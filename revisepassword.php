<?php
$mysqli = mysqli_connect("123.207.141.93","root","a96S04d02","test");
$sql = "UPDATE test set password='{$_POST['password2']}' where name='{$_POST['name']}' AND password='{$_POST['password1']}';";
$res = mysqli_query($mysqli,$sql);
$row = mysqli_affected_rows($mysqli);
if($row)
{	
	echo 1;
}
else 
{
	echo 0;	
}
?>
