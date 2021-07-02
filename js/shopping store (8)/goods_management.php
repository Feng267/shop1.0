<!DOCTYPE html>
<html>
<?php
  include "verify.php";
?>
<head>
    <meta charset="utf-8">
    <title>商品库存管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="layui/css/layui.css" media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
    <style>
        #all_select{
            width: 1000px;
        }
        #all_select select {
            width: 220px; 
            height: 31px;
            margin-left: 12px;
            padding-left: 12px;
            line-height: 31px;
            font-size: 12px;
            color: #333;
            appearance: icon;
            border: 1px solid #000000;
            border-radius: 30px;
            overflow: hidden;
        }
        option{
            font-size: 14px !important;
        }
    </style>
</head>

<body>
    <!-- 多级分类选择框 -->
    <div id="all_select">
        <select id="select_cat1">
            <option>请选择一级分类</option>
            <option value="0">大家电</option>
            <option value="4">手机相机</option>
            <option value="5">电脑办公</option>
            <option value="1">热门推荐</option>
            <option value="25">智能设备</option>
        </select>
        <select id="select_cat2">
            <option>先选一级分类</option>
        </select>
        <select id="select_cat3">
            <option value="">先选二级分类</option>
        </select>
    </div>

    <!--这是页面里的表格-->
    <table class="layui-hide" id="test3" lay-filter="test3" style="overflow:hiden"></table>

    <!-- 引入jq，运行ajax,操作select标签 -->
    <script src="jquery/jquery-3.5.1.min.js"></script>

    <!-- 封装了的一段操作select标签的js代码 -->
    <script src="jquery/all_select.js"></script>

    <!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
    <script src="layui/layui.js" charset="utf-8"></script>

    <!-- 向页面添加删除数据功能 -->
    <script type="text/html" id="barDemo">
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
    </script>

    <!-- 使用layui表格样式 -->
    <script>
        layui.use('table', function() {
            var table = layui.table;

            table.render({
                elem: '#test3',
                url: 'data_control/request_goods_infor_API.php',
                method: 'post',
                where: {
                    'cat_id': '10'  //默认显示cat_id为10的类
                }, 
                page: { //支持传入 laypage 组件的所有参数（某些参数除外，如：jump/elem） - 详见文档
                    layout: ['prev', 'page', 'next', 'skip', 'count'] //自定义分页布局
                        //,curr: 5 //设定初始在第 5 页
                        ,
                    limit: 11 //一页显示多少条 
                        //,limits:[11,22,31] //一页显示多少条 
                },
                cols: [
                        [{
                            field: 'numb',
                            width: 80,
                            title: '序号',
                            sort: true,
                            edit: 'text'
                        }, {
                            field: 'goods_id',
                            width: 80,
                            title: '商品ID',
                            edit: 'text'
                        }, {
                            field: 'cat_name',
                            width: 80,
                            title: '类型',
                            sort: true,
                            edit: 'text'
                        }, {
                            field: 'goods_name',
                            width: 636,
                            title: '商品名称',
                            edit: 'text'
                        }, {
                            field: 'goods_price',
                            width: 80,
                            title: '价格',
                            edit: 'text'
                        }, {
                            field: 'goods_number',
                            width: 80,
                            title: '库存',
                            sort: true,
                            edit: 'text'
                        }, {
                            field: 'date',
                            width: 159,
                            title: '上架日期',
                            sort: true,
                            edit: 'text'
                        }, {
                            fixed: 'right', 
                            title:'操作', 
                            toolbar: '#barDemo', 
                            width:64
                        }]
                    ]
                    //,page: true
            });
            
            //根据类ID更新显示内容
            $("#select_cat3").change(function (event) {
                var cat_id = $(this).find("option:selected").val();
                table.reload('test3', {
                    method: 'post',
                    where: {
                        'cat_id': cat_id
                    },
                    page: {
                        curr: 1
                    }
                });
            })

            //监听工具条 
            table.on('tool(test3)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
                var data = obj.data; //获得当前行数据
                var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                
                if(layEvent === 'del'){ //删除
                    layer.confirm('真的删除行么', function(index){
                        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        //向服务端发送删除指令

                        $goods_id = data.goods_id;
                        console.log($goods_id);
                        //ajax代码，实现数据表格的可视化修改
                        $.ajax({
                            type: "GET", //以get方式传输数据
                            url: " delete.php?goods_id=" + $goods_id, //数据目的地和值
                            dataType: "text",
                            success: function(data) {
                                if (data == "200")
                                    layer.msg('删除了商品ID为: ' + $goods_id + ']的商品');
                            },
                            error: function(jqXHR) {
                                layer.msg('ajax_error');
                            }
                        });

                    });
                }else if(layEvent === 'LAYTABLE_TIPS'){
                    layer.alert('Hi，头部工具栏扩展的右侧图标。');
                }
            });
        });
    </script>

    <!-- 使用layui表格的单元格监听，当产生编辑事件时执行ajax修改数据库数据 -->
    <script>
        layui.use('table', function() {
            var table = layui.table;

            //监听单元格编辑，当编辑完成后回车或点击旁边触发
            table.on('edit(test3)', function(obj) {
                var value = obj.value //得到修改后的值
                    ,
                    data = obj.data //得到所在行所有键值
                    ,
                    field = obj.field; //得到字段

                //将layui表格的数据存到对应变量，准备传输到updata.php里面
                $goods_id = data.goods_id; //得到ID
                $goods_field = field; //得到列名
                $goods_value = value; //得到修改后的值

                //ajax代码，将必须的数据传输后，成功则执行success，失败执行error
                $.ajax({
                    type: "GET", //以get方式传输数据
                    url: "data_control/updata.php?goods_id=" + $goods_id + "&goods_field=" + $goods_field + "&good_value=" + $goods_value, //数据目的地和值
                    dataType: "text",
                    success: function(data) {
                        if (data == "200")
                            layer.msg('[商品ID为: ' + data.goods_id + ']的 ' + field + ' 字段更改为了：' + value);
                    },
                    error: function(jqXHR) {
                        layer.msg('ajax_error');
                    }
                });
            });
        });
    </script>
</body>

</html>