<html>
<head><title>log in</title>
<link type="text/css" rel="stylesheet"  href='all_style.css'>  <!-- 连接 大部分css -->
</head>
<style>
    #logframe{
        width:680px;
        height:500px;
        margin:80px auto;
        /*background-color:#fff;*/
        border-radius:20px;
        border:1px #999 solid;
    }

    #logframe tr td{
        text-align:center;

    }

    #login{
        text-align:left;
        border:1px #fff solid;
        font-size:60px;
    }
    .zhmm{
        font-size:40px;
        color:#888;
        text-align:right;
       /* border:1px red solid;*/
        width:220px;
        height:40px;
    }

    .inputframe{
        width:400px;
        height:70px;
        font-size:40px;
        border:none;
        border-bottom:1px #333 solid;
       
    }

    .ok{  /* 确定和取消 按钮*/
        width:300px;
        height:40px;
        background-color: transparent;
        border:1px #999 solid;
        border-radius: 20px;
        font-size:25px;
    }

    .goLogup{
        width:70px;
        height:25px;
        text-align:center;
        color:#77f;
        
        font-size:20px;
        border:none;
        background-color:transparent;
        

    }
    .downSub{
        height:10px;
        text-align:right;
        border:1px #000 solid;
    }
    .statement{
        color: white;
        margin: 0 auto;
        height: 25px;
        width: 785px;
        
    }
</style>
<body>
<?php include 'head.php';?>           <!-- 页眉导航 -->

<!-- 声明 -->
    <h1 class='statement'>本网站仅做交流和学习使用，不涉及任何商业经营行为</h1>
<div>
    <table id='logframe'>
        <tr id="login" >
            <td colspan="2" style='color:#666'>登 录</td>
        </tr>
        <form action='' method='post'>
        <tr>
            <td class="zhmm">账号:</td>
            <td><input type="text" name="userName" class='inputframe'></td>
        </tr>
        <tr>
            <td class="zhmm">密码:</td>
            <td><input type="password" name="userPassword" class='inputframe'></td>
        </tr>
        <tr>
            <td class="zhmm">验证码:</td>
            <td><input type="text" name="yzm" style='width:280px;height:70px;
                                                    font-size:40px; border:none;
                                                    border-bottom:1px #333 solid;' id='yzm'>
                <img src="captcha.php" onclick= "this.src='captcha.php?q=' + Math.random()" title="点击更换"/>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="确定" class="ok">
                <a href="index.php">
                    <input type="submit" name="return" value="返回" class="ok">
                </a>
            </td>
        </tr>
        <tr class='downSub'>
            <td></td>
            <td style='text-align:right;height:20px;'>
                <input type="submit" name="goLogup" value="注册" class="goLogup">
            </td>
        </tr>
        </form>
    </table>
</div>


<?php
//error_reporting(0);  // 抑制错误函数


session_start();

include "fun.php";   // 连接服务器，连接数据库*/

$sql="select * from user";              //设置sql语句
$result=mysqli_query($conn,$sql);       //执行查询

if(isset($_POST['submit']))             //如果按--确认--按键
{
    $Name=$_POST['userName'];         //获取输入的账号
    $password=$_POST['userPassword']; //获取输入的密码
    $yzm=$_POST['yzm'];               //获取输入的密码
    $yzmString=$_SESSION['string'];   //获取验证码真值
  
    if($yzm==$yzmString) //判断验证码是否正确
    {
        if($_POST['userName'] && $_POST['userPassword'])    //如果不为空
        {
            $sq="select * from user where name='$Name' and password='$password'";  //设置sql语句
            $re=mysqli_query($conn,$sq);//执行查询
            $row=mysqli_fetch_row($re);//获取一行
            
            if($row)
            {    
                $_SESSION['acc']="$Name";
                // echo "<script>alert('$next_url');</script>";
                $next_url = @$_SESSION['next_url'];
                if(isset($next_url)){
                    unset($_SESSION['next_url']);
                    header("Location:$next_url");
                }                
                else
                    header("Location:index.php");  
            }
            else
                echo "<script>alert('账号或密码错误');</script>";
        }
        else
            echo "<script>alert('你没有输入账号或密码');</script>";
    }
    else 
        echo "<script>alert('验证码错误');</script>";
}


if(isset($_POST['return']))  //如果按返回键
{
    header("Location:index.php");
}
if(isset($_POST['goLogup']))  //如果按注册键
{
    header("Location:logup.php");
}
?>

</body>

</html>

