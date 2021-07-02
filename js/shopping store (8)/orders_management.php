<!DOCTYPE html>
<html>
<?php
  include "verify.php";
?>
<head>
    <meta charset="utf-8">
    <title>订单管理</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="layui/css/layui.css" media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
    <style>
        body .layui-layer-table{
            font-size: 7px !important;
            color: black;
        }
        #all_select{
            
            width: 1200px;
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
        
        /*  修改日历控件类型 */
        #all_select input {
            height: 31px;
            border: 1px solid black;
            border-radius: 20px;
        }
        #start_date{
            margin-left: 20px;
        }
        .date {
            display: inline-block;
            width: 10px;
            font-size: 20px;
        }
        #search_btn{
            height: 27px;
            width: 50px;
            border: 1px solid black;
            border-radius: 20px;
            background-color: #fff;
            box-shadow: 1px 1px 5px black;
        }
        #search_btn:hover{
            background-color: rgb(230, 227, 227);
        }
        ::-webkit-datetime-edit {
            padding: 23px;
        }


        /*控制编辑区域的*/
        ::-webkit-datetime-edit-fields-wrapper {
            background-color: #fff;
            padding-top: 2px;
        }


        /*控制年月日这个区域的*/
        ::-webkit-datetime-edit-text {
            color: black;
            padding: 10px;
        }


        /*这是控制年月日之间的斜线或短横线的*/
        ::-webkit-datetime-edit-year-field {
            color: black;
        }


        /*控制年文字, 如2013四个字母占据的那片地方*/
        ::-webkit-datetime-edit-month-field {
            color: black;
        }


        /*控制月份*/
        ::-webkit-datetime-edit-day-field {
            color: black;
        }


        /*控制具体日子*/
        ::-webkit-inner-spin-button {
            cursor: pointer;
            display: none;
        }

        /*这是控制上下小箭头的*/
        ::-webkit-calendar-picker-indicator {
            /*这是控制下拉小箭头的*/
            border: 1px solid #ccc;
            border-radius: 12px;
            box-shadow: inset 0 1px #fff, 0 1px #eee;
            /* background-color: rgb(165, 65, 65); */
            background-image: -webkit-linear-gradient(top, #f5c9c9, #a7f6f6);
            margin: 0px 10px 0px 5px;
            color: #666;
            cursor: pointer;
        }

        ::-webkit-clear-button {
            /*控制清除按钮*/
            margin-bottom: 3px;
            cursor: pointer;
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
        <select id="select_cat3" name="cat_id">
            <option value="">先选二级分类</option>
        </select>
        
            <!--搜索日期区间-->
            <input type="date" id="start_date">
            <input type="date" id="end_date">
            <button id="search_btn" type="button">Search</button>
    </div>

    <!--这是页面里的表格-->
    <table class="layui-hide" id="test3" lay-filter="test3" style="overflow:hiden"></table>

    
    <!-- 引入jq，辅助layui运行ajax和操作select标签-->
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
                url: 'data_control/request_orders_API.php',
                method: 'post',
                
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
                            width: 66,
                            title: '序号',
                            sort: true,
                        }, {
                            field: 'order_id',
                            width: 171,
                            title: '订单编号',
                        }, {
                            field: 'goods_id',
                            width: 74,
                            title: '商品id',
                            sort: true,
                        }, {
                            field: 'cat_name',
                            width: 86,
                            title: '商品类型',
                        }, {
                            field: 'goods_name',
                            width: 218,
                            title: '商品名称',
                        }, {
                            field: 'goods_attr',
                            width: 357,
                            title: '商品属性',
                            sort: true,
                            edit: 'text'
                        }, {
                            field: 'goods_prise',
                            width: 73,
                            title: '单价',
                            sort: true,
                            edit: 'text'
                        }, {
                            field: 'goods_number',
                            width: 73,
                            title: '数量',
                            sort: true,
                            edit: 'text'
                        }, {
                            field: 'total_price',
                            width: 73,
                            title: '总价',
                            sort: true,
                            edit: 'text'
                        }, {
                            field: 'received_addr',
                            width: 280,
                            title: '收货地址',
                            sort: true,
                            edit: 'text'
                        }, {
                            field: 'received_tel',
                            width: 120,
                            title: '联系人电话',
                            sort: true,
                            edit: 'text'
                        }, {
                            field: 'received_people',
                            width: 80,
                            title: '收货人',
                            sort: true,
                            edit: 'text'
                        },{
                            field: 'order_status',
                            width: 90,
                            title: '状态',
                            sort: true,
                            edit: 'text'
                        }, {
                            field: 'date',
                            width: 180,
                            title: '日期',
                            sort: true,
                        }, {
                            fixed: 'right', 
                            title:'操作', 
                            toolbar: '#barDemo', 
                            width:64
                        }]
                    ]
                    //,page: true
            });

            //监听键盘事件,当点击search按钮时，传输时间区间
            $("#search_btn").click(function(event) {
                var start_date = $("#start_date").val();
                var end_date = $("#end_date").val();
                table.reload('test3', {
                    method: 'post',
                    where: {
                        'start_date': start_date,
                        'end_date': end_date
                    },
                    page: {
                        curr: 1
                    }
                });
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

            //监听工具条删除记录
            table.on('tool(test3)', function(obj){ //注：tool 是工具条事件名，test 是 table 原始容器的属性 lay-filter="对应的值"
                var data = obj.data; //获得当前行数据
                var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                
                if(layEvent === 'del'){ //删除
                    layer.confirm('真的删除行么', function(index){
                        obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                        layer.close(index);
                        //向服务端发送删除指令

                        $order_id = data.order_id;
                        console.log('删除了' + $order_id + "的订单");
                        //ajax代码，实现数据表格的可视化修改
                        $.ajax({
                            type: "GET", //以get方式传输数据
                            url: " data_control/delete.php?order_id=" + $order_id, //数据目的地和值
                            dataType: "text",
                            success: function(data) {
                                if (data == "200")
                                    layer.msg('删除了商品ID为: ' + $order_id + ']的商品');
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

                //将layui表格的数据存到对应变量，准备传输到updata_order_info.php里面
                $order_id = data.order_id; //得到ID
                $goods_field = field; //得到列名
                $goods_value = value; //得到修改后的值

                //ajax代码，实现数据表格的可视化修改
                $.ajax({
                    type: "GET", //以get方式传输数据
                    url: " data_control/updata_order_info.php?order_id=" + $order_id + "&goods_field=" + $goods_field + "&good_value=" + $goods_value, //数据目的地和值
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