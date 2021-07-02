<?php
    session_start();
    include "fun.php";
    $x = $_SESSION['acc'];
    $numb = $_POST['goodsId'];
    $amount = $_POST['goodsNumber'];
    $total_price = $_POST['total_price1'];
    $sql = "UPDATE `shop_cart_info` SET `goods_number`=$amount,`total_price`=$total_price WHERE `numb`=$numb&&`user_id`=$x";
    $result = mysqli_query($conn,$sql) or die('数据插入失败:'.mysqli_error($conn));
    //echo "<pre>";
    echo '200';
?>
