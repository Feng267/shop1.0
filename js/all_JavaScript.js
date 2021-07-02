window.onload=function(){
    try {// 抑制错误     
    
        var wrap=document.getElementById('wrap'),
        pic=document.getElementById('pic').getElementsByTagName('li'),
        list=document.getElementById('list').getElementsByTagName('li'),
        index=0,
        timer=null;

        // 定义并调用自动播放函数
        timer = setInterval(autoPlay, 3000);

        // 鼠标划过整个容器时停止自动播放
        wrap.onmouseover = function () {
            clearInterval(timer);
        }

        // 鼠标离开整个容器时继续播放至下一张
        wrap.onmouseout = function () {
            timer = setInterval(autoPlay, 3000);
        }
        // 遍历所有数字导航实现划过切换至对应的图片
        for (var i = 0; i < list.length; i++) {
            list[i].onmouseover = function () {
                clearInterval(timer);
                index = this.innerText - 1;
                changePic(index);
            };
        };

        function autoPlay () {
            if (++index >= pic.length) index = 0;
            changePic(index);
        }

        // 定义图片切换函数
        function changePic (curIndex) {
            for (var i = 0; i < pic.length; ++i) {
                pic[i].style.display = "none";
                list[i].className = "";
            }
            pic[curIndex].style.display = "block";
            list[curIndex].className = "on";
        }
    } catch (error) {
            // console.log(error);
    }

};

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





    
 
