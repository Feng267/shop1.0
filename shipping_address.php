<html>
<head>
    <title>收货地址</title>
    <link type="text/css" rel="stylesheet"  href='all_style.css'>  <!-- 连接 大部分css -->
    <link type="text/css" rel="stylesheet" href="layui/css/layui.css">
    <link type="text/css" rel="stylesheet" href="css/user_center.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/shipping_address.js"></script>
    <style>

        label,input,span{
            color: black;
        }

        .layui-input{
            width: 45%;
        }

        .layui-edge{
            left: 40%;
        }

        .layui-form-select dl{
            min-width: 45%;
        }

        .layui-form-item{
            margin-top: 40px;
            margin-bottom: 15px;
            clear: both;
            *zoom: 1
        }
        dl{
            width: 45%;
        }

    </style>
</head>
<body>
<?php include 'head.php';?>         <!-- 页眉导航 -->
<?php session_start();?>

<div id="big_frame">
    <?php include "API/user_center_navigation.php"?>

    <div id="right_frame">
        <form class="layui-form" method="post">

            <div class="layui-form-item">
                <label class="layui-form-label" style="text-align:justify; text-align-last: justify;">已有地址</label>
                <div class="layui-input-block">
                    <select name="address" id="sele" lay-filter="address">
                        <option id="op" selected="selected">添加新地址</option>
                    </select>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" style="text-align:justify; text-align-last: justify;">收货地址</label>
                <div class="layui-input-block">
                    <input type="text" id="address" name="address" lay-verify="title" autocomplete="off" placeholder="请输入您的收货地址" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" style="text-align:justify; text-align-last: justify;">收货人</label>
                <div class="layui-input-block">
                    <input type="text" id="consignee" name="consignee" lay-verify="title" autocomplete="off" placeholder="请输入收货人名字" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label" style="text-align:justify; text-align-last: justify;">电话</label>
                <div class="layui-input-block">
                    <input type="tel" id="phone" name="phone" lay-verify="title" autocomplete="off" placeholder="请输入电话" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">邮政编码</label>
                <div class="layui-input-block">
                    <input type="text" id="post" name="post" lay-verify="title" autocomplete="off" placeholder="请输入邮政编码" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button type="submit" id="submit" name="submit" class="layui-btn" lay-submit="" lay-filter="demo1">保存</button>
                    <button type="reset" name="reset" class="layui-btn layui-btn-primary">重置</button>
                    <button type="button" name="button" class="layui-btn layui-btn-primary" onclick="return1()">返回</button>
                </div>
            </div>
        </form>

    </div>
    <?php include "API/update_received_info.php"?>
    <?php include "API/insert_received_info.php"?>
    <script  src="layui/layui.js" charset="utf-8"></script>
    <script src="js/shipping_address.js"></script>
    <?php include "allPhpfun.php"?>
</div>
</body>
</html>