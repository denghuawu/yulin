<?php 
use yii\helpers\Url;
?>
	<div class="nav_top clearfix" style="position:absolute;"><span class="re_left"></span>评价商品</div>
	<div class="wrap">
		<div class="evaluate fs30 ">
		<form action="<?= Url::to(['order/addcomment'])?>" method='post' id="evaluate_f">
		 <?php if($order['order_goods']){
		 			foreach ($order['order_goods'] as $val){
		 ?>
			<div class="evaluate_w pm40">
				<div class="evaluate_con clearfix">
					<p class="f_l"><img src="/common/upload/goods/<?= $val['goods_img'] ? $val['goods_img'] : 'default.png' ?>" alt=""></p>
					<p class="f_l t">
						<span><?= $val['goods_name'] ?></span>
						<!-- <span class="m f1"><span class="ff">￥</span><?= $val['goods_price'] ?></span> -->
					</p>
				</div>
				<div class="evaluate_e pc40">
					<div class="e clearfix pm30">
						<div class="h"><span></span></div>
						<div class="z"><span></span></div>
						<div class="c"><span></span></div>
					</div>
					<input type='hidden' name="score[]" value='0'>
					<input type='hidden' name="goods_id[]" value="<?= $val['goods_id'] ?>">
					<textarea name="content[]" id="" placeholder="请输入您对这件商品的评价"></textarea>
				</div>
			</div> 
			
		 <?php }} ?>
			
			<input type='hidden' name='order_id' value="<?= $order['order_id'] ?>">
			<div class="evaluate_f" onclick="$('#evaluate_f').submit()">
				发表评价
			</div>
		</form>
		</div>
	</div>
