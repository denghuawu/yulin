<?php 
use yii\helpers\Url;
?>
	<div class="nav_top clearfix"><span class="re_left"></span>订单详情</div>
	<div class="wrap">
		<div class="order">
			<div class="site fs30">
				<div class="l f_l"></div>
				<div class="i f_l">
					<p class="clearfix">
						<span class="f_l">收货人 ：<?= $order['address']['consignee'] ?></span>
						<span class="f_r"><?= $order['address']['mobile'] ?></span>
					</p>
					<p>收货地址 ：<?= $order['address']['province'] ?> <?= $order['address']['city'] ?> <?= $order['address']['district'] ?> <?= $order['address']['address'] ?></p>
				</div>
				<div class="r f_r dn"><a></a></div>
			</div>
			<div class="order_l fs28">
				<div>
					<div class="n pm10">订单号 ： <span class="fwb"><?= $order['order_sn'] ?></span></div>
					<div class="spa1"></div>
					
					<?php foreach ($order['order_goods'] as $val){ ?>
						<div class="clearfix i pm10">
							<a href="<?= Url::to(['goods/index', 'id'=>$val['goods_id']]); ?>">
								<p class="f_l p"><img src="/common/upload/goods/<?= $val['goods_img'] ? $val['goods_img'] : 'default.png' ?>" alt=""></p>
							</a>
							<a href="<?= Url::to(['goods/index', 'id'=>$val['goods_id']]); ?>">
								<p class="f_l ml20 n"><?= $val['goods_name'] ?></p>
							</a>
							<p class="f_r f1 price">
								<span class="ff">￥</span><?= $val['goods_price'] ?><br /><span class="f7">x<?= $val['goods_number'] ?></span>
							</p>
						</div>
					<?php } ?>
					
				</div>
				<div class="order_foot fs30">
					<p class="clearfix">
						<span class="f_l f7">配送快递</span>
						<span class="f_r "><span class="ff">￥</span><?= $order['shipping_fee'] ?></span>
					</p>
					<p class="clearfix">
						<span class="f_l f7">订单总额</span>
						<span class="f_r f11">
						<span class="ff">￥</span><?= $order['order_amount'] ?></span>
					</p>
					<div class="logistics">
						
					</div>
				</div>
			<?php if($order['order_status'] > PAYED && $order['shipping_id']>0){ ?>
				<div class="logistics" id="logistics">
					<div class="logistics_top">物流追踪</div>
					<div class="logistics_info clearfix">
						<div class="f_l pc10"><img src="/common/upload/express/<?= $order['express']['expSpellName'] ?>.jpg" alt=""></div>
						<div class="f_l ">
							<p><?= $order['express']['expTextName'] ?></p>
							<p>快递单号 : <span><?= $order['express']['mailNo'] ?></span> </p>
							
						</div>
					</div>
					<div class="logistics_con">
						<?php foreach($order['express']['data'] as $val){ ?>
							<div>
								<div class="clearfix">
									<div class="ico f_l"><span></span></div>
									<div class="c f_l">
										<div class='t'><?= $val['context'] ?></div>
										<div class="time"><?= $val['time'] ?></div>
									</div>
									
								</div>
								<div class="spa1"></div>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
