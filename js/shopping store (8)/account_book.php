<!DOCTYPE html>
<html>
<?php
  include "verify.php";
?>
<head>
  <meta charset="utf-8">
  <title>用户列表</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!-- 引入jq，辅助layui运行ajax -->
  <script src="jquery/jquery-3.5.1.min.js"></script>
</head>
<style>
  * {
    margin: 0px;
    padding: 0px;
  }
  #bookmark{
    float:right;
    width: 20px;
    height: 20px;
    margin: -10px -12px 0px 0px;
  }
  #img_div img{
    width: 50px;
    height: 50px;
  }
  .mydate {
    margin: 13px 0px 12px 0px;
    border-top: 0.5px solid rgb(207, 207, 207);
    font-size: 12px;
    color: rgb(207, 207, 207);
    text-align: right;
  }

  ol {
    list-style: none;
  }

  ol li a {
    cursor: pointer;
    text-decoration: none;
    color: black;
  }

  ol li a:hover {
    cursor: pointer;
    text-decoration: none;
    color: black;
  }
  #ol4 li{
    width: 176px;
    float: left;
  }
  .little_icon {
    width: 8px;
    height: 8px;
    margin: 5px 10px 0px 10px;
    border-radius: 2px;
    float: left;
  }
  .little_icon1{ background-color: rgb(255, 0, 0);}
  .little_icon2{ background-color: rgb(255, 208, 0);}
  .little_icon3{ background-color: rgb(0, 255, 0);}
  .little_icon4{ background-color: rgb(0, 217, 255);}
  .little_icon5{ background-color: rgb(55, 0, 255);}
  .little_icon6{ background-color: rgb(247, 0, 255);}
  .little_icon7{ background-color: rgb(22, 21, 21);}

  /* day week month season 的缩写*/
  .dwms {
    width: 210px;
    height: 525px;
    margin: 0px 2px 0px 2px;
    background-color: skyblue;
    float: left;
  }

  .shadow1 {
    box-shadow: 2px 6px 7px rgb(175, 175, 175);
    opacity: 0.3;
    border-radius: 3px;
  }
  
  /*日期选择控件的css*/
  #all_select{
    border-bottom: 0.5px solid rgb(207, 207, 207);;
  }
  #all_select input {
            height: 31px;
            width: 176px;
            border: 1px solid black;
            border-radius: 5px;
        }
  .date {
      display: inline-block;
      width: 0px;
      font-size: 20px;
  }
  #search_btn{
      height: 30px;
      width: 250px;
      border: 1px solid black;
      border-radius: 20px;
      margin: 10px 0px 10px 60px;
      background-color: #fff;
      box-shadow: 1px 1px 5px black;
  }
  #search_btn:hover{
      background-color: rgb(230, 227, 227);
  }
  ::-webkit-datetime-edit {
      padding-left: 12px;
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
      margin: 0px 5px 0px 2px;
      color: #666;
      cursor: pointer;
  }

  ::-webkit-clear-button {
      /*控制清除按钮*/
      margin-bottom: 3px;
      cursor: pointer;
  }
  #animation1 {
    opacity: 0;
    animation: bounceInDown 0.5s;
    animation-fill-mode: both;
  }

  #animation2 {
    animation: bounceInDown 1s;
    animation-fill-mode: both;
  }

  #animation3 {
    animation: bounceInDown 1.5s;
    animation-fill-mode: both;
  }

  #animation4 {
    animation: bounceInDown 2s;
    animation-fill-mode: both;
  }

  #animation5 {
    animation: showup 2s;
    animation-fill-mode: both;
    width: 389px;
    height: 525px;
    margin: 0px 2px 0px 2px;
    float: left;
  }

  @keyframes bounceInDown {
    0% {
      opacity: 0;
      transform: translateY(-10px);
    }

    20% {
      opacity: 0.7;
      transform: translateY(900px);
    }

    40% {
      opacity: 0.8;
      transform: translateY(-5px);
    }

    50% {
      opacity: 1;
      transform: translateY(40px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  @keyframes showup {
    0% {
      opacity: 0;
    }

    20% {
      opacity: 0;
    }

    90% {
      opacity: 0.8;
    }

    100% {
      opacity: 1;
    }
  }
</style>

<body>

  <div id="animation1" class="shadow p-3 mb-5 bg-white rounded dwms">
    <div><b>本日：</b><img id="bookmark" src="images/bookmark1.png"></div>
    <div id="this_day" class="mydate"></div>
    <div>
      <ol id="ol3">
      </ol>
    </div>
  </div>
  <div id="animation2" class="shadow p-3 mb-5 bg-white rounded dwms">
    <div><b>本周：</b><img id="bookmark" src="images/bookmark1.png"></div>
    <div id="this_week" class="mydate"></div>
    <div>
      <ol id="ol2">
      </ol>
    </div>
  </div>
  <div id="animation3" class="shadow p-3 mb-5 bg-white rounded dwms">
    <div><b>本月：</b><img id="bookmark" src="images/bookmark1.png"></div>
    <div id="this_month" class="mydate"></div>
    <div>
      <ol id="ol1">
      </ol>
    </div>
  </div>
  <div id="animation4" class="shadow p-3 mb-5 bg-white rounded dwms">
    <div><b>本季度：</b><img id="bookmark" src="images/bookmark1.png"></div>
    <div id="this_season" class="mydate"></div>
    <div>
      <ol id="ol0">
      </ol>
    </div>
  </div>
  <div id="animation5" class="shadow p-3 mb-5 bg-white rounded">
    <div><b>其他时间：</b><img id="bookmark" src="images/bookmark1.png"></div>
    <div id="" class="mydate"></div>
    <div id="all_select">
      <!--搜索日期区间-->
      <input type="date" id="start_date">
      <input type="date" id="end_date">
      <button id="search_btn" type="button">Search</button>
    </div>
    <div>
      <ol id="ol4">
      </ol>
    </div>
    <div id="img_div">
      <img src="images\dragon_blue.png">
      <img src="images\dragon_green.png">
      <img src="images\dragon_lightgreen.png">
      <img src="images\dragon_longgreen.png">
      <img src="images\dragon_pink.png">
    </div>
  </div>
  <script>


    //日期格式化，返回值形式为yy-mm-dd
    function timeFormat(date) {
      if (!date || typeof (date) === "string") {
        this.error("参数异常，请检查...");
      }
      var y = date.getFullYear(); //年
      var m = date.getMonth() + 1; //月
      var d = date.getDate(); //日

      return y + "-" + m + "-" + d + " " + "00:00:00";
    }

    //获取这周的周一
    function getFirstDayOfWeek(date) {

      var weekday = date.getDay() || 7; //获取星期几,getDay()返回值是 0（周日） 到 6（周六） 之间的一个整数。0||7为7，即weekday的值为1-7
      date.setDate(date.getDate() - weekday + 1);//往前算（weekday-1）天，年份、月份会自动变化
      return timeFormat(date);
    }

    //获取当月第一天
    function getFirstDayOfMonth(date) {
      date.setDate(1);
      return timeFormat(date);
    }

    //获取当季第一天
    function getFirstDayOfSeason(date) {
      var month = date.getMonth();
      if (month < 3) {
        date.setMonth(0);
      } else if (2 < month && month < 6) {
        date.setMonth(3);
      } else if (5 < month && month < 9) {
        date.setMonth(6);
      } else if (8 < month && month < 11) {
        date.setMonth(9);
      }
      date.setDate(1);
      return timeFormat(date);
    }
    var mydate = new Date;
    var day = timeFormat(mydate);  //获得今天的开始

    //获得现在的时间，在页面显示出来
    var day_now = mydate.getFullYear() + '-' + (mydate.getMonth() + 1) + '-' + mydate.getDate() + ' ' + mydate.getHours() + ':' + mydate.getMinutes() + ':' + mydate.getSeconds();
    var week = getFirstDayOfWeek(mydate);  //获得这周第一天的开始
    var month = getFirstDayOfMonth(mydate);  //获得这月第一天的开始
    var season = getFirstDayOfSeason(mydate);  //获得这季度第一天的开始
    var start_date = null;  //时间区间
    var end_date = null;
    var week2 = mydate.getDay();   //获得星期几
    var weeks = ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"];
    $("#this_day").text(day_now + "," + weeks[week2]);
    $("#this_week").text(week + "~~至今");
    $("#this_month").text(month + "~~至今");
    $("#this_season").text(season + "~~至今");

    //向页面输出后台数据
    function append_ol(id,data) {
      $(id).empty(); //清空，不然越加越多
      $(id).append('<li><div class="little_icon little_icon1"></div><a href="' + '#' + '">销售额：<span>' + data[0] + '</span>元</a></li>');
      $(id).append('<li><div class="little_icon little_icon2"></div><a href="' + '#' + '">已成交：<span>' + data[1] + '</span>笔</a></li>');
      $(id).append('<li><div class="little_icon little_icon3"></div><a href="' + '#' + '">已收货：<span>' + data[2] + '</span>笔</a></li>');
      $(id).append('<li><div class="little_icon little_icon4"></div><a href="' + '#' + '">已付款：<span>' + data[3] + '</span>笔</a></li>');
      $(id).append('<li><div class="little_icon little_icon5"></div><a href="' + '#' + '">未付款：<span>' + data[4] + '</span>笔</a></li>');
      $(id).append('<li><div class="little_icon little_icon6"></div><a href="' + '#' + '">单笔最高：<span>' + data[5] + '</span>元</a></li>');
      $(id).append('<li><div class="little_icon little_icon7"></div><a href="' + '#' + '">单笔最低：<span>' + data[6] + '</span>元</a></li>');
    }

    //监听键盘事件,当点击search按钮时，传输时间区间到后台
    $("#search_btn").click(function(event) {
      var start_date = $("#start_date").val();
      var end_date = $("#end_date").val();
      get_data(day_now, day, week, month, season, start_date, end_date);
    });

    //页面加载就执行ajax函数，获得处理过的数据
    get_data(day_now, day, week, month, season, start_date, end_date);

    function get_data(day_now, day, week, month, season, start_date, end_date) {
      $.ajax({
        type: "get",
        url: "data_control/request_account_API.php?season=" + season + "&month=" + month + "&week=" + week + "&day=" + day + "&day_now=" + day_now + "&start_date=" + start_date + "&end_date=" + end_date,
        dataType: "json",
        success: function (data){
          console.log(data);
          for(var i = 0; i < data.length; i++){
            var ol_id = "#ol" + i;
            append_ol(ol_id,data[i]);
          }
        },
        error: function (data) {


        }
      });
    }

    //

  </script>
</body>

</html>