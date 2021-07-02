<?php
    session_start();
    $acc = $_SESSION['acc'];
    // 未登录不允许请求支付
    if(isset($acc)){
        $co=@$_GET['count'];      // 商品数量，从主页来没有数量
        $trueMoney=@$_GET['moneys'];  // 实付款
        $isCart = @$_GET['isCart'];// 判断是否从购物车来

        //购物车来 只有以下 4个
        $godid=@$_GET['goo'];    //商品id
        $Name=@$_GET['Name'];  // 收货人    
        $Tel=@$_GET['Tel'];    // 收货电话
        $add=@$_GET['add'];    // 收货地址
        
        date_default_timezone_set('PRC');           //设置北京时间

        $orderid=date("YmdHis").rand(0001,9999);    //设置 订单号

        $dates=date("Y-m-d H:i:s");                 // 设置订单日期
        
        include 'fun.php';          //连接数据库
        
        $goodsSql="select * from goods_info where goods_id=".$godid; //根据商品id查它信息
        $goodsResult=mysqli_query($conn,$goodsSql);//查询商品
        $getGoodsInfo=mysqli_fetch_row($goodsResult); //获取一行
        list($numb,$goodsid,$catid,$catname,$goodsname,$goodsprice,$goodsnumber,$goods_big_pic, $goods_small_pic,$da)=$getGoodsInfo;
        
        $money=$co*$goodsprice; // 订单总价
        $sql="insert into order_info values(null,'$orderid','$acc',".$godid.",'$catid','$catname','$goods_small_pic','$goodsname','套餐类型:官方标配|购买方式:标配|优惠活动:积分返现',$goodsprice,$co,$money,'$add','$Tel','$Name','待付款','$dates')";
        $result=mysqli_query($conn,$sql);

        // // 从购物车来的，生成订单后要把购物车的记录删除
        if(isset($isCart)){
            $sql = "delete from shop_cart_info where user_id = '$acc' and goods_id = $godid";    
            $result=mysqli_query($conn,$sql);
        }
        
        echo $orderid;
    }
    else
        echo false;
    
     
?>