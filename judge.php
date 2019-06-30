<?php
$mysqli = new mysqli('123.207.141.93','root','a96S04d02','test');
$sql = "SELECT name,x,y,lovername FROM test where name='{$_POST['name']}';";
$res = mysqli_query($mysqli,$sql);
$out = mysqli_fetch_object($res);
if($out->lovername!=NULL)
{
	$sql1 = "SELECT name,x,y,lovername FROM test where lovername='{$_POST['name']}';";
	$res1 = mysqli_query($mysqli,$sql1);
	$out1 = mysqli_fetch_object($res1);
	if($out1){
        $arr[]=$out;
	$arr1[]=$out1;
	$json = json_encode($arr);
	$json1 = json_encode($arr1);
	echo $json;
	echo $json1;
    }
    else 
    {
    	echo 0;
    }
}
else
{
        echo 0;
}
?>

