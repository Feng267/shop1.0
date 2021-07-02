<?php
    session_start();
    include "fun.php";// 连接数据库
    $acc = $_SESSION['acc'];
    $order_id = @$_POST['order_id'];
    // echo 1;
    if(isset($acc)){   
        $sql = "update order_info set order_status='已收货待评价' where order_id='$order_id'";     
    //     $new_ps = $_POST["password"];
    //     $sql = "UPDATE `user` SET `password`=$new_ps WHERE `name`=$x";
        mysqli_query($conn,$sql) or die('数据更新失败:'.mysqli_error($conn));
        // echo mysqli_error($conn), $sql;
        if(mysqli_affected_rows($conn) == 1)
            echo 1;
        else
            echo 0;
    }
?>
