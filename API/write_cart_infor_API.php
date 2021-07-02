<?php    
    session_start();
    require "../fun.php";
    $acc = @$_SESSION['acc'];
    if(isset($acc)){
        $goods_id = @$_GET['goods_id'];
        $goods_number = @$_GET['goods_number'];
        if(!isset($goods_number))
            $goods_number = 1;

        $sql = "select * from user where name = $acc";
        // 获取商品信息
        $sql = "select cat_id, cat_name, goods_name, goods_price, goods_small_logo from goods_info where goods_id = $goods_id";
        $result = mysqli_query($conn, $sql);
        $goods_info = mysqli_fetch_row($result);
        // var_dump($goods_info);
  
        // 要插入的各字段数据
        list($cat_id, $cat_name, $goods_name, $goods_price, $goods_small_logo) = $goods_info;// 解析商品各字段
        $total_price = $goods_price * $goods_number;// 购物车记录总价格
        // $date = date('Y-m-d H:i:s');// 中间的空格和直接敲的空格有区别，会报错
        $date = date('Y-m-d H:i:s');

        $sql = "select * from shop_cart_info where user_id = $acc and goods_id = $goods_id";
        $result = mysqli_query($conn, $sql);
        // 若已有该商品，则更新该商品的数量和价格
        if(mysqli_affected_rows($conn)){
            $rows = mysqli_fetch_assoc($result);
            $goods_num = $rows['goods_number'] + $goods_number;// 商品数量
            $numb = $rows['numb'];// 在表中的序号
            $total_price = $goods_price * $goods_num;
            // echo $goods_num, $numb;
            // echo $goods_num;
            $sql = "update shop_cart_info set goods_number = $goods_num, total_price = $total_price where numb = $numb";
            // echo $sql;
            $result = mysqli_query($conn, $sql);
            if(mysqli_affected_rows($conn)==1)
                echo 1;// 加入购物车成功
            else
                echo 2;// 加入失败
        }else{// 否则插入一条新记录
            $sql = "insert into shop_cart_info values(null, $acc, $goods_id, $cat_id, '$cat_name', '$goods_small_logo', '$goods_name', '套餐类型：官方标配|购买方式：标配|优惠活动：积分返现', $goods_price, $goods_number, $total_price, '$date')";
            $result = mysqli_query($conn, $sql);
            //echo mysqli_affected_rows($conn);
            // echo mysqli_error($conn);
            // ?o mysqli_num_rows($result);
            if(mysqli_affected_rows($conn)==1)
                echo 1;// 加入购物车成功
            else
                echo 2;// 加入失败
        }

        // 加入购物车的sql语句
        
    }
    else
        echo 3;// 未登录
    
    
    // echo '提交成功' . $goods_id;
?>