<?php 
use yii\helpers\Url;
?>
	<title>用户中心</title>
</head>
<body>
	<div class="nav_top"><div class="nav_top_con">个人中心</div></div>
	<div class="wrap">
		<div class="user fs25">
			<div class="head_wrap fs40">
				<a href="<?= Url::to(['user/userdata']) ?>">
					<?php if ($error==200) :?>
						<?php foreach ($data as $key => $value) :?>
							<div class="head_con">
								<p><img src="<?php echo '../../common/upload/figure/'.$data[$key]['img']?>" alt=""></p>
								<p class="n"><?php echo $data[$key]['name']?></p>
							</div>
						<?php endforeach;?>

					<?php else:
						exit($error);
					?>
					<?php endif;?>
				</a>
			</div>
			<div class="main_wrap">
				<div class="flow clearfix ">
					<div class="f"><a href="<?= Url::to(['order/index','id'=>1]) ?>"></a></div>
					<div class="d"><a href="<?= Url::to(['order/index','id'=>2]) ?>"></a></div>
					<div class="s"><a href="<?= Url::to(['order/index','id'=>3]) ?>"></a></div>
					<div class="t"><a href="<?= Url::to(['order/index','id'=>4]) ?>"></a></div>
				</div>
				<a href="<?= Url::to(['order/index',['id'=>0]]) ?>"><div class="all clearfix"><span class="nav_left"></span><span>全部订单</span><span class="go_r_w"><span class="go_r"></span></span></div></a>
				<a href="<?= Url::to(['address/index']) ?>"><div class="site clearfix"><span class="nav_left"></span><span>收货地址</span><span class="go_r_w"><span class="go_r"></span></span></div></a>
			</div>
		</div>
	</div>
	<div class="nav_foot clearfix">
		<div class="nav_foot_con">
			<div><a href="<?= Url::to(['index/index']) ?>" class="home"></a></div>
			<div><a href="<?= Url::to(['cart/index']) ?>" class="shopping"></a></div>
			<div><a href="<?= Url::to(['user/index']) ?>" class="personal opt"></a></div>
		</div>
	</div>
</body>
</html>

