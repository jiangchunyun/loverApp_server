<?php
$mysqli = mysqli_connect("123.207.141.93","root","a96S04d02","test");
$sql1="SELECT thing_id,people from praise where thing_id='$_POST[thing_id]' and people='$_POST[people]';";
$result1 = mysqli_query($mysqli,$sql1);
$row1 = mysqli_fetch_row($result1);
if($row1)
{
        echo 1;
}
else
{
        echo 0;
}
?>
