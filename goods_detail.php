<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet"  href='all_style.css'>  <!-- 头部和底部的样式 -->
    <link type="text/css" rel="stylesheet"  href='./css/font-awesome.css'>  <!-- 连接fonts样式 -->
    <link rel="stylesheet" href="./css/detail.css">  <!-- 主体样式 -->
    <link rel="stylesheet" href="./css/layui.css">  <!-- 引用的框架的样式 -->
    <title>商品详情</title>
</head>
<body>
    <!-- 标题导航栏 -->
    
    <?php include 'head.php';?>           <!-- 页眉导航 -->

    <div id="detail_head">
        <div id="head_left">
            <div id="big_pic">
                <img src="./image/0000000000-000000000646151602_2_400x400.jpg" alt="" onclick="get_pic_src(this.src)">
            </div>
            <div id="small_pic">
                <ul>                    
                    <li><a ><img src="./image/0000000000-000000000646151602_2_400x400.jpg" alt="" onclick="get_pic_src(this.src)"></a></li>
                    <li><a ><img src="./image/0000000000-000000000646151602_1_400x400.jpg" alt="" onclick="get_pic_src(this.src)"></a></li>
                    <li><a ><img src="./image/0000000000-000000000646151602_3_400x400.jpg" alt="" onclick="get_pic_src(this.src)"></a></li>
                    <li><a ><img src="./image/0000000000-000000000646151602_4_400x400.jpg" alt="" onclick="get_pic_src(this.src)"></a></li>
                    <li><a ><img src="./image/0000000000-000000000646151602_5_400x400.jpg" alt="" onclick="get_pic_src(this.src)"></a></li>
                </ul>
            </div>
        </div>
        <div id="head_right">
            <!-- 商品购买信息 -->
            <div id="goods_name">
                <h1><a href="" id="goods_name_txt">海信(Hisense)LED55EC750US 55英寸金属超薄 4K超高清HDR 智慧语音 人工智能液晶平板电视</a></h1>
            </div>
            <div id="goods_price">
                <dl>
                    <dt id="price_key">价格</dt>
                    <dd>
                        <em>￥</em>
                        <span id="price_txt">3999</span>
                    </dd>
                </dl>
            </div>

            <!-- 寄送地址 -->
            <div id="goods_fright">                
                <dl>
                    <dt>运费</dt>
                    <dd>
                        <span id="price_txt"   onclick="layerMsg()">杭州∨上城区∨</span>
                    </dd>
                </dl>
            </div>

            <!-- 商品评价 -->
            <div id="goods_mark">
                <ul>
                    <li class="label_left"><a   onclick="layerMsg()"><span class="mark_label" >累计评价</span><span class="mark_numb">177</span></a></li>
                    <li><a   onclick="layerMsg()"><span class="mark_label">送商城积分</span><span class="jf_count">232</span></a></li>
                </ul>
            </div>

            <!-- 商品属性 -->
            <div id="goods_attr">                                
                <dl>
                    <dt>套餐类型</dt>
                    <dd>
                        <ul>
                            <li><a class="chosen s1"><span>官方标配</span></a></li>
                            <li><a class="s1"><span>套餐一</span></a></li>
                            <li><a class="s1"><span>套餐二</span></a></li>
                            <li><a class="s1"><span>套餐三</span></a></li>
                            <li><a class="s1"><span>套餐四</span></a></li>
                        </ul>
                    </dd>
                </dl>
                <dl>
                    <dt>购买方方式</dt>
                    <dd>
                        <ul>
                            <li><a class="chosen s2"><span>标配</span></a></li>
                            <li><a class="s2"><span>赠百元商城权益礼包</span></a></li>
                        </ul>
                    </dd>
                </dl>
                <dl>
                    <dt>优惠活动</dt>
                    <dd>
                        <ul>
                            <li><a class="chosen s3"><span>积分返现</span></a></li>
                            <li><a class="s3"><span>好评返e卡</span></a></li>
                        </ul>
                    </dd>
                </dl>                
                <dl>
                    <dt>数量</dt>
                    <dd>
                        <input type="text" title="请输入购买数量" value="1" id="mui_amount_input" size="8">
                        <span id="mui_amount_btn">
                            <span id="mui_amount_increse">∧</span>
                            <span id="mui_amount_decrease">∨</span>
                        </span>
                    </dd>
                </dl>
            </div>
            <!-- 购买按钮 -->
            <div id="action_button">
                <div id="btn_buy"><a id="btn_buyNow" role="button" onclick="payNow(this)"  title="点击此按钮，到下一步确认购买信息。">立即购买</a></div>
                <div id="btn_linkBuy"><a id="btn_addCart" role="button" data-goods-id="47858" title="点击此按钮，添加到购物车" onClick="addCart(this)">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> 加入购物车
                </a></div>
            </div>

            <!-- 服务承诺 -->
            <div id="servies_promise">
                <dl>
                    <dt>服务承诺</dt>
                    <dd>
                        <ul>
                            <li>全国联保</li>
                            <li>送货入户</li>
                            <li>正品保证</li>
                            <li>通电验机</li>
                            <!-- <li>免举证退换货</li> -->
                            <li>支付方式∧</li>
                            <li>急速退款</li>
                            <li>七天无理由退货</li>
                        </ul>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
    
    <div id="detail_body">
		<ul id="c_list">
			<li class="bg_c"><a>商品介绍</a></li>
			<li class=""><a   onclick="layerMsg()">规格与包装</a></li>
			<li class=""><a   onclick="layerMsg()">售后保障</a></li>
			<li class=""><a   onclick="layerMsg()">商品评价</a></li>
			<li class=""><a   onclick="layerMsg()">商品社区</a></li>
		</ul>
		<div id="c_con">
			<!-- 商品介绍的内容 -->
			<div class="detail_tab " id="detail_content">
                该商品暂无详细介绍，或当前网络存在问题
				
			</div>
			<div class="detail_tab detail_initial">规格与包装的内容</div>
			<div class="detail_tab detail_initial">售后保障的内容</div>
			<div class="detail_tab detail_initial">商品评价的内容</div>
			<div class="detail_tab detail_initial">商品社区的内容</div>
		</div>		
	</div>
    <div id="footer"></div>

    
    <?php include 'goTop.php';?>          <!-- 返回顶部按钮 -->
    <?php include 'rayState.php'; ?>       <!-- 法律声明 -->
</body>
</html>
<?php
    $goods_id = @$_GET['goods_id'];
    if(!$goods_id)
        $goods_id = 47858;// 若url中没有附带商品id则赋一个默认值
    // echo "<script>var goods_id=$goods_id</script>";// 通过PHP获取页面传递过来的商品id
?>
<script src="./js/layui.all.js"></script>    <!-- 引用的框架  -->
<script src="./js/Myajax.js"></script>
<!-- 创建ajax对象 -->
<script src="./js/detail-ajax.js"></script>
<script src='./js/jquery.min.js'></script>        <!-- jq  -->
<!-- 本页面主要js -->
<script src="./js/goods_detail.js"></script>
<!-- <script src='./js/all_JavaScript.js'></script>    主页部分js  -->

<?php 
    session_start();
?>      <!-- php  -->
