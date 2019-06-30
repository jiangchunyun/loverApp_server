
<?php
header('Content-Type:text/html;charset=utf-8');
//获取firstname的xy
$sql1="SELECT name,x,y FROM test where name='{$_POST['firstname']}';";
//获取secondname的xy
$sql2="SELECT name,x,y FROM test where name='{$_POST['secondname']}';";
//将数据存入lovers数据库
$sql3 = "UPDATE test set lovername='{$_POST['secondname']}' where name='{$_POST['firstname']}';";
$sql4 = "UPDATE test set lovername='{$_POST['firstname']}' where name='{$_POST['secondname']}';";
$mysqli = new mysqli('123.207.141.93','root','a96S04d02','test');
//判断是否有secondname的用户
$res="SELECT * FROM test where name='{$_POST['secondname']}' and lovername is NULL;";
$result = mysqli_query($mysqli,$res);
if(!mysqli_fetch_object($result))
{
    echo 0;
}
else {
        $result1=mysqli_query($mysqli,$sql1);
        $result2=mysqli_query($mysqli,$sql2);
        $out1= mysqli_fetch_object($result1);
        $out2= mysqli_fetch_object($result2);
        $arr[0]=$out1;
        $arr[1]=$out2;
        $json=json_encode($arr);
        echo $json;
        if (mysqli_query($mysqli,$sql3) != TRUE || mysqli_query($mysqli,$sql4) !=TRUE) {
        echo -1;//未知错误
    }
}
?>
