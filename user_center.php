<html>
<head>
    <title>用户中心</title>
    <link type="text/css" rel="stylesheet"  href='all_style.css'>  <!-- 连接 大部分css -->
    <link type="text/css" rel="stylesheet" href="layui/css/layui.css">
    <link type="text/css" rel="stylesheet" href="css/user_center.css">
    <script src="js/jquery-3.2.1.js"></script>
    <script src="js/user_center.js"></script>
    <style>

        .layui-upload-img {
            width: 92px;
            height: 92px;
            border: 1px solid black;
            border-radius: 46px;
            margin: 0 10px 0px 0;
        }

        label,input,span{
            color: black;
        }

        .layui-input{
            width: 45%;
        }

        .layui-form-item{
            margin-top: 40px;
        }

        .icon{
            margin-left: 110px;
        }

    </style>
</head>
<body>

    <?php 
        include 'isLogin.php';
    include 'head.php';?>         <!-- 页眉导航 -->
    <?php session_start();?>

    <div id="big_frame">
        <?php include "API/user_center_navigation.php"?>

        <div id="right_frame">
            <form class="layui-form" method="post">

                <!-- 头像上传 -->
                <div class="icon">
                    <div class="layui-upload">
                        <div class="layui-upload-list">
                            <img class="layui-upload-img" name="img" id="demo1" src="image/head_pic/default.jpg">
                            <p id="demoText"></p>
                        </div>
                        <button type="button" class="layui-btn" id="test1">上传头像</button>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><font style="color: red">*</font>昵称:</label>
                    <div class="layui-input-block">
                        <input type="text" id="nickname" name="nickname" lay-verify="title" onblur="name_tips(this)" autocomplete="off" placeholder="请输入昵称" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><font style="color: red">*</font>性别:</label>
                    <div class="layui-input-block">
                        <input type="text" id="sex" name="sex" lay-verify="title" onblur="sex_tips(this)" autocomplete="off" placeholder="请输入性别" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label"><font style="color: red">*</font>电话:</label>
                    <div class="layui-input-block">
                        <input type="text" id="phone" name="phone" readonly="readonly" lay-verify="title" autocomplete="off" placeholder="请输入电话" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">邮箱:</label>
                    <div class="layui-input-block">
                        <input type="email" id="email" name="email" lay-verify="title" autocomplete="off" placeholder="请输入邮箱" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" id="submit" name="submit" class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                        <button type="reset" name="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>

        </div>
        <?php include 'API/update_user_center.php'?>   <!-- 提交页面 -->
        <script  src="layui/layui.js" charset="utf-8"></script>
        <script src="js/img_upload.js"></script>
        <?php include "allPhpfun.php"?>
    </div>
    
</body>
</html>
