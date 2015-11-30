<?php 
use yii\helpers\Url;
?>

<div class="nav_top clearfix"><span class="re_left"></span>申请退款</div>
	<div class="wrap">
		<div class="indent fs25">
			<div class="indent_con">
				<ul class="all">
				
				<?php if($order){
							foreach ($order as $val){	// 订单信息
								if($val['order_id']<1)continue;
				?>
					<li>
						<div class="clearfix">
							<p class="f_l">产品名称 : <span class="fwb">快哉</span></p>
							<p class="f_r f1"><?= $val['status']['name'] ?></p>
						</div>
						<?php foreach ($val['order_goods'] as $v){	// 订单商品
									if($v['goods_id']<1)continue;
						?>
							<a href="<?= Url::to(['order/detail', 'id'=>$val['order_id']]) ?>">
								<div class="clearfix i">
									<p class="f_l p"><img src="/common/upload/goods/<?= $v['goods_img'] ? $v['goods_img'] : 'default.png' ?>" alt=""></p>
									<p class="f_l ml20 n"><?= $v['goods_name'] ?></p>
									<p class="f_r f1 price">
										<span class="ff">￥</span><?= $v['goods_price'] ?><br /><span class="f7">x<?= $v['goods_number'] ?></span>
									</p>
								</div>
							</a>
						<?php } ?>
						<div class="b clearfix">
								<p class="f_l">实付：<span><span class="ff">￥</span><?= $val['order_amount'] ?></span></p>
									
								<?php if($val['status']['action']){		//取出订单动作
										foreach ($val['status']['action'] as $val){
								?>
									<p class="f_r" style="margin-right:5px "><span class="btn" ><?= $val ?></span></p> 
								<?php }} ?>
						</div>		
					</li>
					
			<?php }} ?>

				</ul>	
			</div>
		</div>
	</div>