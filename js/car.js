var j = 0;
var goods_price = new Array(); //数据库商品价格
var goods_name = new Array();  //数据库商品名称
var goods_img = new Array();   //数据库商品图片
var goods_id = new Array();    // 商品id
var goodsId1 = new Array();
var goods_total_price = new Array();  //数据库商品总价格
var goods_surplus = new Array(); //数据库商品剩余数量
var goods_amount = 0;    //计数
var Itemnumber = 0;  //商品数量
var SPNB = 0;
var total_price = 0;//总价
var subtotal_price = 0;  //小计

var k = 0;  //函数Select的变量
var select1 = new Array();

var goods_height = 0;
var index_height = 0;
var goods_font_height = 0;
var navigation_height = 0;
var scrollHeight = 0;
var see_Height = 0;
var settlement = 0;
var move_height = 0;
var all_height = 0;
var see_Height1 = 0;
var rayState_Height = 0;

    $(document).ready(function(){
    //获取数据库信息
    $.ajax({
        async:false,
        type: "post", //以post方式传输数据
        url: "API/require_cart_info.php",//数据目的地和值
        data : {},
        dataType : 'json',
        success: function(data) {
            goods_amount = data.data.length;
            for (j=0;j<goods_amount;j++)
            {
                goods_id[j] = data.data[j].goods_id;// 获取商品id
                goods_img[j] = data.data[j].goods_pic;    //获取数据库shop_cart_info表的图片
                goods_price[j] = "￥"+data.data[j].goods_prise; //获取数据库shop_cart_info表的价格
                goods_name[j] = data.data[j].goods_name;  //获取数据库shop_cart_info表的标题
                goodsId1[j] = data.data[j].numb;
                goods_surplus[j] = data.data[j].goods_number; //获取数据库shop_cart_info表的商品数量
                goods_total_price[j] = data.data[j].total_price; //获取数据库shop_cart_info表的商品总价
            }
            
        }
    });

    //如果数据库没有商品
    if (goodsId1==null || goodsId1==0)
    {
        $('#navigation').attr('style','display:block');
        $('#background').attr('style','display:block');
        $('#test1').attr('style','display:block');
        $('#cart_title').attr('style','display:block');
        $('#jiesuan').attr('style','display:block');
        $('#rayState').attr('style','display:block; position:absolute; bottom:0');
        $('#background').show();    //显示背景
        $('#cart_title').hide();  //全部商品字样隐藏
        $('#navigation').hide();    //导航隐藏
        $('#jiesuan').hide();    //结算隐藏
    }
    else
    {
        // $('#cart_title').style.display='block';
        // $('#background').style.display='block';
        // $('#test1').style.display='block';
        // $('#navigation').style.display='block';
        // $('#jiesuan').style.display='block';

        $('#navigation').attr('style','display:block');
        $('#background').attr('style','display:block');
        $('#test1').attr('style','display:block');
        $('#cart_title').attr('style','display:block');
        for (j=0;j<goods_amount;j++)
        {
            addItem(j);
        }        
        // 购物车商品数量太少，也会发生底部说明栏不在页面底部的问题
        if(see_Height1-all_height >= rayState_Height)
            $('#rayState').attr('style','display:block; position:absolute;bottom:0');
        else
            $('#rayState').attr('style','display:block; position:none;');
        if (see_Height1 < all_height) {
            $('#jiesuan').attr('style', 'position: fixed;bottom: 0;background:white;display:block');
        }
    }
})

