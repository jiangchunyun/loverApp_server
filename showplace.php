<?php
$name = $_POST['name'];
$mysqli = mysqli_connect("123.207.141.93","root","a96S04d02","test");
$sql = "select x,y from live where name='$name' or lovername='$name'";
$res = mysqli_query($mysqli,$sql);
while($out = mysqli_fetch_object($res))
	{
		$arr[]=$out;
	}
$json = json_encode($arr);
echo $json;
?>
