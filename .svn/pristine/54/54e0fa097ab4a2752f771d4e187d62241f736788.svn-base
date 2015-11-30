<?php 
use yii\helpers\Url;
$this->context->layout="header";
?>
	<title>登陆</title>
</head>
<body>
	<div class="nav_top"><div class="nav_top_con clearfix"><a href="javascript:history.go(-1);" class="re_left"></a>登陆</div></div>
	<div class="wrap">
		<div class="login fs35">
			<form class="login_con" action="<?= Url::to(['login/login']) ?>" method="post">
				<p class="mt70"><span>账号</span><input type="text" placeholder='请输入用户名' maxlength='15' name="username" id="username"></p>
				<p><span>密码</span><input type="password" placeholder='请输入密码' maxlength="20" name="password" id="pass"></p>
				<p class="verifi"><span>验证码</span><input type="text" placeholder='验证码' maxlength="4" name="verifi" id="yzm"><img src="<?php echo $imgName;?>" id="img"></p>
				<p class="mt40" id="submit"><input type="submit" value="登&nbsp;&nbsp;&nbsp;&nbsp;陆"></p>
			</form>
			<div class="login_foot">
			</div>
		</div>
	</div>
</body>
</html>
<script>
 	$("#img").click(function(){
 		$("#img").attr("src","null");
 		$.post(
			'index.php?r=login/img',
			function($m){
				if($m){
					$("#img").attr("src",$m);
				}
			})
 	});
 	$("#submit").click(function(){
 		var name=$("#username").val();
 		var pass=$("#pass").val();
 		var yzm=$("#yzm").val();
 		if (name=="") {
				alt("用户名不能为空!");
				return false;
		}
		if (pass=="") {
				alt("密码不能为空!");
				return false;
		}
		if (yzm=="") {
				alt("验证码不能为空!");
				return false;
		}

 	});
</script>