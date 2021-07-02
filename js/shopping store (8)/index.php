<!doctype html>
<html lang="en">
<?php
  include "verify.php";
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>数码暴龙后台管理耶</title>
    <style>
        body {
            background: url(images/bg.png) no-repeat center;
            background-size: cover;
        }
        
        #menu {
            background: url(images/navbg.png) center;
            background-size: cover;
        }
        
        #menu li a {
            font-size: 16px;
            color: black;
        }
        
        #nav1,
        #nav2,
        #nav3,
        #nav4 {
            color: black;
            /* 测试用 */
        }
        
        #main_iframe {
            width: 1300px;
            height: 605px;
            margin: -16px 0px 0px 120px;
            border-left: 1px solid #EEEEEE;
            border-right: 1px solid #EEEEEE;
            overflow: hidden;
        }
    </style>
</head>

<body>

    <nav aria-label="breadcrumb">
        <ol id="menu" class="breadcrumb">
            <!--点击时,更改iframe标签里的url属性的值-->
            <li class="breadcrumb-item"><a id="nav1" href="#" @click="alter_iframe_url('welcome.php')">主页</a></li>
            <li class="breadcrumb-item"><a id="nav2" href="#" @click="alter_iframe_url('goods_management.php')">商品库存管理</a></li>
            <li class="breadcrumb-item"><a id="nav3" href="#" @click="alter_iframe_url('orders_management.php')">订单管理</a></li>
            <li class="breadcrumb-item"><a id="nav4" href="#" @click="alter_iframe_url('keyword_search.php')">关键字搜索</a></li>
            <li class="breadcrumb-item"><a id="nav5" href="#" @click="alter_iframe_url('new_goods.php')">商品上新</a></li>
            <li class="breadcrumb-item"><a id="nav5" href="#" @click="alter_iframe_url('account_book.php')">销售流水</a></li>
        </ol>
    </nav>

    <iframe id="main_iframe" class="shadow p-3 mb-5 bg-white rounded" :src="mainbody_url" frameborder="0"></iframe>
    <!--网页主体-->

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <!-- 引入ajax-->
    <!--<script src="jquery/jquery-3.5.1.min.js"></script>-->

    <!--点击菜单时,更改iframe标签里的url属性的值，以此实现页面切换-->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
        var menu = new Vue({
            el: "#menu",
            methods: {
                alter_iframe_url: function(url1, id1) {
                    iframe1.mainbody_url = url1; //修改iframe的url
                },
            }
        });
        var iframe1 = new Vue({
            el: "#main_iframe",
            data: {
                mainbody_url: "welcome.php",
            },
        });
    </script>

    <!-- 引入boostrap -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>