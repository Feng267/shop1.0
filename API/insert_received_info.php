<?php
    if(isset($_POST["address"])) {
        $addr = @$_POST["address"];    //收货地址
        $consignee = @$_POST["person"];    //收货人
        $tel = @$_POST["tel"];   //电话
        $post = @$_POST["post"];   //邮政编码

        //更新数据库信息
        session_start();
        include "fun.php";
        $x = $_SESSION['acc'];
        $sql = "INSERT INTO `received_info`(`user_id`, `received_people`, `received_tel`, `received_addr`, `postcode`) VALUES ($x,'$consignee',$tel,'$addr',$post)";
        mysqli_query($conn,$sql) or die('数据更新失败:'.mysqli_error($conn));
        echo '200';
    }
?>
