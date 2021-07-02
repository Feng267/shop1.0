<?php
    session_start();
    // include "isLogin.php";// 是否登录
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirm order</title>
    <link type="text/css" rel="stylesheet"  href='all_style.css'>  <!-- 连接 大部分css -->
    <style>
        
    html{
        background-image:url(image/G02.png);
        /*background-size:100%;*/
        background-repeat: no-repeat;
    }

#frame{
    width:1200px;
    /*height:1300px;*/
    margin:15px auto;
    /*border:1px #fff solid;*/
    border-radius:20px;
    /* background-color:#fff; */
    background-image:linear-gradient(rgba(255,255,255,60%), rgba(255,255,255,60%));
}
#top{
    width:1200px;
    height:80px;
    margin:15px auto;
    
}
#headline{
    width:400px;
    height:80px;
    line-height:80px;
    text-align:center;
    color:#fff;
    font-size:50px;
    margin:0px 20px;
    -webkit-text-stroke:1px #00f;/*（1px是文字宽度，#ff是文字描边颜色）*/
    float:left; 
    font-family:'黑体';
}

/*-------------流程图----------------- */
        #topTable{
            float:right;
            width:260px;
            height:70px;
            color:#000;
        }
        #topTable table{
            width:260px;
            height:60px;
            text-align:right;
        }
        #topTable table tr td{
            border:1px #fff solid;
            text-align:center;
            width:60px;
            height:60px;
            border-radius:30px;
            font-size:12px;
           
        }
        #cycle{
            background-color:#55f;  
            color:#000;
        }
        
       
 /*------------------------------ */
        #selectAdd{
            width:1200px;
            height:30px;
            margin:70px 20px 0px;   
        }
        #address{
            width:1200px;
            height:152px;
            margin:5px auto 30px;
            
        }
        .perAddress{     /* 每个地址框 */
            width:250px;
            height:120px;
            border:3px #000 dashed;
            float:left;
            margin:15px 22px;
            font-size:15px;
            position:relative;
        }
        
        #addAdmin{         /* 管理和新加 地址 按钮 */
            width:1150px;
            margin:20px auto;
            height:35px;
            color:#555;
            clear:both;
           
        }
        #newAddress{       /* 添加地址 按钮 */
            width:120px;
            height:30px;
            line-height:30px;
            float:left;
            border:none;
            color:#555;
            font-size:15px;
            text-align:left;
        }
        #newAddress:hover{
            color:#00f;
        }
        #manAddress{      /* 管理地址 按钮 */
            width:120px;
            height:30px;
            line-height:30px;
            float:left;
            color:#555;
            font-size:15px;
            text-align:left;
            border:none;
            /* background-color:#fff; */
        }
        #manAddress:hover{
            color:#00f;
        }


/*------------------------------------------------------- */     
        #comfirm{    /* 确认框架 */
            width:1200px;
            height:30px;
            margin:120px 20px 0px;   
        }
        
        #goodsTableHead{
            width:1200px;
            height:30px;
            margin:10px auto 0px;  
            color:#000;
        }
        #goodsTopTable {
            width:1200px;
            height:30px;
            text-align:center;
            font-size:20px; 
            border-bottom:3px #88f solid;
        }
        #goodsTopTable tr td{
            border:1px red solid;
            width:50px;
        }
/*----------------------------------------------- */
        #goodsTable{
            width:1150px;
            /*height:auto;*/
            margin:10px auto;
            border:1px #999 solid;
            text-align:center;
        }
        #goodsTable tr:first-child{
           color:#fff;
           background-color:#44f;
            
        }
        #goodsTable tr td{
            border:1px #999 solid;
            width:50px;
        }

        #goodsCount{
            text-align:center;border:none;width:30px;
        }

