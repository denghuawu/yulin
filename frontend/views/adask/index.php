<?php 
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Pragma" Content="No-cach">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width,initial-scale=0.5,maximum-scale=0.5,minimum-scale=0.5,user-scalable=no">
	<meta name="MobileOptimized" content="320">
	<meta http-equiv="cleartype" content="on">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta charset="UTF-8">
	<title>广告申请</title>
	<link rel="stylesheet" type="text/css" href="./yulin_home/css/style.css">
	<script type="text/javascript" src="./yulin_home/js/jquery.js"></script>
	<script type="text/javascript" src="./yulin_home/js/public.js"></script>
</head>
<body>
<div class="wrap ad fs30">
	<form action="<?= Url::to(['adask/getdata']) ?>" method="post" enctype="multipart/form-data">
		<ul>
			<li class="clearfix">
				<div class="t">手机号码：</div>
				<div class="c bbd1 tel"><input id="cellphone" type="text" value="" name="cellphone" maxlength="11" onkeyup="value=value.replace(/[^\d]/g,'')"  onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" ><input id="verif" type="button" value="获取验证码"></div>
			</li>
			<li class="clearfix">
				<div class="t">验证码：</div>
				<div class="c bbd1"><input type="text" value="" name="verif"></div>
			</li>
			<li class="clearfix">
				<div class="t">联系邮箱：</div>
				<div class="c bbd1"><input type="email" value="" name="em" id="email"></div>
			</li>
			<li class="clearfix">
				<div class="t">制作材料：</div>
				<div class="c" id="mate">
					<p class="f_l"><span class="radio_list_c1"><span></span><input type="radio"  name="mate" value="1" ></span><span class="mr20">画布</span></p>
					<p class="f_l"><span class="radio_list_c1"><span></span><input type="radio"  name="mate" value="2" ></span><span class="mr20">电子屏</span></p>
					<p><span class="radio_list_c1"><span></span><input type="radio"  name="mate" value="3" ></span><span class="mr20">灯箱</span></p>
					<p><span class="radio_list_c1"><span></span><input type="radio"  name="mate" value="4" ></span><span class="mr20">其他</span><span class="i_txt"><input type="text" name="mateName" value="" placeholder="请填写制作材料"></span></p>
				</div>
			</li>
			<li class="clearfix">
				<div class="t">尺寸：</div>
				<div class="c">				
					<span class="mr20">长：<span class="i_txt"><input type="text" name="long" value="" class="w120"></span>cm</span>
					<span >宽：<span class="i_txt"><input type="text" name="wide" value="" class="w120"></span>cm</span>
				</div>
			</li>
			<li class="clearfix">
				<div class="t">发布日期：</div>
				<div class="c"><span class="i_txt date"><span class="placeholder">请选择日期</span><input type="date" name="time" value="" min="2015-09-12"></span></div>
			</li>
			<li class="clearfix">
				<div class="t">费用：</div>
				<div class="c">
					<p><span class="radio_list_c1"><span></span><input type="radio"  name="pri" value="1" ></span><span class="mr20">自费</span></p>
					<p>
						<span class="radio_list_c1"><span></span><input type="radio"  name="pri" value="4" ></span><span class="mr20">申请补助</span><span class="i_txt mr5"><input type="text" name="priInfo" value=""  class="w160"></span>元
					</p>
				</div>
			</li>
			<li class="i">
				<div class="t">现场环境图片图片：</div>
				<div class="c  clearfix">				
					<div class="l">
						<input accept="image/*" type="file" name="123[]">
					</div>
				</div>
			</li>
			<li class="btn">
				<input type="submit" value="提交申请" id="submit"/>
			</li>
		</ul>
	</form>
</div>
	
</body>
</html>
<script>
	$("#verif").click(function(){
			var isMobile=/^(?:13\d|15\d|18\d)\d{5}(\d{3}|\*{3})$/; //手机号码验证规则
			var cell=$("#cellphone").val();
			if (cell=="") {
				alt("手机号码不能为空!");
				return false;
			}else if (!isMobile.test(cell)) {
				alt("请正确填写电话号码!");
				return false;
			}else{
				$.get('index.php?r=verif/index&mtp='+cell,null,function(response){
 					//3.接收到服务器端返回的数据，填充到div中
 					alt(response);
 				});
			};

	});
	$("#submit").click(function(){
			var isMobile=/^(?:13\d|15\d|18\d)\d{5}(\d{3}|\*{3})$/; //手机号码验证规则
			var cell=$("#cellphone").val();
			if (cell=="") {
				alt("手机号码不能为空!");
				return false;
			}else if (!isMobile.test(cell)) {
				alt("请正确填写电话号码!");
				return false;
			}
			var isEmail=/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]+$/; //邮箱验证规则
			var email=$("#email").val();
			if (email=="") {
				alt("邮箱不能为空!");
				return false;
			}else if (!isEmail.test(email)) {
				alt("请正确填写邮箱!");
				return false;
			};
	})
</script>