//页面加载完成时执行
$(function(){

    goods_height = document.getElementById("test1").offsetHeight;  //商品条目高度
    index_height = document.getElementById("big_top_bar").offsetHeight;  //首页导航栏高度
    goods_font_height = document.getElementById("cart_title").offsetHeight;  //全部商品字样高度
    navigation_height = document.getElementById("navigation").offsetHeight;  //商品导航栏高度
    settlement = document.getElementById("jiesuan").offsetHeight; //结算栏高度
    rayState_Height = document.getElementById("rayState").offsetHeight; //法律条文高度
    all_height = goods_height+index_height+goods_font_height+navigation_height+settlement+5;
    see_Height1 = document.documentElement.clientHeight;  //浏览器可视部分高度
    if(see_Height1-all_height >= rayState_Height)
        $('#rayState').attr('style','display:block; position:absolute;bottom:0');
    else
        $('#rayState').attr('style','display:block; position:none;');
    if (see_Height1 >= all_height)
    {
        $('#jiesuan').attr('style','position:none;background:white;display:block');
        if (goodsId1==null || goodsId1==0)
        {
            $('#background').show();    //显示背景
            $('#cart_title').hide();  //全部商品字样隐藏
            $('#navigation').hide();    //导航隐藏
            $('#jiesuan').hide();    //结算隐藏
        }
    }

    //页面滚动时执行
    window.onscroll = function()
    {
        scrollHeight = document.documentElement.scrollTop + document.body.scrollTop;  //滚动条滚动高度
        see_Height = document.documentElement.clientHeight;  //浏览器可视部分高度
        move_height = scrollHeight+see_Height;

        //判断滚动条滚动高度加上浏览器可视高度是否大于等于商品条目加上导航栏等高度
        if (Itemnumber != 0)
        if (move_height >= all_height)
        {
            $('#jiesuan').attr('style','position:none;background:white;display:block'); //如果大于等于，清除固定窗口底部样式
        }
        else
        {
            $('#jiesuan').attr('style','position: fixed;bottom: 0;background-color:white;display:block'); //如果小于，给予固定窗口底部样式
        }
    }
});

//点击按钮增加数量
function increment(goodsId)
{
    var new_num=parseInt($("#number"+goodsId).val())+1;
    // alert(goodsId);
    if (new_num<=100)
    {
        $("#number"+goodsId).val(new_num);
        itemPrice(goodsId);
        //获取页面信息更新数据库数据
        $.ajax({
            async:false,
            type: "post", //以post方式传输数据
            url: "API/update_cart_info.php",//数据目的地和值
            data : {goodsId:goodsId1[goodsId],goodsNumber:new_num,total_price1:subtotal_price},
            dataType : 'text',
            success: function(data) {
                if (data == 200)
                {
                    console.log('传参成功');
                }
            }
        });
    }
    Alljs();   //重新计算价格
}

//点击按钮减少数量
function crement(goodsId)
{
    var new_num=parseInt($("#number"+goodsId).val())-1;
    if(new_num>=1)
    {
        $("#number"+goodsId).val(new_num);
        itemPrice(goodsId);

        //获取页面信息更新数据库数据
        $.ajax({
            async:false,
            type: "post", //以post方式传输数据
            url: "API/update_cart_info.php",//数据目的地和值
            data : {goodsId:goodsId1[goodsId],goodsNumber:new_num,total_price1:subtotal_price},
            dataType : 'text',
            success: function(data) {
                if (data == 200)
                {
                    console.log('传参成功');
                }
            }
        });
    }
    Alljs();  //重新计算价格
}

//删除选中的商品
function selectremove()
{
    for(i=0;i<goods_amount;i++)
    {
        if($('#SELE'+i).is(':checked'))
        {
            $("#cart_item"+i).remove();
            Itemnumber=Itemnumber-1;
            //alert(Itemnumber);
            if(Itemnumber==0)
            {
                $('#background').show();
                $("#SPnumber").text("已选择0件商品");
                $("#zongjia").text("￥0");
                $('#cart_title').hide();
                $('#navigation').hide();
                $('#jiesuan').hide();
            }

            //获取页面信息返回删除数据库数据
            $.ajax({
                async:false,
                type: "post", //以post方式传输数据
                url: "API/remove_cart_info.php",//数据目的地和值
                data : {goodsId:goodsId1[i]},
                dataType : 'text',
                success: function(data) {
                    if (data == 200)
                    {
                        console.log('传参成功');
                    }
                }
            });
        }
    }
    layer.msg('删除成功！', { icon: 1, time: 1500, shade: [0.6, '#000', true] });    
    $('#rayState').attr('style','display:block; position:absolute; bottom:0');
    $("#SPnumber").text("已选择0件商品");
    $("#zongjia").text("￥0.00");
    // setTimeout(function (){                        		
    //     // $(button).linkbutton('enable');
    //     location.reload();                        
    //     }, 1600);
    
}

// 计算小计的内容
function itemPrice(goodsId)
{
    var amount=parseInt($("#number"+goodsId).val());
    var jia=$("#item_danjia"+goodsId).text().replace("￥","");

    var xiaoji=jia*amount;     //计算总价格
    subtotal_price = xiaoji;

    $("#item_xiaoji"+goodsId).text("￥"+xiaoji.toFixed(2));
}

