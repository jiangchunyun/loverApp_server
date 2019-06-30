<?php
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
header("Content-Type: text/html;charset=utf-8"); 
$con=mysqli_connect("123.207.141.93","root","a96S04d02","test");
function _post($str){
    $val = !empty($_POST[$str]) ? $_POST[$str] : null;
    return $val;
}
$name=_post('name');
$password=_post('password');
$mac=_post('mac');
$sql = "select * from test where (name='$name') AND (password='$password')";
$result=mysqli_query($con,$sql);
$row=mysqli_num_rows($result);
if($row>0)
{
	$sql1 = "update test set mac='$mac' where name='$name';";
	$result1 = mysqli_query($con,$sql1);
	$row=mysqli_num_rows($result);
	if($row>0)
	{
		echo 1;
	}
    else 
    {
    	echo -1;
    }
}
else
{
	echo 0;
}
?>
