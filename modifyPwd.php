<html>
<head>
    <title>修改密码</title>
    <link type="text/css" rel="stylesheet"  href='css/all_style.css'>  <!-- 连接 大部分css -->
    <link type="text/css" rel="stylesheet" href="layui/css/layui.css">
    <link type="text/css" rel="stylesheet" href="css/user_center.css">
    <script  src="layui/layui.js" charset="utf-8"></script>
    <script  src="layui/layui.all.js" charset="utf-8"></script>
    <script src="js/jquery-3.2.1.js"></script>
    <script  src="js/modifyPwd.js" charset="utf-8"></script>
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
            margin-left: 20%;
            margin-top: 40px;
            margin-bottom: 15px;
            clear: both;
            *zoom: 1
        }

        button{
            margin-left: 40%;
        }

    </style>
</head>
<body>
    <?php include 'head.php';?>         <!-- 页眉导航 -->
    <?php session_start();?>

    <div id="big_frame">
        <?php include "API/user_center_navigation.php"?>

        <div id="right_frame">

                <div class="layui-form-item" id="old_password">
                    <label class="layui-form-label">原密码</label>
                    <div class="layui-input-block">
                        <input type="password" id="old_ps" name="old_ps" lay-verify="title" autocomplete="off" placeholder="请输入原密码" class="layui-input">
                    </div>
                </div>
                <button type="button" id="button" name="button" class="layui-btn" lay-submit="" onclick="next_step()">下一步</button>
        </div>

        <?php include "allPhpfun.php"?>
    </div>
</body>
</html>