<?php 
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
header("Content-Type: text/html;charset=utf-8"); 
//@$mysqli=mysqli_connect("123.207.141.93","root","a96S04d02","test");
$file = $_FILES['picture'];//得到传输的数据
//得到文件名称
$name = $file['name'];
$filetype = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
$allow_type = array('psd','tif','gif','png','jpeg','jpg'); //定义允许上传的类型
//判断文件类型是否被允许上传
if(!in_array($filetype, $allow_type)){
  //如果不被允许，则直接停止程序运行
  echo "<script> alert('上传失败1');location.href='http://kukao.tk/upload.html'; </script>"; 
  return ;
}
//判断是否是通过HTTP POST上传的
if(!is_uploaded_file($file['tmp_name'])){
  //如果不是通过HTTP POST上传的
  echo "<script> alert('上传失败2');location.href='http://kukao.tk/upload.html'; </script>"; 
  return ;
}
$upload_path = "/var/www/html/haha/"; //上传文件的存放路径
//////////////////////////////////////
/*
@$Type=$_POST['Type'];
@$About=$_POST['About'];
@$Filename=$_POST['Filename'];
@$Email=$_POST['Email'];
$sql3="select User_ID from user where Email='$Email'";
$result3=mysqli_query($mysqli,$sql3);
$row3=mysqli_fetch_object($result3);
$User_ID=$row3->User_ID;
*/
//在library中插入数据
$uniName=md5(uniqid(microtime(true),true)).".".$filetype;//md5加密，uniqid产生唯一id，microtime做前缀
/*$sql2="insert into library(Filename,Type,File_date,About,User_ID,Name1,Name2)values('$Filename','$Type',now(),'$About','$User_ID','$name','$uniName');";
if (mysqli_query($mysqli,$sql2) != TRUE) {
    //未知错误
    $return['response']=-1;
    $json=json_encode($return);
    echo $json;
}
else
{*/
  if(move_uploaded_file($file['tmp_name'],$upload_path.$uniName))
  {
      $return['response']=1;
      $json=json_encode($return);
      echo "<script> alert('上传成功');location.href='http://kukao.tk/upload.html'; </script>"; 
  }
else echo 0;
/*
  else
  {
    $id = mysql_insert_id();
    if($id!=0)
    {
      $sql1="delete from library where File_ID=$id;";
      mysqli_query($mysqli,$sql1);
    }
      $return['response']=0;
      $json=json_encode($return);
      echo "<script> alert('上传失败');location.href='http://kukao.tk/upload.html'; </script>"; 
  } 
}
*/
?> 
