<?php
$mysqli=mysqli_connect("123.207.141.93","root","a96S04d02","test");
$name1=$_POST['name1'];
$name2=$_POST['name2'];
$sql="select portrait from test where name='$name1';";
$result=mysqli_query($mysqli,$sql);
$out=mysqli_fetch_object($result);
$arr[0]=$out;
$sql1="select portrait from test where name='$name2';";
$result1=mysqli_query($mysqli,$sql1);
$out1=mysqli_fetch_object($result1);
$arr[1]=$out1;
$json=json_encode($arr);
echo $json;
?>