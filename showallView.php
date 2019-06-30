<?php
$city = $_POST['city'];
$mysqli = mysqli_connect("123.207.141.93","root","a96S04d02","test");
$sql = "select * from View where city='$city' order by comment ";
$res = mysqli_query($mysqli,$sql);
while($out = mysqli_fetch_object($res))
  {
    $arr[]=$out;
  }
$json = json_encode($arr);
echo $json;
?>