// 删除一条商品
function removeItem(goodsId){
    $("#cart_item"+goodsId).remove();
    Itemnumber=Itemnumber-1;
    //alert(Itemnumber);
    if(Itemnumber==0){

        $('#rayState').attr('style','display:block; position:absolute;bottom:0');
        $('#background').show();
        $("#SPnumber").text("已选择0件商品");
        $("#zongjia").text("￥0.00");
        $('#cart_title').hide();
        $('#navigation').hide();
        $('#jiesuan').hide();
    }
    layer.msg('删除成功！', { icon: 1, time: 1500, shade: [0.6, '#000', true] });   
    if (see_Height1 < all_height) {
        $('#jiesuan').attr('style', 'position: none;background:white;display:block');
    }
    else
        $('#jiesuan').attr('style', 'position: none;background:white;display:block'); 
    setTimeout(function (){                        		
        // $(button).linkbutton('enable');
        location.reload();                        
        }, 1000);
    //获取页面信息返回删除数据库数据
    $.ajax({
        async:false,
        type: "post", //以post方式传输数据
        url: "API/remove_cart_info.php",//数据目的地和值
        data : {goodsId:goodsId1[goodsId]},
        dataType : 'text',
        success: function(data) {
            if (data == 200)
            {
                console.log('传参成功');
            }
        }
    });
    $("#zongjia").text("总价：￥"+total_price.toFixed(2));
    Alljs();
}

//全选
function allSelect()
{
    /*if ($("input[type='checkbox']").prop("checked"))
    {
        //如果处于全选状态则取消全选
        $("input[type='checkbox']").prop("checked",false);
        $("#zongjia").text("总价：￥"+total_price.toFixed(2));
        console.log($("input[type='checkbox']").val());
    }
    else
    {
        for (var i=0;i<Itemnumber;i++)
        {
            if ($("input[id='SELE"+i+"']").prop("checked"))
            {
                //$("input[type='checkbox']").prop("checked",true);
            }
            else
            {
                $("input[type='checkbox']").prop("checked",true);
            }
        }
    }*/
    for (var i=0;i<Itemnumber;i++)
    {
        if ($("input[id='SELE"+i+"']").prop("checked")==false)
        {
            $("input[id='SELE"+i+"']").prop("checked",true);
        }
        else
            k = k+1;
        if (k == Itemnumber)
        {
            for (var j=0;j<Itemnumber;j++)
                $("input[id='SELE"+j+"']").prop("checked",false);
            k = 0;
        }

    }
    Alljs();
}

//单选
function Select() {
    for (var i=0;i<goods_amount;i++)
    {
        if($('#SELE'+i).is(':checked'))
        {
            $("#zongjia").text("总价：￥"+total_price.toFixed(2));
            k = k+1;
            //select1[i] = i;
        }
        else
        {
            $("#zongjia").text("总价：￥"+total_price.toFixed(2));
            $("input[id='box']").prop("checked",false);
        }
        if ($("input[id='SELE"+i+"']").is("checked"))
        {
            $("input[id='box']").prop("checked",true);
        }
        else
            $("input[id='box']").prop("checked",false);
        Alljs();
    }
    if (k == Itemnumber)
        $("input[id='box']").prop("checked",true);
    k = 0;
}


//全删
function allremove(){
    for(var i=0;i<Itemnumber;i++){
        $("#cart_item"+i).remove();

        //获取页面信息返回删除数据库数据
        $.ajax({
            async:false,
            type: "post", //以post方式传输数据
            url: "API/remove_cart_info.php",//数据目的地和值
            data : {goodsId:goodsId1[i],goodsImg:goods_img[i],goodsName:goods_name[i],goodsPrice:goods_price[i]},
            dataType : 'text',
            success: function(data) {
                if (data == 200)
                {
                    console.log('传参成功');
                }
            }
        });
    }
    $('#background').show();
    $("#SPnumber").text("已选择0件商品");
    $("#zongjia").text("￥0");
    $('#cart_title').hide();
    $('#navigation').hide();
    $('#jiesuan').hide();
}

