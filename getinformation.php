<?php
$mysqli = new mysqli('123.207.141.93','root','a96S04d02','test');
$sql = "SELECT * FROM test where name='{$_POST['name']}';";
$res = mysqli_query($mysqli,$sql);
$out = mysqli_fetch_object($res);
if($out!=NULL)
{
    $arr=$out;
    $json=json_encode($arr);
    echo $json;    
}
else 
{
    echo 0;    
}
?>
