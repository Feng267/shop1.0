<?php
//这是请求所有商品信息并分页的php

require "../fun.php";  //连接数据库
$user_id = @$_POST['user_id'];
if(!$user_id)
    $user_id = '12345678901';

//获得全部数据的行数，赋值给下面的count
$sql1 = "select * from order_info where user_id = $user_id order by date desc";	//获得该用户的订单所有订单信息
// echo $sql1;
$result = mysqli_query($conn,$sql1);
$count = mysqli_num_rows($result);

while($rows = mysqli_fetch_assoc($result)){  
    $array[] = $rows;// 将返回的数据汇总起来成数组
}
// '待付款','已付款待发货','已发货待收货','已收货待评价','历史订单'
// $order_operation = ['付款','催发货','确认收货','评价','评价'];
$order_operation = ['待付款'=>'付款','已付款待发货'=>'催发货','已发货待收货'=>'确认收货', '已收货待评价'=>'评价','历史订单'=>'追加评价'];

// for($i = 0; $i < $count; $i++)
// {
//     $order_id = $array[$i]['order_id'];
//     $cat_name = $array[$i]['cat_name'];
//     $goods_pic = $array[$i]['goods_pic'];
//     $goods_name = $array[$i]['goods_name'];
//     $goods_attr = $array[$i]['goods_attr'];
//     $goods_prise = $array[$i]['goods_prise'];
//     $goods_number = $array[$i]['goods_number'];
//     $total_price = $array[$i]['total_price'];
//     $order_status = $array[$i]['order_status'];
//     $order_operation_txt = $order_operation[$order_status];
//     // 商品信息的HTML代码
//     $goods_detail_info_array[] = "
//     <div class='detail_wrap'>
//         <div class='detail_head'>
//             <ul class='detail_head_ul'>
//                 <li class='detail_head_first_li'>
//                     <label class='' >
//                         <input type='checkbox'>
//                         <span class='order_time_txt'>2020-11-26 11:50:35</span>
//                         <span>订单号：</span>
//                         <span class='order_id_txt'>$order_id</span>
//                     </label>
//                 </li>
//                 <li>$cat_name</li>
//                 <li>和我联系</li>
//                 <li>删除</li>
//             </ul>
//         </div>
//         <div class='detail_body'>
//             <ul class='detail_body_ul'>
//                 <li>
//                     <div class='order_goods_detail'>
                        // <div class='goods_pic_wrap'><img src='$goods_pic' class='goods_pic'></div>
//                         <div class='goods_content_wrap'>
//                             <div>
//                                 <span class='goods_name_txt'>$goods_name</span>
//                                 <span class='goods_attr_txt'>$goods_attr</span>
//                                 <span class='goods_serv_wrap'>
//                                     <img src='image/authentic-16-16.png' alt=''>
//                                     <img src='image/real-16-16.png' alt=''>
//                                     <img src='image/seven-16-16.png' alt=''>
//                                 </span>

//                             </div>
//                         </div>
//                     </div>
//                 </li>
//                 <li>
//                     <div class='goods_simple_price_wrap'>
//                         <span>￥</span>
//                         <span class='goods_simple_price_txt'>$goods_prise</span>
//                     </div>
//                 </li>
//                 <li>
//                     <span class='goods_number_txt'>$goods_number</span>
//                 </li>
//                 <li class='goods_operation_wrap'>
//                     <span>违规举报</span>
//                     <span>退运保险</span>
//                 </li>
//                 <li class='order_total_price_wrap'>
//                     <span>￥</span>
//                     <span  class='order_total_price_txt'>$total_price</span>
//                 </li>
//                 <li class='order_status'>
//                     <span>交易成功</span>
//                     <span>订单详情</span>
//                 </li>
//                 <li class='order_operation_wrap'>
//                     <button class='button_mid_smaill'>$order_operation_txt</button>
//                     <span>再次购买</span>
//                 </li>
//             </ul>
//         </div>
//     </div>
//     ";
// }

// echo $goods_detail_info_array;
$arr = array('code'=>0,"msg"=>"","count"=>$count,'data'=>$array);       //layui规定的数据格式 code=0，成功。为1，失败。msg为错误信息。count为信息总数。date为数据。
$row2 = json_encode($arr, JSON_UNESCAPED_UNICODE);   //打包成json格式
header('Content-Type:application/json');

echo $row2;  //输出数据

// 借鉴的：
//这是请求所有商品信息并分页的php

// require "fun.php";  //连接数据库

// $limit = $_POST["limit"];      //一页显示多少行
// $page = $_POST["page"];         //第几页
// $mutiple = $limit*($page-1);      //计算出页的起始行
// $where = @$_POST['cat_id'];        //获取默认显示的分类

// //获得全部数据的行数，赋值给下面的count
// $sql1 = "select * from goods_info where cat_id = $where";	//获得goods_info的所有数据
// $result = mysqli_query($conn,$sql1);
// $count = mysqli_num_rows($result);

// //一次从$mutiple行开始，选择$limit行数据
// $sql2 = "select * from goods_info where cat_id = $where limit $mutiple,$limit";
// $array = array();
// $result = mysqli_query($conn,$sql2);
// while($rows = mysqli_fetch_assoc($result)){  
//     $array[] = $rows;
// }

// $arr = array('code'=>0,"msg"=>"","count"=>$count,'data'=>$array);       //layui规定的数据格式 code=0，成功。为1，失败。msg为错误信息。count为信息总数。date为数据。
// $row2 = json_encode($arr, JSON_UNESCAPED_UNICODE);   //打包成json格式
// header('Content-Type:application/json');

// echo $row2;  //输出数据
?>
