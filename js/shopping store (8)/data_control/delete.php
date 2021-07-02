<?php
//这是删除商品的php

require "fun.php";  //连接数据库


if(isset($_GET['order_id'])){ 
    $order_id = $_GET["order_id"]; 
    $sql2 = "DELETE FROM order_info WHERE order_id = $order_id";
 }
else if(isset($_GET['goods_id'])){
    $goods_id = $_GET["goods_id"]; 
    $sql2 = "DELETE FROM goods_info WHERE goods_id = $goods_id";
}
//删除数据
$result = mysqli_query($conn,$sql2)or die("错误描述: " . mysqli_error($conn));
if($result){
    echo "200";
}
?>