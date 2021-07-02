    // 需要填充数据的页面标签
    var big_pic = document.getElementById("big_pic").childNodes[1];// 大图片
    var small_pic = document.getElementById('small_pic').querySelectorAll('img');// 小图片
    var goods_name = document.getElementById('goods_name_txt');// 商品名字
    var goods_price = document.getElementById('price_txt');// 商品价格
    var detail_content = document.getElementById('detail_content');// 商品详情描述的主要内容
    var btn_addCart = document.getElementById('btn_addCart');// 加入购物车按钮
    let btn_buyNow = document.getElementById('btn_buyNow');// 立即购买按钮


    // 商品属性
    var s1 = document.querySelectorAll('.s1');// 套餐类型
    var s2 = document.querySelectorAll('.s2');// 购买方式
    var s3 = document.querySelectorAll('.s3');// 优惠活动
    var increse_btn = document.getElementById('mui_amount_increse');// 商品数量增加按钮
    var decrease_btn = document.getElementById('mui_amount_decrease');// 商品数量减少按钮
    var goods_amount = document.getElementById("mui_amount_input");// 商品数量
    var amount = parseInt(goods_amount.value);// 转化为数字

    // 商品介绍的tab栏标签
    var list = document.querySelector('#c_list');// tab容器
    var lis = list.querySelectorAll('li');// tab栏标题
    var cons = document.querySelector('#c_con').querySelectorAll('.detail_tab');// tab栏分类中的内容

    // 点击小图片切换为大图片
    function get_pic_src(src){                
        big_pic.src = src;
    }

    // 获取url携带的参数
    function GetRequest() {  
        var url = location.search; //获取url中"?"符后的字串  
        var theRequest = new Object();  
        if (url.indexOf("?") != -1) {  
            var str = url.substr(1);  
            strs = str.split("&");  
            for(var i = 0; i < strs.length; i ++) {  
                theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);  
            }  
        }  
        return theRequest;  
    }
    var urlAttr = GetRequest();  
    var goods_id = urlAttr.goods_id;
    if(!goods_id)
        goods_id = 47858;// 若url中没有附带商品id则赋一个默认值  

    
    

    // 获取商品详情
    function getGoodsDetail(){        
        
        XMLHttp = getXmlHttpObject();// 初始化一个XMLHttpRequest对象;
        //API原形：https://api-hmugo-web.itheima.net/api/public/v1/goods/detail?goods_id=47869
        var url = "https://api-hmugo-web.itheima.net/api/public/v1/goods/detail?goods_id=" + goods_id;

        XMLHttp.open("GET", url, true);// 以get方法通过给定的url打开XMLHTTP对象     
        XMLHttp.send(null);// 向服务器发送HTTP请求，请求内容为空

        // 响应处理函数
        XMLHttp.onreadystatechange = function(){
            // 若是请求成功则在页面显示返回的信息
            if(XMLHttp.readyState == 4 && XMLHttp.status == 200){
                obj = JSON.parse(XMLHttp.responseText);// 将JSON格式的数据解析成数组

                var name = obj.message.goods_name;// 商品名称
                var price = obj.message.goods_price;// 商品价格
                var small_img = obj.message.pics;// 小图片
                var goods_introduce = obj.message.goods_introduce;// 详情介绍

                putInfo(name, price,small_img, goods_introduce);
            }
        }
    }

    // 将商品信息渲染到页面
    function putInfo(name,price,small_img, goods_introduce){
        // 如果请求返回的数据有缺漏，则使用默认的数据而不进行填充   
        if(price)            
            goods_price.innerHTML = price;
        if(name)
            goods_name.innerHTML = name;
        if(small_img.length){
            big_pic.src = small_img[0].pics_mid;
            for(i=0; i < 5; i++){
                small_pic[i].src = small_img[i].pics_mid;
            }
        }
        if(goods_introduce.length)
            detail_content.innerHTML = goods_introduce;
    }  

    
    // 设置商品属性中被点击的按钮的样式
    function exclusive(select){        
        for(var i = 0; i < select.length; i++){
            select[i].onclick = function(){// 点击时指定的元素样式发生改变            
                for(var j = 0; j < select.length; j++){// 先将所有的元素样式清除
                    select[j].className = 's1';
                }
                this.className = 's1 chosen';// 再单独设置指定元素的样式
            }
        }
    }

    // 商品数量的增减
    increse_btn.onclick = function(){
        amount += 1;
        goods_amount.value = amount;
    }
    decrease_btn.onclick = function(){
        if(!amount)
            alert('数量不能为负哦!');
        else
            amount -= 1;
        goods_amount.value = amount;
    }   

    // 点击tab栏切换对应的内容
    for(var i = 0; i < lis.length; i++){
        lis[i].setAttribute('data-index', i)// 给li标签设置自定义属性，用以和原有属性区分，加上“data-”前缀
        lis[i].onclick = function(){
            for(var j = 0; j < lis.length; j++){
                lis[j].className = '';
                cons[j].className  = ' detail_tab detail_initial';// 将所有的“内容”隐藏；
            }
            this.className += ' bg_c';// 添加特定样式
            var index = this.getAttribute('data-index');// 获取当前点击的li标签的序号
            cons[index].className += ' detail_show'// 将指定的div显示出来
        }
    }

    // 封装的ajax函数，用以添加购物车
    // 请求函数，添加购物车
    function addCart(e){
        goods_id = e.dataset.goodsId;// 商品id        
        var goods_amount = document.getElementById("mui_amount_input");// 商品数量
        var amount = parseInt(goods_amount.value);// 转化为数字
        // console.log(amount);
        // ajax对象
        var ajaxGetData={
            method: 'get',
            url: 'API/write_cart_infor_API.php',
            data:{            
                goods_id: goods_id,
                goods_number: amount
            },
            success:function(value){
                if(value==1){
                    // alert('添加成功！');
                    layer.msg('加入购物车成功！', { icon: 1, time: 1200, shade: [0.6, '#000', true] });
                }else if(value == 2)
                    layer.msg('加入失败！', { icon: 2, time: 1500, shade: [0.6, '#000', true] });
                else{
                    layer.msg('请先登录！', { icon: 7, time: 1500, shade: [0.6, '#000', true] });
                    // alert('请先登录！');
                    // var t=setTimeout(window.open('login.php','_self'),3000);
                    // window.open('login.php','_self');
                    setTimeout(function (){                        		
                        // $(button).linkbutton('enable');
                        window.open('login.php','_self');                        
                        }, 3000);
                }

            },
            error:function(value){
                alert(value);
                // console.log(value);
            }
        }

        $ajax(ajaxGetData);
    }

    // 立即购买函数
    function payNow(e){                
        var goods_amount = document.getElementById("mui_amount_input");// 商品数量
        var amount = parseInt(goods_amount.value);// 转化为数字
        btn_addCart.dataset.goodsId = goods_id;
        e.href = "confirmOrder.php?goods_id="  + goods_id  + "&goods_number=" + amount;// 立即购买的连接
        // btn_buyNow.href = "confirmOrder.php?goods_id=" + goods_id + "&goods_number=" + amount;
        
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
    
    exclusive(s1);
    exclusive(s2);
    exclusive(s3);
    if(goods_id)
        getGoodsDetail();
