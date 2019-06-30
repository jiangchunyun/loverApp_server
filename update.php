<?php
$mysqli=new mysqli("123.207.141.93","root","a96S04d02","test");
$name=$_POST['username'];
$x=$_POST['userx'];
$y=$_POST['usery'];
$sql="update test set x='$x',y='$y' where name='$name'";
$result=$mysqli->query($sql);
$row=$mysqli->affected_rows;
if($row==1)
{
    echo 1;
}
else 
{
    echo 0;
}
?>
