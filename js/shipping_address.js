//收货地址

var numb = 0;
var addr = new Array();
var received_people = new Array();
var tel = new Array();
var postcode = new Array();
var number1 = new Array();
var number2 = 0;

var add_addr = '';

$(function () {

    layui.use('form', function(){
        var form = layui.form; //部分表单元素自动修饰成功
        form.render('select'); //渲染select
        form.on('select(address)', function(data){
            var addr1 = document.getElementById("address");
            var consignee1 = document.getElementById("consignee");
            var tel1 = document.getElementById("phone");
            var post1 = document.getElementById("post");
            if (data.value != '添加新地址')
            {
                addr1.value = addr[data.value];
                addr1.title = addr[data.value];
                consignee1.value = received_people[data.value];
                tel1.value = tel[data.value];
                post1.value = postcode[data.value];
                number2 = number1[data.value];

                //$("#big_frame").append("<?php include 'update_received_info.php'?>");
            }
            else
            {
                add_addr = data.value;
                addr1.value = '';
                addr1.title = '';
                consignee1.value = '';
                tel1.value = '';
                post1.value = '';
                //$("#big_frame").append("<?php include 'insert_received_info.php'?>");
            }
        });
        form.on('submit(demo1)', function(data){
            // console.log(data.elem) //被执行事件的元素DOM对象，一般为button对象
            // console.log(data.form) //被执行提交的form对象，一般在存在form标签时才会返回
            // console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
            var address = data.field.address;
            var person = data.field.consignee;
            var tel = data.field.phone;
            var post = data.field.post;
            var sele2 = document.getElementById("sele").value;
            var addr1 = document.getElementById("address").value;
            var person1 = document.getElementById("consignee").value;
            var tel1 = document.getElementById("phone").value;
            var post1 = document.getElementById("post").value;

            if (sele2 == '添加新地址')
            {
                if (addr1 == '')
                    layer.msg('收货地址不能为空', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
                else
                    if (person1 == '')
                        layer.msg('收货人不能为空', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
                    else
                        if (tel1 == '')
                            layer.msg('电话不能为空', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
                        else
                            if (post1 == '')
                                layer.msg('邮政编码不能为空', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
                            else
                            {
                                $.ajax({
                                    async: false,
                                    type: "post", //以post方式传输数据
                                    url: "API/insert_received_info.php",//数据目的地和值
                                    data: {address:address,person:person,tel:tel,post:post},
                                    dataType: 'text',
                                    success: function (data) {
                                        if (data == 200)
                                            console.log('insert success');
                                    }
                                });
                                layer.msg('添加成功！', { icon: 1, time: 1000, shade: [0.6, '#000', true] });
                            }
            }
            else
            {
                if (addr1 == '')
                    layer.msg('收货地址不能为空', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
                else
                    if (person1 == '')
                        layer.msg('收货人不能为空', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
                    else
                        if (tel1 == '')
                            layer.msg('电话不能为空', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
                        else
                            if (post1 == '')
                                layer.msg('邮政编码不能为空', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
                            else
                            {
                                $.ajax({
                                    async: false,
                                    type: "post", //以post方式传输数据
                                    url: "API/update_received_info.php",//数据目的地和值
                                    data: {number:number2,address:address,person:person,tel:tel,post:post},
                                    dataType: 'text',
                                    success: function (data) {
                                        if (data == 200)
                                            console.log('update success');
                                    }
                                });
                                layer.msg('修改成功！', { icon: 1, time: 1000, shade: [0.6, '#000', true] });
                            }
            }
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });
    });

    for (var i=0;i<numb;i++)
        show_address(i);

    //获取数据库信息
    $.ajax({
        async: false,
        type: "post", //以post方式传输数据
        url: "API/require_shipping_address_info.php",//数据目的地和值
        data: {},
        dataType: 'json',
        success: function (data) {
            numb = data.data.length;
            for (var i=0;i<numb;i++)
            {
                number1[i] = data.data[i].numb;
                addr[i] = data.data[i].received_addr;
                received_people[i] = data.data[i].received_people;
                tel[i] = data.data[i].received_tel;
                postcode[i] = data.data[i].postcode;
            }
        }
    });

});

//显示已有收货地址
function show_address(numb1) {
    if (numb1 == 0)
        var content="<option value='"+numb1+"' id='s"+numb1+"'>"+addr[numb1]+"</option>";
    else
        var content="<option value='"+numb1+"' id='s"+numb1+"'>"+addr[numb1]+"</option>";
    $(content).appendTo("select");
}

// 返回上一个页面
function return1() {
    window.location.href="javascript:history.go(-1)";
}
// function modify() {
//     var addr1 = document.getElementById("address").value;
//     var consignee1 = document.getElementById("consignee").value;
//     var tel1 = document.getElementById("phone").value;
//     var post1 = document.getElementById("post").value;
//     $.ajax({
//         async: false,
//         type: "post", //以post方式传输数据
//         url: "API/update_received_info.php",//数据目的地和值
//         data: {number:number2,addr:addr1,consignee:consignee1,tel:tel1,post:post1},
//         dataType: 'text',
//         success: function (data) {
//             if (data=200){
//                 location.reload();
//             }
//         }
//     });
// }