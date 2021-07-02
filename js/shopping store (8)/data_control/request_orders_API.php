<?php
//这是请求分类商品信息并分页的php

require "fun.php";  //连接数据库

$limit = @$_POST['limit'];       //一页显示多少行
$page = @$_POST['page'];         //第几页
$mutiple = $limit*($page-1);      //计算出页的起始行

//获得全部数据的行数，若有分类，则赋值给下面的count
if(!empty($_POST['cat_id'])){
    $where = @$_POST['cat_id']; 
    $sql = "select * from order_info where cat_id = $where";
}
else
{
    $sql = "select * from order_info";
}
$result = mysqli_query($conn,$sql);
$count = mysqli_num_rows($result);

$msg = '';

    if(!empty($_POST['cat_id'])){
        $where = @$_POST['cat_id'];      //获得搜索框传输过来的值
        $sql = "select * from order_info where cat_id = $where limit $mutiple,$limit";
    }
    else{
        $start_date = '1999-12-13';
        $end_date = '2999-12-13';

        //根据选择的日期不同，选择不同的输出方式
        if((!empty($_POST['end_date'])) and (!empty($_POST['start_date']))){

        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $msg = '时间区间为：'.$start_date.'至'.$end_date;
        }
        else if (!empty($_POST['end_date'])){

        $end_date = $_POST['end_date'];
        $msg = '时间区间为：时空的开端至'.$end_date;
        }
        else if (!empty($_POST['start_date'])){

        $start_date = $_POST['start_date'];
        $msg = '时间区间为：'.$start_date.'至时间的尽头';
        }
        else{
            $msg = "你都没选时间啊...那就都翻出来给你看看";
        }
        
        $sql = "select * from order_info where date BETWEEN '$start_date' and DATE_ADD('$end_date',INTERVAL 1 DAY) limit $mutiple,$limit";
    }
  //执行SQL语句
$result = mysqli_query($conn,$sql);
$array = array();
while($rows = mysqli_fetch_assoc($result)){  
    $array[] = $rows;
}

$arr = array('code'=>0,"msg"=>$msg,"count"=>$count,'data'=>$array);  //layui规定的数据格式 code=0，成功。为1，失败。msg为错误信息。count为信息总数。date为数据。
$row2 = json_encode($arr, JSON_UNESCAPED_UNICODE);  //打包成json格式
header('Content-Type:application/json');

echo $row2; //输出数据
?>