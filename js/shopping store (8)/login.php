<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>登陆界面</title>
    <style>
        body
        { 
            background:url(images/bg.png);
            background-size:100%;
         }
         #main{
             width: 350px;
             height: 250px;
             margin:230px auto;
             padding: 7px 2px 2px 7px ! important;
             background-image: linear-gradient(45deg,#a7f6f6 , white , #f8bdc6);
             border-radius: 10px ! important;;
             opacity:0.8 ! important;
         }
         form{
             float: left;
             width: 335px;
             height: 235px;
             border: 1px solid white;
             background-color: white;
             border-radius: 5px;
         }
         h3{
             margin:20px 0px 0px 50px;
             color: black;
             font-family:"楷体";

            /*
                字体线性渐变
                background-image: linear-gradient(45deg,#a7f6f6 , #f8bdc6);
                -webkit-background-clip: text; 必需加前缀 -webkit- 才支持这个text值 
                -webkit-text-fill-color: transparent; text-fill-color会覆盖color所定义的字体颜色： 
            */
         }
         .div_line{
             padding-left: 50px;
         }
         input{
             width: 200px;
             height: 30px;
             margin:10px 0px 0px 0px;   
             border: none;
             border-bottom: 6px solid;
             border-image: linear-gradient(transparent, rgba(200, 220, 201, 1), transparent) 5 5 ! important;
         }
         .code_input{
             width: 60px;
             height: 30px;
             margin:10px 0px 0px 0px;   
             border: none;
             border-bottom: 6px solid;
             border-image: linear-gradient(transparent, rgba(200, 220, 201, 1), transparent) 5 5 ! important;
         }
         .div_btn button{
             border: none;
             border-radius: 25px;
             width: 230px;
             height: 35px;
             margin:10px 0px 0px 55px;
             background-color: #7eeadf;
         }
         .div_btn button span{
            display: inline-block;
            position: relative;
            transition: 0.5s;
         }
         button span:after {
            content: '>>';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
         }
         button:hover span {
            padding-right: 25px;
         }

         button:hover span:after {
            opacity: 1;
            right: 0;
         }
    </style>
  </head>
  <body>
        <div id="main" class="shadow p-3 mb-5 bg-white rounded">
            <form action="" method="post">
                <h3>数码暴龙后台登录</h3>
                <div class="div_line">
                    <div >账号:<input type="text" name="name" autocomplete="off"></div>
                    <div >密码:<input type="text" name="password" autocomplete="off"></div>
                    <div >验证码:<input type="text" class="code_input" name="verify_code" autocomplete="off"><img src="captcha.php" onclick="this.src='captcha.php?q=' + Math.random()" title="点击更换"/></div>
                    
                </div>
                <div class="div_btn"><button name="sub" value="登录"><span>登陆</span></button></div>
            </form>
        </div>
  </body>
  <?php
    if(isset($_POST["sub"])){
        $name = @$_POST["name"];
        $password = @$_POST["password"];
        $code = @$_POST['verify_code'];

        session_start();
        $code1 = $_SESSION['authcode'];
        if($code != $code1)
        {
            echo "<script>alert('验证码错误');</script>";
        }
        else if($name and $password)
        {
            require "data_control/fun.php";
            $sql1  = "SELECT name,password FROM user_admin WHERE name='$name' and password='$password'";
            $result1 = mysqli_query($conn,$sql1)or die("错误描述: " . mysqli_error($conn));
            $check = mysqli_fetch_assoc($result1);  //若查询不到信息，返回的数据为空，则$check为空
            if($check){
                $_SESSION["user_admin"] = $name;
                header("location:index.php");  //或者换成location:index.php?name=$name&password=$password
            }
            else{
                echo "<script>alert('账号或密码错误');</script>";
            }
        }
        else{
            echo "<script>alert('账号或密码为空');</script>";
        }  
    }
  ?>
</html>