<?php
header('Content-Type:text/html;charset=utf-8');
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
//////////////////////////////////////////////////////////////////////////
function uploadFile($file,$name1,$ServerList){
	@$mysqli = mysqli_connect("123.207.141.93","root","a96S04d02","test");
	$name = $file['name'];
	$filetype = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
	$allow_type = array('psd','tif','gif','png','jpeg','jpg'); //定义允许上传的类型

	//判断文件类型是否被允许上传
	if(!in_array($filetype, $allow_type))
	{
  		//如果不被允许，则直接停止程序运行
  		echo -1; 
      	return ;
	}

	//判断是否是通过HTTP POST上传的
	if(!is_uploaded_file($file['tmp_name']))
	{
  		//如果不是通过HTTP POST上传的
  		echo -1; 
      	return ;
	}

	$upload_path = "/var/www/html/picture/portrait/"; //上传文件的存放路径
	$uniName=md5(uniqid(microtime(true),true)).".".$filetype;//md5加密，uniqid产生唯一id，microtime做前缀
	$path='http://123.207.141.93/picture/portrait/'.$uniName;
	if(move_uploaded_file($file['tmp_name'],$upload_path.$uniName))
  	{
  		if($ServerList!='#')
  		{
  			unlink($ServerList);
  		}
		$sql1="update test set portrait='$path' where name='$name1';";
		mysqli_query($mysqli,$sql1);
    	echo 1; 
  	}
	else 
	{
		echo -1;
    }
}
//////////////////////////////////////////////////////////////////////////
$mysqli = new mysqli('123.207.141.93', 'root', 'a96S04d02', 'test');
$file = $_FILES['picture'];//得到传输的数据
$sql="SELECT * FROM test where name='{$_POST['name']}';";
$result = mysqli_query($mysqli,$sql);
$row = mysqli_fetch_object($result);
mysqli_query($mysqli,"SET NAMES `UTF-8`");
if($row) 
{
	$portrait=$row->portrait;//获取到原本的目录用于删除
	$List=substr($portrait,39);//截取到文件名
	if(strcmp($List,'default.png')!=0)
	{
		$ServerList='/var/www/html/picture/portrait/'.$List;//服务器的路径，用于组合删除
	}
	else
	{
		$ServerList='#';
	}
    $name1=$_POST['name'];
	uploadFile($file,$name1,$ServerList);
}
else 
{
  	echo 0;
}
?>