/*------------付款框----------------- */
        #sumMoney{
            width:1150px;
            height:140px;
            margin:20px 25px;
            /*float:right;*/
            color:#f00;
            text-align:right;
            /*border:3px #06f solid;*/
            /*position:relative;*/
           /* background-color:#999;*/
        }
        #subBut{
            /*border:1px blue solid;*/
            margin:10px 0px;
            text-align:right;
        }
        #okBut{                     /* 提交订单按钮 */
            width:80px;
            height:25px;
            background-color:#00f;
            color:#fff;
            float:right;
            margin:0px 0px 0px 15px;
            /* position:absolute;
            bottom:-27px;
            right:-3px; */
        }
        #okBut:hover{
            background-color:#04f;
        }
        #goindex{                   /* 返回按钮框架 */
            width:60px;
            height:25px;
            background-color:#00f;
            color:#fff;
            float:right;
            /* position:absolute;
            bottom:-27px;
            right:100px; */
        }
        #goindex input{
            width:60px;
            height:25px;
            color:#fff;
            text-align:center;
        }
         #goindex input:hover{
            background-color:#04f;
        }

.raFrame{
    width:250px;text-align:right;margin:0px auto;position:absolute;bottom:0;
}
input[type="radio"] {
    width:30px;
    height:30px;
    margin: 3px 3px 0px 5px;
}


</style>
</head>
<body>
<!----------------------------------- 接受url传的值  ------------------------------------------>
 <?php   
      
    $goods_id = @$_GET['goods_id'];       //获取主页或购物车传来的商品id
    if(!isset($goods_id))  //如果没有商品id就进入页面就警告，并且返回主页
    {
        echo "<script>alert('你还没有选择商品');
              window.location.href='index.php';</script>";
    }
    $isCart=@$_GET['isCart'];  
    $goods_number=@$_GET['goods_number'];//获取购物车传来的商品数量


    if(!isset($isCart))     //如果没有，表示不是购物车数据
        {
            $isCart = 0;
            if(!isset($goods_number))//如果没有，表示不是从商品详情页面过来，而是在主页点击了“立即购买”
                $goods_number = 1;  // 默认 主页来的商品数量为 1 
        }
    else 
        $isCart = 1;
    echo "<script>console.log('$goods_number');</script>"
 ?>   
<!----------------------------------- 接受url传的值  ------------------------------------------>


<?php include 'head.php';?>           <!-- 页眉导航 -->
<?php include 'side_nav.php';?>       <!-- 右边悬浮栏 -->
<?php
    $acc=$_SESSION['acc'];

    if(!isset($acc))  //如果没有登录就进入页面就警告，并且返回主页
    {
        $_SESSION['next_url'] = $_SERVER['REQUEST_URI'];// 当前页面的URL
        echo "<script>alert('你还没有登录哦! 去登陆吧！');
              window.location.href='login.php';</script>";
    }

    include 'fun.php'; //链接数据库

    $sql="select * from received_info where user_id=$acc";              //设置sql语句
    $result=mysqli_query($conn,$sql);       //执行查询

    $sq2="select count(*) from received_info where user_id=$acc";  /* 计算返回几行，用于循环 */
    $sum2=mysqli_query($conn,$sq2);                                //执行查询
    $numbe=mysqli_fetch_row($sum2);
    list($n)=$numbe;                                               //获取行数
   
    $tel = [];               /* 收货人的电话 */
    $rePeo=[];               /* 收货人 */
    for($i=0;$i<$n;$i++)
    {
        $row=mysqli_fetch_row($result);                       //获取一行
        list($numb,$user_id,$received_people,$received_tel,$received_addr,$postcode,$det)=$row; 
        $rePeo[$i]=$received_people;
        $address[$i]=$received_addr;
        $tel[]=$received_tel;
        
    }
    //echo "<script>  console.log('$rePeo[1]');  </script>";
?>

<!----------------------------------- 头部模块  ------------------------------------------>
    <div id='frame'>
        <div id='top'>
            <div id='headline'>数码暴龙旗舰店</div>
            <div id='topTable'>
                <table>
                    <tr>
                        <td id='cycle'>1<br>拍下商品</td><td>2<br>付款</td><td>3<br>确认收货</td><td>4<br>评价</td>
                    </tr>
                </table>
            </div>
        </div>
<!----------------------------------- 头部模块  ------------------------------------------>


