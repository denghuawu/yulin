<?php 
	include "water.class.php";
	//实例化图像合成类
	$objWeter=new weter;
	//删除之前合成的图片
	$objWeter->delFile('./images/hechen/');
	/////////////////////////
	$a = $_POST['hy_wxmz'];
	$a = $_POST['tm'];
	$bj_path=$_POST['bj_path'];
	$daijg_path=$_POST['daijg_path'];
	$miaoshu=$_POST['miaoshu'];
	$name=$_POST['image_name'];
	//引入核心库文件
	include "2wmscsub.php";
	//定义纠错级别
	$errorLevel = "L";
	//定义生成图片宽度和高度;默认为3
	$size = "4";
	//定义生成内容
	$content="微信公众平台：思维与逻辑";
	//调用QRcode类的静态方法png生成二维码图片
	//QRcode::png($content, false, $errorLevel, $size);
	$url = $a;
	$filename='./images/hechen/'.$name.'.png';
	QRcode::png($url, $filename, $errorLevel, $size);

	//加载图片处理核心文件
	//实例化图像合成类
	$objWeter=new weter;
	//获取背景图片的信息
	$bjArr=$objWeter->getImageInfo($bj_path);
	//缩放背景图片 
	$bj_path=$objWeter->tupiansuofang($bjArr['width'],$bjArr['height'],$bjArr['resource'],'./images/hechen/bj.png',$max=800);
	//获取水印图片的信息
	$syArr=$objWeter->getImageInfo($filename);
	//缩放水印图片的信息
	$filename=$objWeter->tupiansuofang($syArr['width'],$syArr['height'],$syArr['resource'],'./images/hechen/2wm.png',$max=400);
	$bjArr=$objWeter->getImageInfo($bj_path);
	$syArr=$objWeter->getImageInfo($filename);
	//图片合成
	$objWeter->saveWater($bjArr,$syArr,$filename);
	//二次合成
	//获取第一次合成图片的信息
	$bjArr=$objWeter->getImageInfo($filename);
	//获取头像图片的信息
	$syArr=$objWeter->getImageInfo($daijg_path);
	//缩放头像
	$daijg_path=$objWeter->tupiansuofang($syArr['width'],$syArr['height'],$syArr['resource'],'./images/hechen/sy.png',$max=50);
	//获取缩放后的头相信息
	$syArr=$objWeter->getImageInfo($daijg_path);
	//图片再合成
	$objWeter->saveWater($bjArr,$syArr,$filename,1);


	//添加文字信息
	$sPath=$filename;
	$str=$miaoshu;
	$objWeter->xieruwenzi($sPath,$str);


	//删除图片
	$objWeter->delFile('./images/hechen/');


