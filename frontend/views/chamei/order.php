
	<div class="nav_top clearfix"><span class="re_left"></span>我的订单</div>
	<div class="wrap">
		<div class="indent fs25">
			<div class="indent_con">
				<ul class="refund">
				 <?php foreach ($order as $val){
				 			if($val['order_id']<1)
				 				continue;	 
				 ?>
					<li>
						<?php foreach ($val['order_goods'] as $v){ ?>
							<div class="clearfix">
								<p class="f_r f1 mr5"><?= $v['status']['name'] ?></p>
							</div>
							<div class="clearfix i">
								<p class="f_l p"><img src="/common/upload/goods/<?= $v['goods_img'] ? $v['goods_img'] : 'default.png' ?>" alt=""></p>
								<p class="f_l ml20 n"><?= $v['goods_name'] ?></p>
								<p class="f_r f1 price">
									<span class="ff">￥</span><?= $v['goods_price'] ?><br /><span class="f7">x<?= $v['goods_number'] ?></span>
								</p>							
							</div>	
						<?php } ?>
						<div class="b clearfix">							
							<p class="f7 tar"><span class="mr30">交易金额<span class="f1"><span class="ff">￥</span><?= $val['order_amount'] ?></span></span><?php if($val['refund_money'] > 0){ ?><span>退款金额<span class="f1"><span class="ff">￥</span><?= $val['refund_money'] ?></span><?php } ?></span></p>
							<p class="f7 f_l">订单编号：<?= $val['order_sn'] ?></p>
							<?php 
								
								if($val['refund_status'] < 1){
									
								if($val['status']['action']){		//取出订单动作
											foreach ($val['status']['action'] as $val){
									?>
										<p class="f_r"><span class="btn" ><?= $val ?></span></p> 
							<?php }}}else{ ?>				
									<p class="f_r"><span class="btn" ><?= $val['refund_status']==SUCCESS_REFUND ? '已退款' : '退款中' ?></span></p>
							<?php } ?>
						</div>											
					</li>
				<?php } ?>
					
					
					<li>
						<div class="clearfix">
							<p class="f_l">产品名称 : <span class="fwb">快哉</span></p>
							<p class="f_r f1">已完成</p>
						</div>
						<div class="clearfix i">
							<p class="f_l p"><img src="images/shopping.jpg" alt=""></p>
							<p class="f_l ml20 n">201大益之恋美好时光特价01大益之恋美好时光特价！</p>
							<p class="f_r f1 price">
								<span class="ff">￥</span>1008<br /><span class="f7">x2</span>
							</p>
						</div>	
						<div class="clearfix i">
							<p class="f_l p"><img src="images/shopping.jpg" alt=""></p>
							<p class="f_l ml20 n">201大益之恋美好时光特价01大益之恋美好时光特价！</p>
							<p class="f_r f1 price">
								<span class="ff">￥</span>1008<br /><span class="f7">x2</span>
							</p>							
						</div>	
						<div class="b clearfix">							
							<p class="f7 tar"><span class="mr30">交易金额<span class="f1"><span class="ff">￥</span>998</span></span><span>退款金额<span class="f1"><span class="ff">￥</span>998</span></span></p>
							<p class="f7 f_l">订单编号：546123679896</p>						
							<p class="f_r"><span class="btn c">已退款</span></p>							
						</div>							
					</li>
				</ul>

	
			</div>
		</div>
	</div>
