var nickname = '';
var sex = '';
var phone = '';
var mailbox = '';
var head_pic = '';

$(function () {

    //获取数据库信息
    $.ajax({
        async: false,
        type: "post", //以post方式传输数据
        url: "API/require_usercenter_info.php",//数据目的地和值
        data: {},
        dataType: 'json',
        success: function (data) {
            nickname = data.data[0].name;
            sex = data.data[0].gender;
            phone = data.data[0].tel;
            mailbox = data.data[0].mailbox;
            head_pic = data.data[0].head_pic;
        }
    });

    update();
});

function update() {
    var head_pic1 = document.getElementById("demo1");
    var nickname1 = document.getElementById("nickname");
    var phone1 = document.getElementById("phone");
    var email1 = document.getElementById("email");
    var sex1 = document.getElementById("sex");
    if (head_pic==null || head_pic=='' || head_pic=="undefined" || head_pic=="")
        head_pic1.src = "./image/head_pic/default.jpg";
    else
        head_pic1.src = head_pic;
    nickname1.value = nickname;
    phone1.value = phone;
    email1.value = mailbox;
    sex1.value = sex;
}

function sex_tips(txt) {
    if (txt.value == '')
    {
        layer.msg('性别不能为空', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
        txt.focus();
    }
    else
        if (txt.value != '男' && txt.value != '女')
        {
            layer.msg('请输入正确的格式', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
            txt.focus();
        }
}

function name_tips(txt) {
    if (txt.value == '')
    {
        layer.msg('昵称不能为空', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
        txt.focus();
    }
}