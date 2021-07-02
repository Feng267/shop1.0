<!DOCTYPE html>
<?php
    include 'isLogin.php';
    if(isset($acc))
        echo "<script>let user_id = $acc</script>";   
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="all_style.css">  <!-- 标题栏和底部的样式 -->
    <link rel="stylesheet" href="css/order_info.css">  <!-- 本页面的样式 -->
    <link rel="stylesheet" href="./css/layui.css">  <!-- 引用的框架的样式 -->
    
    <title>订单管理</title>
</head>
<body>
    <?php include 'head.php'; ?>         <!-- 页眉导航 -->
    <div id="order_content_body">
		<ul id="c_list">
			<li class="bg_c"><a>所有订单</a></li>
			<li class=""><a>待付款</a></li>
			<li class=""><a>待发货</a></li>
			<li class=""><a>待收货</a></li>
			<li class=""><a>待评价</a></li>
        </ul>
        
        <!-- 各tab栏的具体内容 -->
		<div id="c_con">

			<!-- 所有订单的内容 -->
			<div class="order_tab " id="order_content_all">
                <!-- 订单搜索框 -->
                <div class="order_search">
                    <!-- <form action=""> -->
                        <!-- 默认的简易搜索 -->
                        <div class="simple_search">
                            <input type="text" placeholder="输入商品标题或订单号进行搜索">
                            <button type="button" class="simple_button button_mid_smaill" onclick="layerMsg()">订单搜索</button>
                            <button type="button" class="more_button button_mid_smaill" onclick="layerMsg()">更多筛选条件</button>
                        </div>

                        <!-- 多条件筛选搜索：目前还未实现 -->
                        <!-- <div class="more_part_search"></div> -->
                    <!-- </form> -->
                </div>
                
                <!-- 订单信息表头 -->
                <div class="order_title">
                    <table class="table_head_mod table_bought_mod">
                        <tbody>
                            <tr class="table_title">
                                <th class="title_first">商品</th>
                                <th>单价</th>
                                <th>数量</th>
                                <th>商品操作</th>
                                <th>实付款</th>
                                <th>交易状态</th>
                                <th>交易操作</th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 全选和上下翻页 -->
                <div class="rows_select">
                    <div class="select_left">
                        <label >
                            <input type="checkbox">
                            <span>全选</span>
                        </label>
                        <div>
                            <button class="button_mid_smaill"  onclick="layerMsg()">批量确认收货</button>
                        </div>
                    </div>
                    <div class="select_right">
                        <button id="prev_page" class="button_mid_smaill" onclick="layerMsg()">上一页</button>
                        <button id="next_page" class="button_mid_smaill" onclick="layerMsg()">下一页</button>
                    </div>
                </div>
                
                <!-- 订单详细信息 -->
                <div id="example_order_detail">
                    <div class="order_detail">
                        <div class="detail_wrap">
                            <div class="detail_head">
                                <ul class="detail_head_ul">
                                    <li class='detail_head_first_li'>
                                        <label class="" >
                                            <input type="checkbox">
                                            <span class="order_time_txt">2020-11-26 11:50:35</span>
                                            <span>订单号：</span>
                                            <span class="order_id_txt">202011251151300001</span>
                                        </label>
                                    </li>
                                    <li class="cat_name_txt">曲面电视</li>
                                    <li  onclick="layerMsg()">和我联系</li>
                                    <li><button  onclick="layerMsg()" class="button_mid_smaill"> 删除</button></li>
                                </ul>
                            </div>
                            <div class="detail_body">
                                <ul class="detail_body_ul">
                                    <li>
                                        <div class="order_goods_detail">
                                            <div class="goods_pic_wrap"><img src="image/0000000000-000000000646151602_1_400x400.jpg" class="goods_pic"></div>
                                            <div class="goods_content_wrap">
                                                <div>
                                                    <span class="goods_name_txt">海信(Hisense)LED55MU9600X3DUC 55英寸 4K超高清量子点电视 ULED画质 VIDAA系统</span>
                                                    <span class="goods_attr_txt">套餐类型：官方标配   购买方式：标配   优惠活动：积分返现</span>
                                                    <span class="goods_serv_wrap">
                                                        <img src="image/authentic-16-16.png" alt="">
                                                        <img src="image/real-16-16.png" alt="">
                                                        <img src="image/seven-16-16.png" alt="">
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="goods_simple_price_wrap">
                                            <span>￥</span>
                                            <span class='goods_simple_price_txt'>13999</span>
                                        </div>
                                    </li>
                                    <li>
                                        <span class="goods_number_txt">3</span>
                                    </li>
                                    <li class="goods_operation_wrap">
                                        <span>违规举报</span>
                                        <span>退运保险</span>
                                    </li>
                                    <li class="order_total_price_wrap">
                                        <span>￥</span>
                                        <span  class="order_total_price_txt">413997</span>
                                    </li>
                                    <li class="order_status">
                                        <span>交易成功</span>
                                        <span>订单详情</span>
                                    </li>
                                    <li class="order_operation_wrap">
                                        <button class="button_mid_smaill "><a class="order_operation_txt">评价</a></button>
                                        <span>推荐分享</span>
                                    </li>
                                </ul>
                            </div>
                        </div>   
                    </div>
				</div>
            </div>
            
            <!-- 待付款的内容 -->
			<div class="order_tab order_initial" id="order_content_1">

                <!-- 订单信息表头 -->
                <div class="order_title">
                    <table class="table_head_mod table_bought_mod">
                        <tbody>
                            <tr class="table_title">
                                <th class="title_first">商品</th>
                                <th>单价</th>
                                <th>数量</th>
                                <th>商品操作</th>
                                <th>实付款</th>
                                <th>交易状态</th>
                                <th>交易操作</th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 全选和上下翻页 -->
                <div class="rows_select">
                    <div class="select_left">
                        <label >
                            <input type="checkbox">
                            <span>全选</span>
                        </label>
                        <div>
                            <button class="button_mid_smaill"  onclick="layerMsg()">批量确认付款</button>
                        </div>
                    </div>
                    <div class="select_right">
                        <button id="prev_page" class="button_mid_smaill">上一页</button>
                        <button id="next_page" class="button_mid_smaill">下一页</button>
                    </div>
                </div>
                
                <!-- 订单详细信息 -->
                <div class="order_detail" data-tt="订单详细信息">
                    
                                     
                </div>
                <!-- 以上为待付款的内容 -->
            </div>

            <!-- 待发货的内容 -->
			<div class="order_tab order_initial" id="order_content_2">
                <!-- 订单信息表头 -->
                <div class="order_title">
                    <table class="table_head_mod table_bought_mod">
                        <tbody>
                            <tr class="table_title">
                                <th class="title_first">商品</th>
                                <th>单价</th>
                                <th>数量</th>
                                <th>商品操作</th>
                                <th>实付款</th>
                                <th>交易状态</th>
                                <th>交易操作</th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 全选和上下翻页 -->
                <div class="rows_select">
                    <div class="select_left">
                        <label >
                            <input type="checkbox">
                            <span>全选</span>
                        </label>
                        <div>
                            <button class="button_mid_smaill"  onclick="layerMsg()">批量催发货</button>
                        </div>
                    </div>
                    <div class="select_right">
                        <button id="prev_page" class="button_mid_smaill">上一页</button>
                        <button id="next_page" class="button_mid_smaill">下一页</button>
                    </div>
                </div>

                <!-- 订单详细信息 -->
                <div class="order_detail">
                </div>
                <!-- 以上为待发货的内容 -->
            </div>

            <!-- 待收货的内容 -->
			<div class="order_tab order_initial" id="order_content_3">

                <!-- 订单信息表头 -->
                <div class="order_title">
                    <table class="table_head_mod table_bought_mod">
                        <tbody>
                            <tr class="table_title">
                                <th class="title_first">商品</th>
                                <th>单价</th>
                                <th>数量</th>
                                <th>商品操作</th>
                                <th>实付款</th>
                                <th>交易状态</th>
                                <th>交易操作</th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 全选和上下翻页 -->
                <div class="rows_select">
                    <div class="select_left">
                        <label >
                            <input type="checkbox">
                            <span>全选</span>
                        </label>
                        <div>
                            <button class="button_mid_smaill"  onclick="layerMsg()">批量确认收货</button>
                        </div>
                    </div>
                    <div class="select_right">
                        <button id="prev_page" class="button_mid_smaill">上一页</button>
                        <button id="next_page" class="button_mid_smaill">下一页</button>
                    </div>
                </div>

                <!-- 订单详细信息 -->
                <div class="order_detail">
                </div>
                <!-- 以上为待收货的内容 -->
            </div>
            
            <!-- 待评价的内容 -->
			<div class="order_tab order_initial" id="order_content_4">
                <!-- 订单信息表头 -->
                <div class="order_title">
                    <table class="table_head_mod table_bought_mod">
                        <tbody>
                            <tr class="table_title">
                                <th class="title_first">商品</th>
                                <th>单价</th>
                                <th>数量</th>
                                <th>商品操作</th>
                                <th>实付款</th>
                                <th>交易状态</th>
                                <th>交易操作</th>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- 全选和上下翻页 -->
                <div class="rows_select">
                    <div class="select_left">
                    </div>
                    <div class="select_right">
                        <button id="prev_page" class="button_mid_smaill">上一页</button>
                        <button id="next_page" class="button_mid_smaill">下一页</button>
                    </div>
                </div>

                <!-- 订单详细信息 -->
                <div class="order_detail">
                </div>
                <!-- 以上为待评价的内容 -->
            </div>
		</div>		
    </div>
    
    <?php include 'goTop.php';?>          <!-- 返回顶部按钮 -->
    <?php include 'rayState.php'; ?>       <!-- 法律声明内容 -->
</body>
</html>
<script src="./js/layui.all.js"></script>    <!-- 引用的框架  -->
<script src="js/Myajax.js"></script>            <!-- ajax封装函数  -->
<script src='./js/jquery.min.js'></script>        <!-- jq框架  -->
<script src="js/order_info.js"></script>        <!-- 本页面主页的js  -->

