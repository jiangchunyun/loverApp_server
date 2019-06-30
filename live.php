<?php
header('Content-Type:text/html;charset=utf-8');
//////////////////////////////////////////////////////////////////////////////////////////////////
if($_POST['name']==NULL||$_POST['lovername']==NULL||$_POST['x']==NULL||$_POST['y']==NULL||$_POST['things']==NULL||$_POST['location']==NULL)
{
echo 0;
return;
}
//////////////////////////////////////////////////////////////////////////////////////////////////
function uploadFile($file,$things_id){
	header('content-type:application:json;charset=utf8');  
	header('Access-Control-Allow-Origin:*');  
	header('Access-Control-Allow-Methods:POST');  
	header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
	header("Content-Type: text/html;charset=utf-8"); 

	@$mysqli = mysqli_connect("123.207.141.93","root","a96S04d02","test");
	$name = $file['name'];
	$filetype = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
	$allow_type = array('psd','tif','gif','png','jpeg','jpg'); //定义允许上传的类型

	//判断文件类型是否被允许上传
	if(!in_array($filetype, $allow_type))
	{
  		//如果不被允许，则直接停止程序运行
  		echo -2; 
      	$sql2="delete from live where id='$things_id';";
      	mysqli_query($mysqli,$sql2);
  		return ;
	}

	//判断是否是通过HTTP POST上传的
	if(!is_uploaded_file($file['tmp_name']))
	{
  		//如果不是通过HTTP POST上传的
  		echo -2; 
      	$sql2="delete from live where id='$things_id';";
      	mysqli_query($mysqli,$sql2);
  		return ;
	}

	$upload_path = "/var/www/html/picture/live_picture/"; //上传文件的存放路径
	$uniName=md5(uniqid(microtime(true),true)).".".$filetype;//md5加密，uniqid产生唯一id，microtime做前缀
	$path='http://123.207.141.93/picture/live_picture/'.$uniName;
	if(move_uploaded_file($file['tmp_name'],$upload_path.$uniName))
  	{
	$sql3="insert into live_picture(things_id,picture)values('$things_id','$path');";
	mysqli_query($mysqli,$sql3);
  	}
	else 
	{
		echo -2;
      	$sql2="delete from live where id='$things_id';";
      	mysqli_query($mysqli,$sql2);
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////
$sql="INSERT INTO live(name,lovername,x,y,things,location,timedate)VALUES('{$_POST['name']}','{$_POST['lovername']}','{$_POST['x']}','{$_POST['y']}','{$_POST['things']}','{$_POST['location']}',NOW());";
$mysqli = new mysqli('123.207.141.93', 'root', 'a96S04d02', 'test');
mysqli_query($mysqli,$sql);
$things_id = mysqli_insert_id($mysqli);
if ($things_id==0) {
    echo -1;
}
else 
{
	foreach ($_FILES as $fileInfo)
	{
	    	uploadFile($fileInfo,$things_id);
	}
	echo 1;
}

?>
