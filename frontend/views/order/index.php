<?php
use yii\helpers\Url;
?>
	<title>订单</title>
</head>
<body>
	<div class="nav_top"><div class="nav_top_con clearfix"><a href="javascript:history.go(-1);" class="re_left"></a>我的订单</div></div>
	<div class="wrap">
		<div class="indent fs25">
			<div class="indent_top clearfix">
					
					<div class="all <?php if($var==0){ echo 'cl1';}?>"><a href="<?= Url::to(['order/index','id'=>0])?>">全部</a></div>
					<div class="d  <?php if($var==1){ echo 'cl1';}?>"><a href="<?= Url::to(['order/index','id'=>1])?>">待付款</a></div>
					<div class="f  <?php if($var==2){ echo 'cl1';}?>"><a href="<?= Url::to(['order/index','id'=>2])?>">待发货</a></div>
					<div class="s  <?php if($var==3){ echo 'cl1';}?>"><a href="<?= Url::to(['order/index','id'=>3])?>">待收货</a></div>
					<div class="t  <?php if($var==4){ echo 'cl1';}?>"><a href="<?= Url::to(['order/index','id'=>4])?>">退款</a></div>
			</div>
			<div class="indent_con">
				<?php if (empty($data['error'])):?>
				<?php foreach ($data as $value):?>
				<ul class="all">
					<li>
						
								<div class="clearfix">
									<p class="f_l"></p>
									<p class="f_r f1">
										<?php 
										switch ($value['ost']) {
											case '1':
												echo '未付款';
												break;
											case '2':
												echo '待发货';
												break;
											case '3':
												echo '确认收货';
												break;
											case '4':
												echo '申请售后';
												break;
											default:
												
												break;
										}?>
									</p>
								</div>
								<?php $sum_pri=0?>
								<?php foreach ($value['goodsInfo'] as $v):?>
									<div class="clearfix i">
									<a href="<?= Url::to(['goods/index', 'id'=>$v['gid']]) ?>">
										<p class="f_l p"><img src="../../common/upload/goods/<?php echo $v['img']?>" alt=""></p>
										<p class="f_l ml20 n"><?php echo $v['name']?></p>
										<p class="f_r f1 price">
											<span class="ff">￥</span><?php echo $v['pri']?><br /><span class="f7">x<?php echo $v['number']?></span>
										</p>
									</a>
									</div>
									<?php $sum_pri+=$v['pri']?>
								<?php endforeach;?>

								<div class="b clearfix">
									<form action="">
										<input type="hidden">
										<p class="f7">订单号 : <?php echo $value['osn']?></p>
										<p class="f_l">
											<?php if ($value['ost']==1 ):
												echo '商品总价(不含快递费)：';
											else:
												echo '实付(含快递费)：';
											endif;?>
											<span>
												<span class="ff">￥</span>
												<?php if ($value['ost']==1):echo $sum_pri; else: echo $value['pay_fee']; endif;?>
											</span>
										</p>
										<?php if ($value['ost']!=2):?>
											<p class="f_r">
												<span class="btn">
													<?php 
													switch ($value['ost']) {
														case '1':
															$str='<a href="'.Url::to(['order/verifyorder','orderid'=>$value['oid']]).'">付款</a>';
															echo $str;
															break;
														case '3':
															$str='<a href="'.Url::to(['order/verifyorder','orderid'=>$value['oid']]).'">确认收货</a>';
															echo $str;
															break;
														case '4':
															$str='<a href="'.Url::to(['order/verifyorder','orderid'=>$value['oid']]).'">申请售后</a>';
															echo $str;
															break;
													}?>
												</span>
											</p>
										<?php endif;?>
									</form>
								</div>
								
					</li>
				</ul>
				<?php endforeach;?>
				<?php else: ?>
					<ul class="all">
						<li>
							<?php echo $error;?>
						</li>
					</ul>
				<?php endif;?>
			</div>
		</div>
	</div>
</body>
</html>