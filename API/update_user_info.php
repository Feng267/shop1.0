<?php
    session_start();
    include "fun.php";
    $x = $_SESSION['acc'];
    $new_ps = $_POST["password"];
    $sql = "UPDATE `user` SET `password`=$new_ps WHERE `name`=$x";
    mysqli_query($conn,$sql) or die('数据更新失败:'.mysqli_error($conn));
    echo '200';
    unset($_SESSION['acc']);     // 销毁 account
?>
