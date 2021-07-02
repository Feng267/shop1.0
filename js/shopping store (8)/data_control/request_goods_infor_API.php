<?php
//这是请求所有商品信息并分页的php

require "fun.php";  //连接数据库

$limit = $_POST["limit"];      //一页显示多少行
$page = $_POST["page"];         //第几页
$mutiple = $limit*($page-1);      //计算出页的起始行
$where = @$_POST['cat_id'];        //获取默认显示的分类

//获得全部数据的行数，赋值给下面的count
$sql1 = "select * from goods_info where cat_id = $where";	//获得goods_info的所有数据
$result = mysqli_query($conn,$sql1);
$count = mysqli_num_rows($result);

//一次从$mutiple行开始，选择$limit行数据
$sql2 = "select * from goods_info where cat_id = $where limit $mutiple,$limit";
$array = array();
$result = mysqli_query($conn,$sql2);
while($rows = mysqli_fetch_assoc($result)){  
    $array[] = $rows;
}

$arr = array('code'=>0,"msg"=>"","count"=>$count,'data'=>$array);       //layui规定的数据格式 code=0，成功。为1，失败。msg为错误信息。count为信息总数。date为数据。
$row2 = json_encode($arr, JSON_UNESCAPED_UNICODE);   //打包成json格式
header('Content-Type:application/json');

echo $row2;  //输出数据
?>