<?php
    //这是配合order_management.php实时更新数据库的php
    
    require "fun.php";

    $order_id = @$_GET["order_id"];    //得到ID
    $goods_field = @$_GET["goods_field"];    //得到列名
    $good_value = @$_GET["good_value"];   //得到修改后的值

    //更新数据库里goods_info的内容
    $sql = "UPDATE order_info SET $goods_field='$good_value' WHERE order_id='$order_id'";
    $result = mysqli_query($conn,$sql)or die("错误描述: " . mysqli_error($conn)); 
    if($result){
        echo "200";
    }
    else{
        echo "updata数据库失败";
    }
    
?>