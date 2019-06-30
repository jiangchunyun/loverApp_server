<?php
$mysqli = mysqli_connect("123.207.141.93","root","a96S04d02","test");
$sql = "SELECT * FROM comment WHERE comment_id='{$_POST['comment_id']}';";
$res = mysqli_query($mysqli,$sql);
while($out= mysqli_fetch_object($res))
{
    $arr[]=$out;
}
$json=json_encode(array_reverse($arr));
echo $json;
?>
