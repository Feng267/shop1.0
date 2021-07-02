<!DOCTYPE html>
<html>
<?php
  include "verify.php";
?>
<head>
    <meta charset="utf-8">
    <title>商品上新</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="layui/css/layui.css"  media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
  <style>
    table{
        margin: 10px auto;
        border-spacing: .2em;
        border-collapse: separate;
        border-radius: 12px;
    }
    tr{
        height:50px;
        
        border-radius: 4px;
        
    }
    th{
        width:180px;
        font-size: 17px;
        background-color:#a7f6f6;
        border-radius: 4px;
    }
    input{
        width:100px;
        height:30px;
        margin-left: 10px;
        border: 1px solid;
        border-radius: 12px;
    }
    td{
        width:800px;
        background-color: #ffdee9;
        border-spacing: .2em;
        border-collapse: separate;
        border-radius: 12px;
    }
    #goods_name{
        width:669px;
    }
    #goods_pic{
        width: 100px;
    }
    /*图片的样式 */
    #pic_div input{
        height: 27px;
        width: 83px;
        font-size: 17px;
        float: left;
    }
    /*按钮的样式 */
    #btn_div{
        width:500px;
        margin:0px auto;
    }
    .button {
        display: inline-block;
        border-radius: 4px;
        background-color: #a7f6f6;
        border: none;
        color: #FFFFFF;
        text-align: center;
        font-size: 20px;
        width: 200px;
        height: 50px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 20px;
    }
    .button span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.5s;
    }

    .button span:after {
        content: '»';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.5s;
    }

    .button:hover span {
        padding-right: 25px;
    }

    .button:hover span:after {
        opacity: 1;
        right: 0;
    }
    #reset{
        background-color: #f8bdc6;
    }
    #reset span:after {
        content: 'x';
    }
        #all_select{
                width: 1000px;
        }
        #all_select select {
            width: 220px; 
            height: 31px;
            margin-left: 12px;
            padding-left: 12px;
            line-height: 31px;
            font-size: 12px;
            color: #333;
            appearance: icon;
            border: 1px solid #000000;
            border-radius: 30px;
            overflow: hidden;
        }
        option{
            font-size: 14px !important;
        }
</style>
</head>
<body>  

<!--这是页面里的表单-->
<form action="" method="post" enctype="multipart/form-data">
    <table class="" lay-even lay-skin="row " lay-size="sm" id="test3" lay-filter="test3">
    <tbody>
        <tr>
            <th>类型</th>
            <td>
                <!-- 多级分类选择框 -->
                <div id="all_select">
                    <select id="select_cat1">
                        <option>请选择一级分类</option>
                        <option value="0">大家电</option>
                        <option value="4">手机相机</option>
                        <option value="5">电脑办公</option>
                        <option value="1">热门推荐</option>
                        <option value="25">智能设备</option>
                    </select>
                    <select id="select_cat2">
                        <option>先选一级分类</option>
                    </select>
                    <select id="select_cat3" name="cat_id">
                        <option value="">先选二级分类</option>
                    </select>
                </div>
            </td>
        </tr> 
        <tr>
            <th>商品名称</th>
            <td><input name="goods_name" type="text" id="goods_name"></td>
        </tr> 
        <tr>
            <th>商品价格</th>
            <td><input name="goods_price" type="text"></td>
        </tr> 
        <tr>
            <th>商品数量</th>
            <td><input name="goods_number" type="text"></td>
        </tr>
        <tr>
            <th>图片上传</th>
            <td><div id="pic_div"><input type="file" name="file" id="goods_pic"></div></td>
        </tr>
    </tbody>
    </table>
    <div id="btn_div">
        <button class="button" style="vertical-align:middle" name="sub" type="submit"><span>提交</span></button>
        <button class="button" style="vertical-align:middle" id="reset" type="reset" ><span>重置</span></button>
    </div>
</form>

<script>

</script>

<?php
    date_default_timezone_set("Asia/Shanghai");  //设置时间标准为亚洲成都

    if(isset($_POST["sub"]))
    {
        $cat_id = @$_POST["cat_id"];    //类ID
        $goods_name = @$_POST["goods_name"];     //商品名
        $goods_price = @$_POST["goods_price"];   //单价
        $goods_number = @$_POST["goods_number"];   //数量
        $file = @$_FILES['file'];
        $date = date("y-m-d h:i:s");  //时间不输入，默认为中国时间

        $name = $file['name'];
        $type = strtolower(substr($name,strrpos($name,'.')+1)); //得到文件类型，并且都转化成小写
        $allow_type = array('jpg','jpeg','gif','png'); //定义允许上传的类型
        //判断文件类型是否被允许上传
        if(!in_array($type,$allow_type)){
        //如果不被允许，则直接停止程序运行
        echo "<script>alert('错误的类型');</script>";
        return ;
        }

        $upload_path = "../image/goods_pic/"; //商品图片存放的路径
        $pic_path = $upload_path.$file['name']; //图片实际存储的路径

        $true_path = "image/goods_pic/".$file['name'];//存放到数据库里的图片路径

        //从数据库里选择最大商品ID加一，再填进去
        require "data_control/fun.php";
        $sql = "select MAX(goods_id) as id from goods_info";
        $result = mysqli_query($conn,$sql)or die("错误描述: " . mysqli_error($conn));
        $goods_id = mysqli_fetch_assoc($result);
        $goods_id['id'] += 1;
        $goods_id = $goods_id['id'];
        
        //如果图片移动成功，则为true
        $bool1 = move_uploaded_file($file['tmp_name'],$pic_path);
        //如果下列都为真，则向数据库添加新内容
        if($cat_id and $goods_name and $goods_price and $goods_number and $bool1){
            $sql = "INSERT INTO goods_info (goods_id,cat_id,goods_name,goods_price,goods_number,goods_small_logo,date) VALUES($goods_id,$cat_id ,$goods_name,$goods_price,$goods_number,'$true_path','$date')";
            mysqli_query($conn,$sql)or die("错误描述: " . mysqli_error($conn)); 
        }
        else{
            echo "<script>alert('不能输入空值');</script>";
        }
    }
?>
<!-- 注意：如果你直接复制所有代码到本地，js路径需要改成你本地的 -->
<script src="layui/layui.js" charset="utf-8"></script>

<!-- 引入jq，运行ajax,操作select标签 -->
<script src="jquery/jquery-3.5.1.min.js"></script>

<!-- 封装了的一段操作select标签的js代码 -->
<script src="jquery/all_select.js"></script>
</body>
</html>