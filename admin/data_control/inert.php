<?php
    $cat_id = @$_POST["cat_id"];    //类ID
    $goods_name = @$_POST["goods_name"];     //商品名
    $goods_price = @$_POST["goods_price"];   //单价
    $goods_number = @$_POST["goods_number"];   //数量
    echo $cat_id.$goods_name.$goods_price .$goods_number;
?>