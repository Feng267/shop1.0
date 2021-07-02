<?php
    session_start();
    $conn = mysqli_connect('localhost','root', 'root_com') or die('连接失败');
    mysqli_select_db($conn,"store") or die('选择数据库失败');
    mysqli_query($conn,"SET NAMES utf-8");
    $x = $_SESSION['acc'];
    $sql = "SELECT * FROM `shop_cart_info` WHERE `user_id`=$x order by numb desc";
    $result = mysqli_query($conn,$sql) or die('数据插入失败:'.mysqli_error($conn));
    $rows = array();
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    $json =  [
        'success' => 0,
        'data'=>$rows
    ];
    $result1 = json_encode($json,JSON_PRETTY_PRINT);
    //echo "<pre>";
    echo $result1;
?>
