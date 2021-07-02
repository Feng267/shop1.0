<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>数码暴龙旗舰店</title>
    
    <link type="text/css" rel="stylesheet"  href='all_style.css'>   <!-- 大部分css -->
    <link rel="stylesheet" href="./css/layui.css">   <!-- 引用的框架的css -->
    <script src="./js/layui.all.js"></script>    <!-- 引用的框架  -->
    <style>
        #search_wrap{
            width: 590px;
            height: 40px;
            line-height: 40px;
            margin: 5px auto;
        }
        #search_wrap input{
            
            /* height: 40px; */
            width: 525px;
            font-size: 14px;
            /* color: white; */
            line-height: 25px;
            border: 2px solid white;
        }

        /* 全选和翻页按钮的样式 */
        .rows_select{
            height: 35px;
            width: 1200px;
            margin: 0 auto -18px;
            /* padding: 0 15px; */
            /* border: 1px solid #ccc; */
            line-height: 35px;
            /* padding-bottom: 10px; */
            /* clear: both; */
        }
        .select_left{
            float: left;
            padding-left: 20px;
        }
        .select_left label{
            display: inline-block;
        }
        .select_left div{
            display: inline-block;
        }
        .button_mid_smaill{
            background-color: white;
            border: 1px solid #dcdcdc;
            color: #3c3c3c;
            margin-left: 5px;
            box-sizing: border-box;
            display: inline-block;
            padding: 0 12px;
            line-height: 22px;
            border-radius: 3px;
            font-size: 13px;
            cursor: pointer;
            text-decoration: none;
        }
        .button_mid_smaill a{
            list-style: none;
            color: #3c3c3c;
        }
        .select_right{
            float: right;
            margin-right: 20px;
        }
    </style>
    <?php
        session_start();
        require "fun.php";
        $search = @$_GET['search'];
        $limit = 16;// 一页16行
        $pages = @$_GET['pages'];// 第几页    
        if(!isset($pages)  || $pages == 0){
            $pages = 1;
        }           
        $prev_page = $pages-1;// 上一页
        if($prev_page == 0)
            $prev_page = 1;
        $next_page = $pages+1;// 下一页
        $mutiple = $limit*($pages-1);      //计算出页的起始行

        // 获取总行数
        $sqls = "select * from goods_info where goods_big_logo <> '' and goods_price > 0 and goods_name like '%$search%'";        
        $results=mysqli_query($conn,$sqls);              //执行查询
        $row_total = mysqli_num_rows($results);// 返回商品的数量

        // 已经最后一页了
        if($mutiple > $row_total){
            $mutiple = floor($row_total / $limit) * $limit;// 定位回最后一页
            echo "<script>layer.msg('没有下一页啦！', { icon: 7, time: 1500, shade: [0.6, '#000', true] })</script>";
        }
            
    ?>
</head>


<body>
    <?php include 'head.php';?>           <!-- 页眉导航 -->
    <!-- 搜索框 -->
    <div id="search_wrap">
        <form action="search.php" method="get">
            <input name="search" type="text" placeholder="请输入搜索内容">
            <button type="submit" class="layui-btn layui-btn-sm">search</button>
        </form>
    </div>

    <!-- 全选和上下翻页 -->
    <div class="rows_select">
        <div class="select_left">
            <label >
                <!-- <input type="checkbox"> -->
                <!-- <span>全选</span> -->
            </label>
            <div>
                <!-- <button class="button_mid_smaill">批量确认收货</button> -->
            </div>
        </div>
        <div class="select_right">
            <!-- <form action=""> -->
                <?php
                    echo "<button id='prev_page' class='button_mid_smaill' name='prev_page'><a href='search.php?search=$search&pages=$prev_page'>上一页</a></button>";
                    echo "<button id='prev_page' class='button_mid_smaill' name='prev_page'><a href='search.php?search=$search&pages=$next_page'>下一页</a></button>";
                ?>
        </div>
    </div>
    <?php include 'search_goods.php';?>    <!-- 搜索商品主体 -->
    <?php include 'foot.php';?>           <!-- 页脚 -->
    <?php include 'rayState.php';?>       <!-- 法律声明 -->
    <?php include 'side_nav.php';?>       <!-- 右边悬浮栏 -->
    <?php include 'goTop.php';?>          <!-- 返回顶部按钮 -->
    <?php include 'allPhpfun.php';?>      <!-- php  -->
</body>


<script src="./js/layui.all.js"></script>    <!-- 引用的框架  -->
<script src='./js/jquery.min.js'></script>        <!-- jq  -->
<script src='./js/all_JavaScript.js'></script>    <!-- 主页部分js  -->

</html>