//添加一条商品到购物车
function addItem(goodsId){

    //判断是否有这个商品
    var list = $("#test1").find("#cart_item"+goodsId);
    if(list.length > 0)
    {
        increment(goodsId);
    }
    else
    {
        $('#cart_title').show();
        $('#navigation').show();
        $('#jiesuan').show();
        $('#background').hide();
        var cart_item_id="cart_item"+goodsId;   //购物车项目的id
        var title = goods_name[goodsId];      //商品名称
        Itemnumber=Itemnumber+1;

        var img_url = goods_img[goodsId];

        //img_url = img_url.split("(")[1].replace(")","");
        jiage = goods_price[goodsId];
        var price = goods_total_price[goodsId];

        var content="<div class='cart_item' id='"+cart_item_id+"'>"
            +"<div class='cart_item_select'>"
            +"<div class='select_cd'><input id='SELE"+goodsId+"' type='checkbox' onclick='Select()' ></div>"
            +"<div class='cart_item_image'><img class='item_image' id='item_img"+goodsId+"' src="+img_url+"> </div>"

            +"</div>"
            +"<div class='item_shangpin'>"
            +title
            +"</div>"
            +"<div class='item_danjia' id='item_danjia"+goodsId+"'>"
            +jiage
            +"</div>"
            +"<div class='item_shuliang'>"
            +"<input class='crement' type='button' value='-' onclick='crement("+goodsId+");'><input class='number' id='number"+goodsId+"' type='text' value='"+goods_surplus[goodsId]+"' disabled='true'><input class='increment' type='button' value='+' onclick='increment("+goodsId+");'>"
            +"</div>"
            +"<div class='item_xiaoji' id='item_xiaoji"+goodsId+"'>"
            +"￥"+price
            +"</div>"
            +"<div class='caozuo'>"
            +"<a href='javascript:removeItem("+goodsId+");'>删除</a>"
            +"</div>"
            +"</div>";
        $("#test1").append(content);
    }
}

//价格统计
function Alljs()
{
    for(i=0;i<goods_amount;i++){
        var test5=parseInt($("#number"+i).val());
        if($('#SELE'+i).is(':checked')&&test5>1){
            SPNB=SPNB+parseInt($("#number"+i).val());
            SPNB=SPNB-1;
        }
    }

    if($('#box').is(':checked'))
    {
        var amount=$("input[type='checkbox']:checked").length-1+SPNB;
    }
    else
    {
        var amount=$("input[type='checkbox']:checked").length+SPNB;
    }

    $("#SPnumber").text("已选择"+amount+"件商品");
    for(var i=0;i<goods_amount;i++){

        if($('#SELE'+i).is(':checked')){
            var test4=$("#item_xiaoji"+i).text();
            test4 = test4.split("￥")[1];

            total_price=total_price+parseFloat(test4);   //计算总价格

            $("#zongjia").text("总价：￥"+total_price.toFixed(2));
        }
    }
    total_price=0;
    SPNB=0;

}

var goods_price1 = new Array();  //商品价格
var goods_name1 = new Array();  //商品名称
var goods_total_price1 = new Array();  //商品总价
var goods_amount1 = new Array();  //商品数量
var goods_img1 = new Array();   //商品图片

//去支付
function Pay()
{
    goods_img1 = [];
    goods_name1 = [];
    goods_price1 = [];
    goods_amount1 = [];
    goods_total_price1 = [];
    let select_index = 0;
    //如果一个商品都没选择
    if (!$("input[type='checkbox']").is(':checked'))
        layer.msg('您还没有选择需要购买的商品！', { icon: 7, time: 1500, shade: [0.6, '#000', true] });
    else
    {
        var j = 0;
        for (var i=0;i<Itemnumber;i++)
        {
            if ($("input[id='SELE"+i+"']").is(":checked"))
            {
                goods_img1[j] = document.getElementById("item_img"+i).src;
                goods_name1[j] = goods_name[i];
                goods_price1[j] = goods_price[i].split("￥")[1];
                goods_amount1[j] = document.getElementById("number"+i).value;
                goods_total_price1[j] = goods_total_price[i];
                j = j + 1;
                select_index = i;// 选中的是第几个
            }
        }
        // console.log(select_index, goods_id[select_index], total_price, subtotal_price,goods_total_price1,total_price.toFixed(2),goods_amount1[0]);
        let new_url = "confirmOrder.php?goods_id=" + goods_id[select_index] + "&goods_number=" +  goods_amount1[0] + "&isCart=1";
        // console.log(new_url);
        window.location.href= new_url;  //跳转到支付页面
    }
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
