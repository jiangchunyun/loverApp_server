<?php
//设置页面内容是html编码格式是utf-8
header('Content-Type:text/html;charset=utf8');

//服务器名
$servername = "123.207.141.93";
//账户名
$username = "root";
//密码
$password = "a96S04d02";
//数据库名
$dbname = "test";

//接收数据
$id = $_POST['id'];
//连接数据库
$mysqli = mysqli_connect($servername,$username,$password,$dbname);
//sql语句
$sqlDeleteLive = "DELETE FROM live where id = $id";
$sqlSelectLive = "SELECT * FROM live where id = $id";
$sqlDeleteComment = "DELETE FROM comment where comment_id = $id";
$sqlSelectComment = "SELECT * FROM comment where comment_id = $id";
$sqlDeletePicture = "DELETE FROM live_picture where things_id = $id";
$sqlSelectPicture = "SELECT * FROM live_picture where things_id = $id";

$result = mysqli_query($mysqli,$sqlSelectComment);
$row = mysqli_num_rows($result);
//判断评论查询结果
if($row >= 0)
{
	//没有评论
	if($row == 0)
	{
		//直接进行图片的查询
		$result = mysqli_query($mysqli,$sqlSelectPicture);
		$row = mysqli_num_rows($result);
		//判断图片查询结果
		if($row >= 0)
		{
			//没有图片
			if($row == 0)
			{
				//直接进行说说查询
				$result = mysqli_query($mysqli,$sqlSelectLive);
				$row = mysqli_num_rows($result);
				//判断说说查询结果没有说说
				if($row == 0)
				{
					echo -1;
				}
				//判断说说查询结果有说说需要删除
				else
				{
					$result = mysqli_query($mysqli,$sqlDeleteLive);
					$row = mysqli_affected_rows($result);
					//进行说说删除的判断删除失败
					if($row == 0)
					{
						echo 0;
					}
					//删除成功
					else
					{
						echo 1;
					}
				}
			}
			//有图片需要删除
			else
			{
				//进行图片删除
				$result = mysqli_query($mysqli,$sqlDeletePicture);
				$row = mysqli_num_rows($result);
				//判断图片删除结果删除失败
				if($row == 0)
				{
					echo 0;
				}
				//删除成功
				else
				{
					//进行说说查询
					$result = mysqli_query($mysqli,$sqlSelectLive);
					$row = mysqli_num_rows($result);
					//判断说说查询结果没有说说
					if($row == 0)
					{
						echo -1;
					}
					//判断说说查询结果有说说需要删除
					else
					{
						$result = mysqli_query($mysqli,$sqlDeleteLive);
						$row = mysqli_affected_rows($result);
						//进行说说删除的判断删除失败
						if($row == 0)
						{
							echo 0;
						}
						//删除成功
						else
						{
							echo 1;
						}
					}
				}
			}

		}
		//数据库错误
		else
		{
			echo 0;
		}
	}
	//有评论需要删除
	else
	{
		//先进行删除评论操作
		$result = mysqli_query($mysqli,$sqlDeleteComment);
		$row = mysqli_affected_rows($result);
		//删除评论判断删除成功
		if($row > 0)
		{
			//直接进行图片的查询
			$result = mysqli_query($mysqli,$sqlSelectPicture);
			$row = mysqli_num_rows($result);
			//判断图片查询结果
			if($row >= 0)
			{
				//没有图片
				if($row == 0)
				{
					//直接进行说说查询
					$result = mysqli_query($mysqli,$sqlSelectLive);
					$row = mysqli_num_rows($result);
					//判断说说查询结果没有说说
					if($row == 0)
					{
						echo -1;
					}
					//判断说说查询结果有说说需要删除
					else
					{
						$result = mysqli_query($mysqli,$sqlDeleteLive);
						$row = mysqli_affected_rows($result);
						//进行说说删除的判断删除失败
						if($row == 0)
						{
							echo 0;
						}
						//删除成功
						else
						{
							echo 1;
						}
					}
				}
				//有图片需要删除
				else
				{
					//进行图片删除
					$result = mysqli_query($mysqli,$sqlDeletePicture);
					$row = mysqli_num_rows($result);
					//判断图片删除结果删除失败
					if($row == 0)
					{
						echo 0;
					}
					//删除成功
					else
					{
						//进行说说查询
						$result = mysqli_query($mysqli,$sqlSelectLive);
						$row = mysqli_num_rows($result);
						//判断说说查询结果没有说说
						if($row == 0)
						{
							echo -1;
						}
						//判断说说查询结果有说说需要删除
						else
						{
							$result = mysqli_query($mysqli,$sqlDeleteLive);
							$row = mysqli_affected_rows($result);
							//进行说说删除的判断删除失败
							if($row == 0)
							{
								echo 0;
							}
							//删除成功
							else
							{
								echo 1;
							}
						}
					}
				}

			}
		}
		//删除评论失败
		else
		{
			echo 0;
		}
	}
}
//数据库错误
else
{
	echo 0;
}

?>
