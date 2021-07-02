<?php
    if (isset($_POST["number"]))
    {
        $number = @$_POST["number"];
        $addr1 = @$_POST["address"];    //收货地址
        $consignee1 = @$_POST["person"];    //收货人
        $tel1 = @$_POST["tel"];   //电话
        $post1 = @$_POST["post"];   //邮政编码

        //更新数据库信息
        session_start();
        include "fun.php";
        $x1 = $_SESSION['acc'];
        $sql1 = "UPDATE `received_info` SET `received_people`='$consignee1',`received_tel`=$tel1,`received_addr`='$addr1',`postcode`=$post1 WHERE `numb`=$number";
        mysqli_query($conn,$sql1) or die('数据更新失败:'.mysqli_error($conn));
        echo '200';
    }
?>
