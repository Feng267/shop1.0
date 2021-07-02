<div class="goods">
    <?php
    session_start();
    require "fun.php";
    $search = @$_GET['search'];
    // $low = random_int(1,1895);// 随机数
    // $sqls="select * from goods_info where numb > 83 and numb < 105";                    //设置sql语句

    if(isset($search)){
        $sqls = "select * from goods_info where goods_big_logo <> '' and goods_price > 0 and goods_name like '%$search%'";// 关键字搜索
        // echo "<script>console.log($sqls)</script>";
    }
        
    else{        
        $low = random_int(1,1795);// 随机数，少点吧，毕竟有些商品图片可能会失效
        $sqls = "select * from goods_info where goods_big_logo <> '' and goods_price > 0 limit $low, 16";// 图片存在且价格不为0
    }
        
    // echo "<script>console.log($low,$high, $sqls)</script>";
    $results=mysqli_query($conn,$sqls);              //执行查询
    $row_total = mysqli_num_rows($results);// 返回商品的数量
    // 未分页前临时测试控制数量
    if($row_total > 32)
        $row_total = 32;
    else if($row_total > 16)
        $row_total = 16;

    // echo "<script>console.log($row_total,'total')</script>";
    for($i=0;$i< $row_total; $i++)
    {
        $row=mysqli_fetch_row($results);
        list($numb,$goods_id,$cat_id,$cat_name,$goods_name, $goods_price,$goods_number,$goods_big_logo, $goods_small_logo, $date)=$row; //获取商品的信息
        echo "
        <div class='goodsCard'>                                             
            <div class='goodsImage'><a href='goods_detail.php?goods_id=$goods_id' style='color: black;'><img src='$goods_small_logo'></a></div>
            <div class='money'>￥$goods_price</div>
            <div class='goodsBrief'>                     <a href='goods_detail.php?goods_id=$goods_id' style='color: black;'>$goods_name</a>
            </div>
            <div class='goodsAdd'>                                          
                <input type='submit' data-goods-id='$goods_id' value='加入购物车' class='addIn add_cart' onClick='addCart(this)'>
                <a href='confirmOrder.php?goods_id=$goods_id'><input type='submit' value='立即购买' class='addIn pay_now'></a>
            </div>
        </div>";
    }
    ?>




</div>

<script src="js/Myajax.js"></script>
<script>

    // var url = location.search;
    // console.log('url:', url);
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
    // console.log(urlAttr);
    // goods_id = 0;

    // 请求函数，添加购物车
    function addCart(e){
        goods_id = e.dataset.goodsId;// 商品id
        // ajax对象
        var ajaxGetData={
            method: 'get',
            url: 'API/write_cart_infor_API.php',
            data:{            
                goods_id: goods_id,
                goods_number: 1
            },
            success:function(value){
                if(value==1){
                    // alert('添加成功！');
                    layerMsg(1);
                    // layer.msg('加入购物车成功！', { icon: 1, time: 1000, shade: [0.6, '#000', true] });
                }else if(value == 2)
                    layerMsg(2);
                    // layer.msg('加入购物车失败！', { icon: 2, time: 1500, shade: [0.6, '#000', true] });
                else{
                    layerMsg(3);
                    // layer.msg('请先登录！', { icon: 7, time: 1000, shade: [0.6, '#000', true] });
                    
                    setTimeout(function (){                        		
                        // $(button).linkbutton('enable');
                        window.open('login.php','_self');                        
                        }, 2500);
                }

                    // alert(value);
                // console.log(value);
                // var order_detail = document.querySelector('.order_detail');// 所有订单
                // console.log(order_detail);
                // var obj = JSON.parse(value);// 将JSON格式的数据解析成数组
                // create_detail_wrap([obj.data][0]);
                // console.log(obj);
                // var order_item = document.createElement('div');// 生成dom元素
                // order_item.className = 'order_item_all';
            },
            error:function(value){
                alert(value);
                // console.log(value);
            }
        }

        $ajax(ajaxGetData);

        // console.log();
    }
    
</script>