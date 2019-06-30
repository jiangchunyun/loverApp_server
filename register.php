<?php
header('Content-Type:text/html;charset=utf-8');
//////////////////////////////////////////////////////////////////////////
function uploadFile($file,$name1){
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
      		$sql2="delete from test where name='$name1';";
      		mysqli_query($mysqli,$sql2);
  		return ;
	}

	//判断是否是通过HTTP POST上传的
	if(!is_uploaded_file($file['tmp_name']))
	{
  		//如果不是通过HTTP POST上传的
  		echo -2; 
      		$sql2="delete from test where name='$name1';";
      		mysqli_query($mysqli,$sql2);
  		return ;
	}

	$upload_path = "/var/www/html/picture/portrait/"; //上传文件的存放路径
	$uniName=md5(uniqid(microtime(true),true)).".".$filetype;//md5加密，uniqid产生唯一id，microtime做前缀
	$path='http://123.207.141.93/picture/portrait/'.$uniName;
	if(move_uploaded_file($file['tmp_name'],$upload_path.$uniName))
  	{
	$sql3="update test set portrait='$path' where name='$name1';";
	mysqli_query($mysqli,$sql3);
    	echo 1; 
  	}
	else 
	{
		echo -2;
      		$sql2="delete from test where name='$name1';";
      		mysqli_query($mysqli,$sql2);
	}
}
//////////////////////////////////////////////////////////////////////////
$file = $_FILES['picture'];//得到传输的数据
$sql="INSERT INTO test(name,password,x,y)VALUES('$_POST[name]','$_POST[password]','$_POST[x]','$_POST[y]');";
$mysqli = new mysqli('123.207.141.93', 'root', 'a96S04d02', 'test');
$res="SELECT * FROM test where name='{$_POST['name']}';";
$result = mysqli_query($mysqli,$res);
$row = mysqli_fetch_row($result);
mysqli_query($mysqli,"SET NAMES `UTF-8`");
if($row) {
    echo 0;//有重名
}
else {
    if (mysqli_query($mysqli,$sql) != TRUE) {
        echo -1;//未知错误
    }
    else
    {
    	$name1=$_POST['name'];
		uploadFile($file,$name1);
    }
}
?>
