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
	<title>活动申请</title>
	<link rel="stylesheet" type="text/css" href="./yulin_home/css/style.css">
	<script type="text/javascript" src="./yulin_home/js/jquery.js"></script>
	<script type="text/javascript" src="./yulin_home/js/public.js"></script>
</head>
<body>
<div class="wrap ad fs30">
	<form action="<?= Url::to(['activity/getdata']) ?>" method="post" enctype="multipart/form-data">
	<ul>
		<li class="clearfix">
			<div class="t">手机号码：</div>
			<div class="c bbd1 tel"><input type="text" value="" id="cellphone" name="cellphone" maxlength="11" onkeyup="value=value.replace(/[^\d]/g,'')"  onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))"><input type="button" value="获取验证码" id="verif"></div>
		</li>
		<li class="clearfix">
			<div class="t">验证码：</div>
			<div class="c bbd1"><input type="text" value="" name="verif"></div>
		</li>
		<li class="clearfix">
			<div class="t">活动主题：</div>
			<div class="c bbd1"><input type="text" value="" name="title"></div>
		</li>
		<li class="clearfix">
			<div class="t">活动时间：</div>
			<div class="c">
				<span class="i_txt date w200"><span class="placeholder">请选择日期</span><input type="date" name="start_time" value="" min="2015-09-12"></span><span class="pc20">-</span><span class="i_txt date w200"><span class="placeholder">请选择日期</span><input type="date" name="end_time" value="" min="2015-09-12"></span>
			</div>
		</li>
		<li class="clearfix">
			<div class="t">活动地点：</div>
			<div class="c bbd1"><input type="text" value="" name="site"></div>
		</li>
		<li class="clearfix">
			<div class="t">活动角色：</div>
			<div class="c">
				<p class="f_l"><span class="radio_list_c1"><span></span><input type="radio"  name="role" value="1" ></span><span class="mr20">自主</span></p>
				<p><span class="radio_list_c1"><span></span><input type="radio"  name="role" value="3" ></span><span class="mr20">赞助</span></p>
				<p><span class="radio_list_c1"><span></span><input type="radio"  name="role" value="4" ></span><span class="mr20">其他</span><span class="i_txt"><input type="text" name="newRole" value="" placeholder=""></span></p>
			</div>
		</li>
		<li class="clearfix">
			<div class="t">经费预算：</div>
			<div class="c">
				<p><span class="radio_list_c1"><span></span><input type="radio"  name="expenditure" value="1" ></span><span class="mr20">自费</span></p>
				<p>
					<span class="radio_list_c1"><span></span><input type="radio"  name="expenditure" value="4" ></span><span class="mr20">申请补助</span><span class="i_txt mr5"><input type="text" name="exp" value=""  class="w160"></span>元
				</p>
			</div>
		</li>
		<li class="i">
				<div class="t">现场环境图片图片：</div>
				<div class="c  clearfix">				
					<div class="l">
						<input accept="image/*" type="file" name="a[]">
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
	})
</script>