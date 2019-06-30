<?php
$mysqli=new mysqli("123.207.141.93","root","a96S04d02","test");
$sql = "UPDATE test set lovername=NULL where name='{$_POST['name']}' or name='{$_POST['lovername']}';";
$res = $mysqli->query($sql);
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