<!----------------------------------- 收货地址模块  ------------------------------------------>
        <div id='selectAdd'><b>选择收货地址</b></div>
        <div id='address'>
            <form method='post'>

                <?php  
                    for($i=0;$i<$n;$i++){
                        echo "
                        <div class='perAddress' id='address".($i+1)."'>
                            <h3 id='xm".($i+1)."'>$rePeo[$i]</h3> 
                            <h4 id='dz".($i+1)."'>$address[$i]</h4>
                            <h4 id='dh".($i+1)."'>$tel[$i]</h4>
                            <div class='raFrame'>
                                <input  type='radio' name='addressChoose' value='".$rePeo[$i].$address[$i].$tel[$i]."' 
                                    style='text-align:right;' id='r".($i+1)."'>
                            </div>
                        </div>";
                    }
                ?>
            </form>    
                <div id='addAdmin'>
                     <input type='submit' name='newAddress' value='使用新地址' id='newAddress'>
                     <input type='submit' name='manAddress' value='管理地址' id='manAddress'>
                </div>
            
        </div>
<!----------------------------------- 收货地址模块  ------------------------------------------>



<!----------------------------------- 所有商品模块  ------------------------------------------>
        <div id='comfirm'><b>确认订单信息</b></div>           
        <table id='goodsTable'>

        <?php 
            include 'fun.php';

            $OrderSql="select * from goods_info where goods_id=$goods_id";    
            $Order_result=mysqli_query($conn,$OrderSql);     //根据一个商品id查询它的信息
            $row=mysqli_fetch_row($Order_result);  //获取一行
            //将表中的一行赋予各变量
            list($numb,$goodsid,$catid,$catname,$goodsname,$goodsprice,$goodsnumber,$dat)=$row;
            $money=$goodsprice*$goods_number;       /* 商品总值 */
            $samllMoney=$goodsprice*$goods_number;   /* 商品小计 */

            echo "<script>console.log('$goods_number', $samllMoney);</script>";
            if($isCart!=0)    //表示从购物车来
            {   
                // $OrderSql="select * from goods_info where goods_id=$goods_id";    
                // $Order_result=mysqli_query($conn,$OrderSql);     //根据一个商品id查询它的信息

                echo " <tr><td>店铺宝贝</td>
                        <td>商品属性</td>
                        <td>单价</td>
                        <td>数量</td>
                        <td>小计</td></tr>";
                        
                echo "
                <tr>
                    <td>$goodsname</td>
                    <td>套餐类型：官方标配|购买方式：标配|优惠活动：积分返现</td>
                    <td>$goodsprice</td>
                    <td id='co'>$goods_number</td>
                    <td>$money</td>
                </tr>"; 
                
            }
            /*从主页来-------- */
            else{                   
                echo " <tr><td>店铺宝贝</td>
                        <td>商品属性</td>
                        <td>单价</td>
                        <td>数量</td>
                        <td>小计</td></tr>
                        <tr>
                            <td>$goodsname</td>
                            <td>套餐类型：官方标配|购买方式：标配|优惠活动：积分返现</td>
                            <td>$goodsprice</td>
                            <td><input type='number' min='1' max='10' name='sl'
                                value='$goods_number' onchange='moneyChange()' id='co'></td>
                            <td id='moneys'>$money</td> 
                        </tr>";       
            }
        ?>
        </table>
 <!----------------------------------- 所有商品模块  ------------------------------------------>


 <!----------------------------------- 底部付款框  ------------------------------------------>
        <div id='sumMoney'>   
            <div id='sumAdd' style='color:#000;text-align:right;'>
                <div id='downName'><?php  echo $rePeo[0] ;?></div>
                <div id='downAdd'><?php  echo $address[0] ;?></div>
                <div id='downTel'><?php  echo $tel[0] ;?></div>
                
            </div>
            <div><h3 id='trueMoneys'>实付款：￥<?php echo "$money";?></h3></div>
            <div>
                <div id='subBut'>
                    <input type='submit' name='payment' value='提交订单' id='okBut' onclick='sub()'>
                </div>
                <div id='goindex' onclick="return1()">
                    <input type='submit' name='goindex' value='返回' >
                </div>
            </div>
        </div>
 <!------------- --------------------------底部付款框  -------------------------------------->

    </div>
