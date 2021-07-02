<?php
    error_reporting(0);  // 抑制错误函数

    session_start();
    $acc=@$_SESSION['acc'];

    // 判断是否登录
    if(!$acc)
    {
        $_SESSION['next_url'] = $_SERVER['REQUEST_URI'];// 记住当前页面的URL
        header("Location: login.php");
    }
?>