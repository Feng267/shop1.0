<html>
<head><title>注册</title>
<link type="text/css" rel="stylesheet"  href='all_style.css'>  <!-- 连接 大部分css -->
</head>
<style>
    #logframe{
        width:680px;
        height:500px;
        margin:40px auto;
        /*background-color:#fff;*/
        border-radius:20px;
        border:2px #444 solid;
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
        font-size:30px;
        color:#444;
        text-align:right;
    }

    .inputframe{
        width:400px;
        height:70px;
        font-size:40px;
        border:none;
        border-bottom:1px #333 solid;
       
    }

    .ok{  /* 确定和取消 按钮*/
        width:330px;
        height:40px;
        background-color: transparent;
        border:1px #999 solid;
        border-radius: 20px;
        font-size:25px;
        margin:40px auto 10px;
    }

</style>
<body>
<?php include 'head.php';?>           <!-- 页眉导航 -->
<div>
    <table id='logframe'>
        <tr id="login" ><td colspan="2" style='color:#666;border-bottom:2px #444 solid'>注册</td></tr>
        
        <form action='' method='post'>
            <tr>
                <td class="zhmm">昵称:</td>
                <td><input type="text" name="fakeName" class='inputframe'  id='fakeName'></td>
            </tr>
            <tr>
                <td class="zhmm">手机号:</td>
                <td><input type="text" name="userName" class='inputframe' id='userName' placeholder='请输入11位手机号码'></td>
            </tr>
            <tr>
                <td class="zhmm">密码:</td>
                <td><input type="password" name="userPassword" class='inputframe' id='pwd'></td>
            </tr>
            <tr>
                <td class="zhmm">确认密码:</td>
                <td><input type="password" name="userPassword2" class='inputframe'  id='pwd2'></td>
            </tr>
            <tr>
                <td class="zhmm">性别:</td>
                <td style='font-size:20px'>
                    <input type="radio" name="sex" checked value="男">男 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="sex" value="女">女
                </td>
            </tr>
            <tr>
                <td class="zhmm">邮箱:</td>
                <td><input type="text" name="email" class='inputframe'  id='email' style='font-size:26px;'></td>
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
               <td colspan="2"><input type="submit" name="submit" value="确定" class="ok">
                    <a href="index.php"><input type="submit" name="return" value="返回" class="ok"></a></td>
            </tr>
        </form>
      
    </table>
</div>


<?php

 session_start();
 $yzmString=$_SESSION['string'];
 

error_reporting(0);  // 抑制错误函数
include "fun.php";  // 用于链接数据库

$sql="select * from user";              //设置sql语句
$result=mysqli_query($conn,$sql);       //执行查询


if(isset($_POST['submit']))   //如果按 提交按键
{
    $fakeName=$_POST['fakeName'];        /* 昵称 */

    $Name=$_POST['userName'];            /* 手机号 */

    $password=$_POST['userPassword'];    /* 密码1 */

    $password2=$_POST['userPassword2'];  /* 密码2 */

    @$sex=$_POST['sex'];                  /* 性别 */

    $email=$_POST['email'];              /* 邮箱 */

    $yzm=$_POST['yzm'];                   /* 验证码 */

    try
    {
        if(!$fakeName)
        {    
            throw new Exception('昵称不能为空');
        }
        if(!$sex)
        {    
            throw new Exception('性别不能为空');
        }
        if(!$email)
        {    
            throw new Exception('邮箱不能为空');
        }
        if(!$yzm)
        {    
            throw new Exception('验证码不能为空');
        }
        if($yzmString!=$yzm)
        {    
            throw new Exception('验证码错误');
        }
        
        if(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/',$email))
        {
           
        }
        else
            throw new Exception('邮箱不正确');
         

        if(!$_POST['userName'] || !$_POST['userPassword']|| !$_POST['userPassword2'])    //如果手机号，两个密码为空
        {
            throw new Exception('你没有输入账号或密码');
        }


        $sq="select * from user where name='$Name'";  //设置sql语句
        $re=mysqli_query($conn,$sq);               //执行查询
        $row=mysqli_fetch_row($re);                //获取一行
        list($acc,$passwd)=$row;  
        if($acc)
        {    
            throw new Exception('十分抱歉，此账号已经被注册了');
        }
        if(strlen($Name)<11)
        {    
            throw new Exception('请输入正确的手机号');
        }

        if( (strlen($password)<6) || (strlen($password)>16) )
        {
            throw new Exception('密码长度必须在6~16个数字或英文字母字符以内');
        }

        if($password!=$password2)
        {
            throw new Exception('两次密码不相同');
        }

        date_default_timezone_set('PRC');   //设置北京时间
        $dates=date("Y-m-d H:i:s");


        $sql2="insert into user(name,password,date) value ('$Name','$password','$dates')";
        $res=mysqli_query($conn,$sql2);               //执行查询,在user表中插入用户电话账号，密码，日期

        $sql3="insert into user_info(name,gender,tel,mailbox,head_pic,date) 
                                     value ('$fakeName','$sex','$Name','$email','image/head_pic/default.jpg','$dates')";
        $res2=mysqli_query($conn,$sql3);  //执行查询,在user_info表中插入 昵称，性别，电话，邮箱，默认头像，日期

        if($res && $res2)
        {
           echo "<script>alert('注册成功');window.location.href='login.php';</script>";
        }
        else 
            echo "<script>alert('注册失败');</script>";
    }
    catch(Exception $e)
    {
        $ms=$e->getMessage();
        echo "<script>
            alert('$ms');
            document.getElementById('fakeName').value='".$fakeName."';
            document.getElementById('userName').value='".$Name."';
            document.getElementById('pwd').value='".$password."';
            document.getElementById('pwd2').value='".$password."';
            document.getElementById('email').value='".$email."';
            </script>";
    }
    
}

if(isset($_POST['return']))  //如果按取消键
{
    header("Location:login.php");
}

?>
</body>
</html>

