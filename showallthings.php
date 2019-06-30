<?php
$mysqli = mysqli_connect("123.207.141.93","root","a96S04d02","test");
$name = $_POST['name'];
$mac = $_POST['mac'];
$sql5 = "select * from test where name='$name' and mac='$mac'";
$res5 = mysqli_query($mysqli,$sql5);
$row5 = mysqli_num_rows($res5);
if($row5>0)
{
$sql = "SELECT * FROM live order by id desc;";
$res = mysqli_query($mysqli,$sql);
while($out=mysqli_fetch_array($res,MYSQL_ASSOC))
{
	$arr1 = array();// 定义空数组获取评论
	$arr2 = array();//定义数组获取空间图片
	$arr3 = array();//定义数组获取头像
    $comment_id = $out['id'];
    $things_id = $out['id'];
    $name = $out['name'];
    $lovername = $out['lovername'];

	$sql1 = "SELECT * FROM comment WHERE comment_id=$comment_id;";
	$res1 = mysqli_query($mysqli,$sql1);
	while($out1 = mysqli_fetch_object($res1))
	{
		$arr1[]=$out1;
	}
	$out['comment']=$arr1;

	$sql2 = "select picture from live_picture where things_id=$things_id;";
	$res2 = mysqli_query($mysqli,$sql2);
	while($out2 = mysqli_fetch_object($res2))
	{
		$arr2[]=$out2;
	}
	$out['picture'] = $arr2;

	$sql3 = "select portrait from test where name='$name' or name='$lovername';";
	$res3 = mysqli_query($mysqli,$sql3);
	while($out3 = mysqli_fetch_object($res3))
	{
		$arr3[] = $out3;
	}
	$out['portrait'] = $arr3;

	$arr[]=$out; 

}
$json = json_encode($arr);
echo $json;
}
else
{
	echo '404';
}
?>
