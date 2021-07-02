<?php
    session_start();
    include "fun.php";
    $x = $_SESSION['acc'];
    $numb = $_POST['goodsId'];
    $sql = "DELETE FROM `shop_cart_info` WHERE `numb`=$numb && `user_id`='$x'";
    $result = mysqli_query($conn,$sql) or die('数据插入失败:'.mysqli_error($conn));
    //echo "<pre>";
    echo '200';
?>
