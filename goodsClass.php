<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>分类</title>
    
    <link type="text/css" rel="stylesheet"  href='all_style.css'>   <!-- 大部分css -->
    <style>
        #goods_class_frame{
            width:1200px;
            height:750px; 
            border:1px #000 solid;
            margin:10px auto;
        }
        #searchFrame{
            width:1000px;
            height:50px; 
            border:1px #000 solid;
            background-color:#fff;
            margin:10px auto;
        }
        #seaT{
            width:800px;
            height:50px; 
            float:left;
        }
        #seaT
        #seaS{
            width:200px;
            height:50px; 
            float:left;
        }

    </style>
</head>


<body>
<?php include 'head.php';?>           <!-- 页眉导航 -->
<?php include 'side_nav.php';?>       <!-- 右边悬浮栏 -->
<?php include 'goTop.php';?>          <!-- 返回顶部按钮 -->
<?php include 'allPhpfun.php';?>      <!-- php  -->
<?php  include 'goback.php'; ?>       <!-- 没有登录，提示他去登录 -->
<?php include 'goTop.php';?>          <!-- 返回顶部按钮 -->
<div id='goods_class_frame'>
        <div id='searchFrame'>
            <div id='seaT'><input type='text' name='searchText'></div>
            <div id='seaS'><input type='submit' value='搜索'></div>
        </div>


</div>

<?php include 'rayState.php'; ?>       <!-- 法律声明 -->
</body>


<script src='js/jquery.min.js'></script>        <!-- jq  -->
<!-- <script src='all_JavaScript.js'></script>    js  -->

</html>