</body>
<?php
    // isCart为0，表示从主页来
    echo "<script> var goodsid=$goods_id;</script>";
    echo "<script> var come=$isCart;</script>";
     
?>



<script src="./js/jquery.min.js"></script>
<script>

         $("#r1").attr("checked","checked");                            //默认第一个选中
         $("#address1").css("border","3px #00f solid");                 //默认第一个边框
       
         $('input:radio[name="addressChoose"]').change(function () {
             for(i=1;i<5;i++){
                
                 var str='#address'+i;                     // 所有地址框
                 $(str).css("border","3px #000 dashed");  //默认黑色虚线

                 var str1='#r'+i;
                 if($(str1).is(":checked"))
                 {
                     $(str).css("border","3px #00f solid");  // 蓝色实线
                
                    //$('input:radio:checked').val()
                    //var add=$(str1).val();
                    
                    //$('#sumAdd').text(add);
                    var xm='#xm'+i;  
                    var Na=$(xm).text();
                    $('#downName').text(Na);

                    var dz='#dz'+i;
                    var add=$(dz).text();
                    $('#downAdd').text(add);
                    
                    var te='#dh'+i;
                    var tel=$(te).text();
                    $('#downTel').text(tel);
                }
            }
        })

document.getElementById('newAddress').onclick=function(){  //点击新增地址时，跳到个人中心
    window.location.href="shipping_address.php";
}
document.getElementById('manAddress').onclick=function(){   //点击管理地址时，跳到个人中心
    window.location.href="shipping_address.php";
}

function sub()   // 点击 提交订单 时运行
{
    var judgeAdd=$('#downAdd').text();    
    var co=document.getElementById('co').value;                //获取商品数量
    var reName=document.getElementById('downName').innerHTML;  //获取收货人
    var reAdd=document.getElementById('downAdd').innerHTML;    //获取收货地址
    var reTel=document.getElementById('downTel').innerHTML;    //获取收货电话
    var money=document.getElementById('trueMoneys').innerHTML  //获取实付款

    if(judgeAdd=='')
        alert('请选择地址！');

    else if(come==0) // come：0从表示从主页来 ,要传： 商品id,商品数量，收货人，收货地址，收货电话，总金额
    { 
        $.ajax
        ({
            saync:false,
            type:'get',
            url:'submitOrder.php',
            data:{goo:goodsid,count:co,Name:reName,add:reAdd,Tel:reTel,moneys:money},
            dataType:'text',
            success:function(data)
            {
                // console.log(data,'data');
                window.location.href='pay.php?order_id='+data;//将已经入订单的订单号传给pay
            }
        });
    }
    else if(come!=0)   // 从购物车来
    {  
        var co=document.getElementById('co').innerHTML;   //获取商品数量,因为数量框不是number按钮，所以获取方式不同
        var isCart = 1;
        $.ajax
        ({
            saync:false,
            type:'get',
            url:'submitOrder.php',
            data:{goo:goodsid,count:co,Name:reName,add:reAdd,Tel:reTel,moneys:money,isCart:1},
            dataType:'text',
            success:function(data)
            {
                // console.log(data);
                window.location.href='pay.php?order_id='+data;  //将已经入订单的订单号传给pay
            }
        });  
    }
   
}
    
function return1(){   // 按 返回按钮 触发-------------------------------------------------------------
    window.history.go(-1);
}

function moneyChange(){                                 // 商品数量改变时，改变小计和结算金额
    var mon=document.getElementById('co').value;
    
    if(mon>=10){                                        //防止输入超过10件商品
        document.getElementById('co').value=10;
        alert('此商品限购10件');
    }
    if(mon<=1){                                         //防止输入低于1件商品
        document.getElementById('co').value=1;
    }   
    if(mon-parseInt(mon)>0 || mon-parseInt(mon)<0){     //防止输入小数件商品
        document.getElementById('co').value=parseInt(mon);  
    }

    var mon2=parseInt(mon);   //将他输入的商品数量，转为整型
    document.getElementById('moneys').innerHTML=mon2*<?php  echo $money ;?>;     // 改变小计金额
    document.getElementById('trueMoneys').innerHTML=mon2*<?php  echo $money ;?>; // 改变订单总金额
}


</script>
</html> 
