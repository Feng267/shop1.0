    
    // layer.msg('好的少侠，正在为您加紧发货呢！', { icon: 1 time: 1000, shade: [0.6, '#000', true] });


    // 订单主体的tab栏标签
    var list = document.querySelector('#c_list');// tab容器
    var lis = list.querySelectorAll('li');// tab栏标题
    var cons = document.querySelector('#c_con').querySelectorAll('.order_tab');// tab栏分类中的内容
    let isNull = 0;// 用户是否有订单
    let rayState =  document.getElementById('rayState');// 底部法律声明

    // 点击tab栏切换对应的内容
    for(let i = 0; i < lis.length; i++){
        lis[i].setAttribute('data-index', i)// 给li标签设置自定义属性，用以和原有属性区分，加上“data-”前缀
        lis[i].onclick = function(){
            // console.log(lis[i]);
            for(var j = 0; j < lis.length; j++){
                lis[j].className = '';
                cons[j].className  = ' order_tab order_initial';// 将所有的“内容”隐藏；
            }
            this.className += ' bg_c';// 添加特定样式
            var index = this.getAttribute('data-index');// 获取当前点击的li标签的序号
            cons[index].className += ' order_show'// 将指定的div显示出来

            let detail_wrap_new = cons[i].querySelectorAll('.detail_wrap');
            // console.log(detail_wrap_new.length);
            // 当前tab栏中订单数量过小，控制底部说明栏为粘脚。
            if(detail_wrap_new.length < 2){
                rayState.style.display = 'block';
                rayState.style.position = 'absolute';
                rayState.style.bottom = 0;
            }else{
                rayState.style.display = 'block';
                rayState.style.position = 'relative';
            }
            
        }
    }

    
    
    // 请求订单信息
    var ajaxGetData={
        method: 'post',
        url: 'API/request_order_infor_API.php',
        data:{            
            user_id: user_id
        },
        success:function(value){
            var order_detail = document.querySelector('.order_detail');// 所有订单
            var obj = JSON.parse(value);// 将JSON格式的数据解析成数组
            // console.log([obj.data][0]);
            let order_amount = [obj.data][0].length;
            // console.log(order_amount);
            if([obj.data][0])
                isNull = create_detail_wrap([obj.data][0]);
            rayState.style.display = 'block';
            
            // 控制底部说明栏的位置；订单数量太少，也会发生底部说明栏不在页面底部的问题
            if(isNull && order_amount > 1){
                rayState.style.display = 'block';
                // rayState.style.bottom = 0;
            }else{
                rayState.style.display = 'block';
                rayState.style.position = 'absolute';
                rayState.style.bottom = 0;
            }           

        },
        error:function(value){
            console.log(value);
        }
    }
    $ajax(ajaxGetData);

    // 生成订单的HTML元素并插入页面
    function create_detail_wrap(order_arr){
        var order_content_all = document.querySelector('#order_content_all')// ‘所有订单’的元素
        var order_content_1 = document.querySelector('#order_content_1')// ‘付款’的元素
        var order_content_2 = document.querySelector('#order_content_2')// ‘待发货’的元素
        var order_content_3 = document.querySelector('#order_content_3')// ‘待收货’的元素
        var order_content_4 = document.querySelector('#order_content_4')// ‘待评价’的元素
        var order_detail = order_content_all.querySelector('.order_detail');// 多个订单详情的元素
        var detail_wrap = order_detail.querySelector('.detail_wrap');// 单个订单详情的外容器

        // console.log(order_content_1, order_content_2, order_content_3, order_content_4);
        // 循环将返回的订单信息填入到相应的tab栏内容中
        for(var i = 0; i < order_arr.length; i++){                  
            var order_operation = ['评价','付款','催发货','确认收货'];// 各类型订单的按钮操作 
            var order_status = order_arr[i]['order_status'];
            // var status = {'待付款':1,'已付款待发货':2,'已发货待收货':3,'已收货待评价':4,'历史订单':5};
            switch(order_status){
                case '待付款': 
                    // console.log('待付款', i);                    
                    var order_detail_1 = order_content_1.querySelector('.order_detail');// 多个订单详情的元素
                    // console.log(order_detail_1);
                    write_detail_wrap(order_detail_1,detail_wrap, order_arr[i], order_operation[1]);// 插入到‘待付款’订单中
                    write_detail_wrap(order_detail,detail_wrap, order_arr[i], order_operation[1]);// 插入到‘所有订单’中

                    break;
                case '已付款待发货':
                    // console.log('已付款待发货');                    
                    var order_detail_2 = order_content_2.querySelector('.order_detail');// 多个订单详情的元素
                    write_detail_wrap(order_detail_2,detail_wrap, order_arr[i], order_operation[2]);
                    write_detail_wrap(order_detail,detail_wrap, order_arr[i], order_operation[2]);// 插入到‘所有订单’中
                    
                    break;                    
                case '已发货待收货':
                    // console.log('已发货待收货');                    
                    var order_detail_3 = order_content_3.querySelector('.order_detail');// 多个订单详情的元素
                    write_detail_wrap(order_detail_3,detail_wrap, order_arr[i], order_operation[3]);
                    write_detail_wrap(order_detail,detail_wrap, order_arr[i], order_operation[3]);// 插入到‘所有订单’中
                    break;
                case '已收货待评价':
                    // console.log('已收货待评价');                    
                    var order_detail_4 = order_content_4.querySelector('.order_detail');// 多个订单详情的元素
                    write_detail_wrap(order_detail_4,detail_wrap, order_arr[i], order_operation[0]);
                    write_detail_wrap(order_detail,detail_wrap, order_arr[i], order_operation[1]);// 插入到‘所有订单’中
                    break;
                default:
                    // console.log('历史订单');
                    write_detail_wrap(order_detail,detail_wrap, order_arr[i], '再次购买');// 插入到‘所有订单’中
                    break;
            }
            
        }
        return 1;
    }

    // 生成dom元素并插入值
    function write_detail_wrap(new_order_detail,detail_wrap,order_arr, order_operation_txt){
        var new_detail_wrap = detail_wrap.cloneNode(true);// 获取单个订单容器下的值
            new_detail_wrap.querySelector('.order_time_txt').innerHTML = order_arr['date'];// 订单时间
            new_detail_wrap.querySelector('.order_id_txt').innerHTML = order_arr['order_id'];// 订单号
            new_detail_wrap.querySelector('.cat_name_txt').innerHTML = order_arr['cat_name'];// 分类名称
            new_detail_wrap.querySelector('.goods_pic').src = order_arr['goods_pic'];// 商品图片
            new_detail_wrap.querySelector('.goods_name_txt').innerHTML = order_arr['goods_name'];// 商品名称
            new_detail_wrap.querySelector('.goods_attr_txt').innerHTML = order_arr['goods_attr'];// 商品属性
            new_detail_wrap.querySelector('.goods_simple_price_txt').innerHTML = order_arr['goods_prise'];// 商品单价
            new_detail_wrap.querySelector('.goods_number_txt').innerHTML = order_arr['goods_number'];// 商品数量
            new_detail_wrap.querySelector('.order_total_price_txt').innerHTML = order_arr['total_price'];// 订单总价            
            new_detail_wrap.querySelector('.order_operation_txt').innerHTML = order_operation_txt;// 订单操作描述   
            // 各个订单按钮的操作  
            if(order_operation_txt == '付款')      
                new_detail_wrap.querySelector('.order_operation_txt').href = "pay.php?order_id=" + order_arr['order_id'];// 订单操作
            else if(order_operation_txt == '催发货')
                new_detail_wrap.querySelector('.order_operation_txt').setAttribute("onclick", "layerMsg(7)");
            else if(order_operation_txt == '确认收货'){
                new_detail_wrap.querySelector('.order_operation_txt').setAttribute("onclick", "orderOperation('" + order_arr['order_id'].toString() +"')");
                // console.log(typeof order_arr['order_id'].toString(), order_arr['order_id'].toString());
            }
            else
                new_detail_wrap.querySelector('.order_operation_txt').setAttribute("onclick", "layerMsg()");
                
            new_order_detail.appendChild(new_detail_wrap);// 写入页面
    }

    // 弹窗提示信息
    // function layerMsg(e){
    //     layer.msg('好的少侠，正在为您加紧发货呢！', { icon: 1, time: 1000, shade: [0.6, '#000', true] });
    // }
    
    // 确认收货
    function orderOperation(order_id){
        // console.log(order_id);
        // ajax请求
        var ajaxGetData={
            method: 'post',
            url: 'API/update_order_status.php',
            data:{            
                order_id: order_id
            },
            success:function(value){
                // console.log(typeof value, value,typeof order_id, order_id);
                if(value==1){
                    layerMsg(4);
                    setTimeout(function (){                        
                        location.reload();                       
                    }, 1000);
                }
                else
                    layerMsg(5);       

            },
            error:function(value){
                console.log(value);
            }
        }
        $ajax(ajaxGetData);
    }
    
    /*-------------------------------------------返回顶部按钮--------------- */

    $(function(){
        $(window).scroll(function(){  //只要窗口滚动,就触发下面代码
        var scrollt = document.documentElement.scrollTop + document.body.scrollTop; //获取滚动后的高度
        if( scrollt >200 ){  //判断滚动后高度超过200px,就显示
            $("#back_top").fadeIn(400); //淡入
        }else{
            $("#back_top").stop().fadeOut(400); //如果返回或者没有超过,就淡出.必须加上stop()停止之前动画,否则会出现闪动
        }
        });
        $("#back_top").click(function(){ //当点击标签的时候,使用animate在200毫秒的时间内,滚到顶部
        $("html,body").animate({scrollTop:"0px"},200);
        }); 
    });
