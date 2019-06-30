<?php
$mysqli = mysqli_connect("123.207.141.93","root","a96S04d02","test");
$sql="INSERT INTO comment(comment_id,comment_name,comment)VALUES('$_POST[comment_id]','$_POST[comment_name]','$_POST[comment]');";
if(mysqli_query($mysqli,$sql)) {
    echo 1;
}
else {
   echo 0;
}
?>
