<?php
    session_start();
    if(!isset($_SESSION["user_admin"]))
    {
        echo "<script>alert('请先登陆');</script>";
        header("location:login.php");
    }
?>