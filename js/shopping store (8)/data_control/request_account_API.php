
<?php

$season = @$_GET['season'];
$month = @$_GET['month'];
$week = @$_GET['week'];
$day = @$_GET['day'];
$day_now = @$_GET['day_now'];

    function get_data($start_date,$end_date){
      require "fun.php";
      $arr = array();  // 定义一个数组，0，1，2，3，4，5，6，7分别代表销售额，已成交笔数......单笔最低

      // 获得销售额
      $sql1 = "select total_price from order_info where date BETWEEN '$start_date' and DATE_ADD('$end_date',INTERVAL 1 DAY)";
      $result1 = mysqli_query($conn,$sql1);
        $count = 0;
        while($rows = mysqli_fetch_array($result1)){
          $count = $count + $rows[0];
        }
        array_push($arr,$count);

      // 获得已成交的订单数量
      $sql1 = "select COUNT(order_id) from order_info where date BETWEEN '$start_date' and DATE_ADD('$end_date',INTERVAL 1 DAY) AND (order_status = '历史订单' or order_status = '已收货待评价' or order_status = '已付款待发货' or order_status = '已发货待收货')";
      $result1 = mysqli_query($conn,$sql1);
        $a = mysqli_fetch_array($result1);
        array_push($arr,$a[0]);
      
      // 获得已收货的订单数量
      $sql1 = "select COUNT(order_id) from order_info where date BETWEEN '$start_date' and DATE_ADD('$end_date',INTERVAL 1 DAY) AND order_status = '已收货'";
      $result1 = mysqli_query($conn,$sql1);
        $a = mysqli_fetch_array($result1);
        array_push($arr,$a[0]);

      // 获得已付款的订单数量
      $sql1 = "select COUNT(order_id) from order_info where date BETWEEN '$start_date' and DATE_ADD('$end_date',INTERVAL 1 DAY) AND order_status = '已付款'";
      $result1 = mysqli_query($conn,$sql1);
        $a = mysqli_fetch_array($result1);
        array_push($arr,$a[0]);
      
      // 获得未付款的订单数量
      $sql1 = "select COUNT(order_id) from order_info where date BETWEEN '$start_date' and DATE_ADD('$end_date',INTERVAL 1 DAY) AND order_status = '未付款'";
      $result1 = mysqli_query($conn,$sql1);
        $a = mysqli_fetch_array($result1);
        array_push($arr,$a[0]);
      
      // 获得最大值
      $sql1="select MAX(total_price) from order_info where date BETWEEN '$start_date' and DATE_ADD('$end_date',INTERVAL 1 DAY)";
      $result1 = mysqli_query($conn,$sql1);
        $a = mysqli_fetch_array($result1);
        array_push($arr,$a[0]);
      
      // 获得最小值
      $sql1="select MIN(total_price) from order_info where date BETWEEN '$start_date' and DATE_ADD('$end_date',INTERVAL 1 DAY)";
      $result1 = mysqli_query($conn,$sql1);
        $a = mysqli_fetch_array($result1);
        array_push($arr,$a[0]);

      return $arr;
    };
    $array = array();  //定义一个新数组

    $result = get_data($season,$day_now);
    array_push($array,$result);

    $result = get_data($month,$day_now);
    array_push($array,$result);

    $result = get_data($week,$day_now);
    array_push($array,$result);

    $result = get_data($day,$day_now);
    array_push($array,$result);

    if(!empty($_GET['start_date'])){
      $start_date = @$_GET['start_date'];
      $end_date = @$_GET['end_date'];
      $result = get_data($start_date,$end_date);
      array_push($array,$result);
    }
    
    header('Content-Type:application/json');
    $row2 = json_encode($array, JSON_UNESCAPED_UNICODE);   //打包成json格式
    echo $row2 ;  //输出数据
  ?>
