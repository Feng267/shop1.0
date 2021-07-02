var all_data;
//获得所有分类放到all_data里
$.ajax({
    type: "GET", //以get方式传输数据
    url: " https://api-hmugo-web.itheima.net/api/public/v1/categories", //API接口
    dataType: "json",
    success: function(data) {
        all_data = data; //将数据保存到all_data
    },
    error: function(jqXHR) {
        alert('网络太卡了？访问太频繁了？反正就是出错了，数据没有拿到');
    }
});

$("#all_select").mouseover(effect('#select_cat1', '#select_cat2', '#select_cat3')); //将三个select的ID存放到三个变量里面

//实现动态修改二级三级select标签内容
function effect(select1, select2, select3) {

    //这是用来，当选择了一级分类之后，输出一级分类的子类，也就是二级分类
    var first_cat = ""; //保存一级分类的选择
    $(select1).change(function(event) {
        var obj = $(this).find("option:selected"); //获得选择的类;  通过obj.val()可以获得value的值

        first_cat = obj.val();
        var selected_cid = all_data.message[first_cat].children //将一级分类的子类存放进selected_cid

        $(select2).empty(); //清空二级分类，不然每点一次都循环添加一遍数据越来越多
        $(select2).append('<option>' + '请选择二级分类' + '</option>') //向二级分类添加一个option
        $(select3).empty(); //弥补一下显示bug，清空三级分类
        $(select3).append('<option>' + '请选择三级分类' + '</option>') //向三级分类添加一个option

        //循环输出一级分类下的二级分类
        for (var i = 0; i < selected_cid.length; i++) {
            $(select2).append('<option value="' + i + '">' + selected_cid[i].cat_name + '</option>')
        }
    })

    //这是用来，当选择了二级分类之后，输出二级分类的子类，也就是三级分类
    var second_cat = ""; //保存二级分类的选择
    $(select2).change(function(event) {
        var obj = $(this).find("option:selected"); //获得选择的类;  通过obj.val()可以获得value的值

        second_cat = obj.val();
        var selected_cid = all_data.message[first_cat].children[second_cat].children //将二级分类的子类存放进selected_cid

        $(select3).empty(); //清空三级分类，不然每点一次都循环添加一遍数据越来越多
        $(select3).append('<option>' + '请选择三级分类' + '</option>') //向三级分类添加一个option

        //循环输出二级分类下的三级分类
        for (var i = 0; i < selected_cid.length; i++) {
            $(select3).append('<option value="' + selected_cid[i].cat_id + '">' + selected_cid[i].cat_name + '</option>')
        }
    })
}
