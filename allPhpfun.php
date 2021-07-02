<?php
error_reporting(0);  // 抑制错误函数
session_start();                 // 开始 会话

if(isset($_POST['outLogIn']))       // 按退出登录按钮时
{
    unset($_SESSION['acc']);     // 销毁 account  
    //header('location:index.php');
}


$acc=$_SESSION['acc'];

$connects=mysqli_connect('localhost','root','root_com');    //连接服务器
mysqli_select_db($connects,"store");                //连接数据库
$sqls="select * from user_info where tel=$acc";                    //设置sql语句
$results=mysqli_query($connects,$sqls);              //执行查询
$row=mysqli_fetch_row($results);//获取一行
list($index,$name,$sex,$tel,$email,$icon,$dates)=$row; //获取用户信息，序号，昵称，性别，电话，邮箱，头像url,日期

if($name==""){      //设置默认 昵称 和 默认头像
    $name=$acc;
    $icon='image/head_pic/default.jpg';
}

if(isset($acc)){    // log.php传过来的账号名,如果传过来有值,就运行函数
    echo "<script>";
    echo "document.getElementById('LogInName').innerHTML='你好：".$name."';";
    echo "document.getElementById('out').innerHTML=\"<form method='post'><input type='submit' name='outLogIn' value='退出登录' id='outt'></form>\";";    
    echo "document.getElementById('icon').innerHTML=\"<a href = 'user_center.php'><img src='$icon' id='icon' style='width:42px;height:42px;line-height:42px;border:2px #fff solid'></a>\";";    
    echo "</script>"; 
}
else
    echo "<script>console.log('没有登录！');</script>";
?>
