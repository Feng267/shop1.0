<?php
    include 'fun.php';
    session_start();
    $acc = $_SESSION['acc'];
    $phone = @$_POST['id'];
    $src = array();
    $file=@$_FILES['file'];  // 预定义数组
    $path="../image/head_pic";  //定义存储路径
    $len = strlen($file["name"]); 
    // $file_name=date("Ymd")."." . substr($file["name"], $len-4, 4);  //定义存储文件名
    $file_name=$acc . substr($file["name"], $len-4, 4);  //定义存储文件名
    $file_path=$path."/".$file_name;  //文件存储路径

    $img_name = "image/head_pic/".$file_name;
    //对上传的文件进行判断是否上传成功
    if (move_uploaded_file($file["tmp_name"],$file_path))
    {
        $sql = "UPDATE `user_info` SET `head_pic`='$img_name' where `tel`=$phone";
        mysqli_query($conn,$sql) or die('数据插入失败:'.mysqli_error($conn));
        $j="../image/head_pic".$file_name;
        $src[] = $j;
        exit(json_encode(array('code'=>0,"data"=>$src)));
    }
    else
    {
        exit(json_encode(array('code'=>1,"data"=>$src)));
    }
?>