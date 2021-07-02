<?php
session_start();
//向浏览器输出图片头信息
header('Content-type:image/jpeg');
$width=120;
$height=40;
$string='';//定义变量保存字体，这个一定不能省，不然回报警告
$img=imagecreatetruecolor($width, $height);//imagecreatetruecolor函数建一个真彩色图像
$arr=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
//生成彩色像素    
$colorBg=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));//背景     imagecolorallocate函数为一幅图像分配颜色
//填充函数，xy确定坐标，color颜色执行区域填充颜色
imagefill($img, 0, 0, $colorBg);
/*	可省略
 * $colorBorder=imagecolorallocate($img,rand(200,255),rand(200,255),rand(200,255));//边框
 *imagerectangle($img,0,0,$width-1,$height-1,$colorBorder);
 */
//该循环,循环画背景干扰的点
for($m=0;$m<=100;$m++){
    $pointcolor=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));//点的颜色
    imagesetpixel($img,rand(0,$width-1),rand(0,$height-1),$pointcolor);// 水平地画一串像素点
}
//该循环,循环画干扰直线
for ($i=0;$i<=4;$i++){
    $linecolor=imagecolorallocate($img,rand(0,255),rand(0,255),rand(0,255));//线的颜色
    imageline($img,rand(0,$width),rand(0,$height),rand(0,$width),rand(0,$height),$linecolor);//画一条线段
}
for($i=0;$i<4;$i++){
	$string.=$arr[rand(0,count($arr)-1)];
}
$_SESSION['authcode'] = $string;
$colorString=imagecolorallocate($img,rand(10,100),rand(10,100),rand(10,100));//文本
//2种插入字符串字体的方式
//imgettftext($img,字体大小（数字）,角度（数字）,rand(5,15),rand(30,35),$colorString,'字体样式的路径',$string);
imagestring($img,5,rand(0,$width-36),rand(0,$height-15),$string,$colorString);

//输出图片到浏览器
imagejpeg($img);
//保存图片到本地
//	$file_dir = '/upload/verification_code/';
//	if(!is_dir(PIGCMS_PATH . $file_dir)){
//   	mkdir(PIGCMS_PATH . $file_dir);
//	}
//	$url = $file_dir . '/' . time() . '.png';
//	imagepng($img, PIGCMS_PATH . $url);//保存
//销毁，释放资源
imagedestroy($img);
?>