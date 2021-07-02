
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include "isLogin.php"; // 未登录不允许支付
    ?>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
    <link type="text/css" rel="stylesheet"  href='all_style.css'>  <!-- 连接 大部分css -->
    <link rel="stylesheet" href="./css/layui.css">   <!-- 引用的框架的css -->
    <script src="./js/layui.all.js"></script>    <!-- 引用的框架  -->
    <style>
        #frame{
            width:600px;
            height:370px;
            margin:100px auto;
            border-radius:20px;
            border:1px #999 solid;
        }
        #headFont{
          font-size:30px;
          color:#555;  
          margin:10px;
        }
        .st{
            width:200px;
            height:200px;
            float:left; 
            margin:0px 45px;
        }
        .paymethod{
            border:1px #555 solid;
            border-radius:20px;
            color:#555;
            text-align:center;
            font-size:20px;
            height:50px;
            width:200px;
            line-height:50px;
            margin:10px auto;
            background-color:#fff;
        }
        .paymethod:hover{
            box-shadow:inset 1px 1px 7px #555;
        }
       
        .pic{
            width:250px;
            height:250px;
            float:left;
            border:1px #555 solid;
            background-size:100%;
            color:#000;
        }
        .pic1{
            background-image:url(image/Pay1.jpg); 
        }
        .pic2{
            background-image:url(image/Pay2.jpg);
        }
        .pic3{
            background-image:url(image/Pay3.jpg);
        }
        .zfcg{
            width:250px;
            height:250px;
            line-height:250px;
            float:left;
            background-color:#fff;
            
        }
        .payicon{
            width:50px;
            height:50px;
            line-height:50px;
            color:#fff;
            background-color:#0f0;
            border-radius:25px;
            font-size:30px;
            margin:50px auto 0px;
            text-align:center;
        }
        .payok{
            width:180px;
            height:100px;
            line-height:100px;
            color:#0f0;
            font-size:40px;
            text-align:center;
            
            margin:0px auto;
        }


        /*----------------按钮---------------- */
        #but{
            width:200px;
            height:25px;
            clear:both;
           
        }
        .confirm_cancel{
           text-align:center; 
           color:#000;
           border-radius:20px;
           border:1px #000 solid;
            width:60px;
            height:25px;
            margin:20px 20px;
        }
        .confirm_cancel:hover{
           color:#fff;
           background-color:#05f;
        }
        #confirm{
            float:left;
            
        }
        #cancel{
            float:left;
            
        }

        
       

    </style>
</head>
<body>
<?php 
    $OrderId=@$_GET['order_id'];    //确认订单界面传来订单号
    if(!isset($OrderId))
    {
        echo "<script>alert('没有订单可以处理');
              window.location.href='index.php';</script>";
    }
?>
    <?php  include('head.php');?>
    <?php  include('allPhpfun.php');?>
    <div id='frame'>
        <div id='headFont'>选择支付方式</div>
        <br>
       
        <div class='st'>
            <ul><form action='' method='post'><input type='submit' value='微信支付' class='paymethod' name='wx'></form></ul>
            <ul><form action='' method='post'><input type='submit' value='支付宝支付' class='paymethod' name='zfb'></form></ul>
            <ul><form action='' method='post'><input type='submit' value='云闪付支付' class='paymethod' name='ysf'></form></ul>
            
            <div id='but'>
                <form  method='post'><input type='submit' value='确认' class='confirm_cancel' id='confirm' name='confirm' ></form>
                <form action='index.php' method='post'><input type='submit' value='返回' class='confirm_cancel' id='cancel'></form>
            </div>
        </div>

        <?php
            if(isset($_POST['wx'])){
                echo "<div class='pic pic1'></div>";
            }
            if(isset($_POST['zfb'])){
                echo "<div class='pic pic2'></div>";
            }
            if(isset($_POST['ysf'])){
                echo "<div class='pic pic3'></div>";
            }
            if(isset($_POST['confirm'])){
                include 'fun.php';//连接数据库
                $upSql="update order_info set order_status='已付款待发货' where order_id=".$OrderId;
                $result=mysqli_query($conn,$upSql);
                $err = mysqli_errno($conn);
                // 购买成功
                if(mysqli_affected_rows($conn)==1){
                    echo "<script>alert('购买成功！');</script>";
                    echo "<script>window.location.href='index.php';</script>";
                }
                else
                    echo "<script>alert('付款失败！');</script>";
                                 
            }
            
        ?>  
    </div>
</body>
<script>
    // setTimeout(window.location.href='index.php', 1);
        
</script>
</html>
