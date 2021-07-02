//修改密码

var number = 0;
var name = new Array();
var ps = new Array();

function next_step() {

    $.ajax({
        async:false,
        type: "post", //以post方式传输数据
        url: "API/require_user_info.php",//数据目的地和值
        data : {},
        dataType : 'json',
        success: function(data) {
            number = data.data.length;
            for (var j=0;j<number;j++)
            {
                name[j] = data.data[j].name;
                ps[j] = data.data[j].password;
            }
        }
    });

    var x = document.getElementById("old_ps").value;
    for (var i=0;i<number;i++)
    {
        var content =
            "<div class='layui-form-item' id='new_password'>"
              +"<label class='layui-form-label'>"+"新密码"+"</label>"
              +"<div class='layui-input-block'>"
                 +"<input type='password' id='new_ps' name='new_ps' lay-verify='title' autocomplete='off' placeholder='请输入新密码' class='layui-input'>"
              +"</div>"
            +"</div>"
            +"<button type='button' id='button1' name='button1' class='layui-btn' lay-submit='' onclick='modify()'>"+"修改"+"</button>"
        if (x == '')
            layer.msg('请输入原密码！', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
        else
            if (x != ps[i])
                layer.msg('密码错误！', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
            else
                {
                    $("#old_password").remove();
                    $("#button").remove();
                    $("#right_frame").append(content);
                }
    }
}

function modify() {

    var k = document.getElementById("new_ps");
    var x = k.value;
    var l = x.length;
    for (var i=0;i<number;i++)
    {
        if (x == '')
        {
            layer.msg('请输入新密码！', { icon: 2, time: 1000, shade: [0.6, '#000', true] });
            k.focus();
        }
        else
            if (l < 6)
            {
                layer.msg('密码不能小于六位！', { icon: 7, time: 1000, shade: [0.6, '#000', true] });
                k.focus();
            }
            else
                {
                    $.ajax({
                        async:false,
                        type: "post", //以post方式传输数据
                        url: "API/update_user_info.php",//数据目的地和值
                        data : {password:x},
                        dataType : 'text',
                        success: function(data) {

                        }
                    });
                    layer.msg('修改成功！', { icon: 1, time: 1500, shade: [0.6, '#000', true] });
                    setTimeout(function(){
                        window.location.href = "login.php";
                    }, 1500);
                }
    }

}