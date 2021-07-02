<?php
$mysql_servername = "localhost";  //服务器端口
$mysql_username = "root";   //服务器用户名
$mysql_password = "";   //服务器密码

// 创建连接,连接数据库
$conn = new mysqli($mysql_servername, $mysql_username, $mysql_password) or die('连接失败');   //连接数据库
mysqli_query($conn, 'SET NAMES utf8');   //设置utf8编码
mysqli_select_db($conn, "store") or die('连接数据库失败');     //选择数据库


// 检测连接
if ($conn->connect_error) {
  die("连接失败: " . $conn->connect_error);
}
  //echo "连接成功";