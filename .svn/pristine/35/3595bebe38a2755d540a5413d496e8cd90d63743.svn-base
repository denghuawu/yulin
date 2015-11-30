<?php
use yii\helpers\Url;
?>
	<div class="nav_top clearfix"><span class="re_left"></span>个人中心</div>
	<div class="wrap">
		<div class="admin_user fs30">
			<div class="head_wrap fs40">
				<div class="head_con">
					<p><img src="/common/upload/figure/<?= $_SESSION['frontend']['figure']?$_SESSION['frontend']['figure'] :'default.png' ?>" alt=""></p>
					<p><?= $_SESSION['frontend']['user_name']; ?></p>
				</div>
			</div>
			<div class="nav_w">
				
				<div class="n_th"><a href="">近三个月交易记录</a></div>				
				<div class="n_s"><div>
					<form action="index.php">
						<input type='hidden' name='r' value='chamei/index'>
						<input type='hidden' name='type' value='2'>
						<input type="text" name="keyword" placeholder="输入单号或买家昵称"><span onclick="submitForm($(this).parent())">搜索</span>
					</form>
				</div></div>
					
				<div class="n_tow clearfix ">
					<p class="f_l yesterday">昨日成交金额</p>
					<p class="f_r today">今日成交金额</p>
				</div>
			</div>
			<div class="con_list fs28">
				<ul class="today">

					<?php if($order){
									foreach ($order as $val){
										if($val['order_id'] < 1)
											continue;
										if($val['confirm_time'] >= $order['today']){
											$i=0;
						 ?>	
						<li class="clearfix">
							
							<div>
							<?php foreach ($val['order_goods'] as $v){
								$i++;
							?>
								<p><?= $v['brand_name'] ?></p>
							<?php } ?>
							</div>
							<div>
							<?php foreach ($val['order_goods'] as $v){
							?>
								<p><?= $v['goods_name'] ?>*<?= $v['goods_number'] ?></p>
							<?php } ?>
							</div>
							
							<div>
								<?= str_repeat('<br/>', $i-1) ?>
								<p><span class="ff">￥</span><?= $val['order_amount'] ?></p>
							</div>
							
						</li>
					<?php }}}  ?>
				</ul>
				
				
				
				
				<ul class="yesterday dn">
					<?php if($order){
									foreach ($order as $val){
										if($val['order_id'] < 1)
											continue;
										if($val['confirm_time'] < $order['today']){
											$i=0;
						 ?>	
						<li class="clearfix">
							
							<div>
							<?php foreach ($val['order_goods'] as $v){
								$i++;
							?>
								<p><?= $v['brand_name'] ?></p>
							<?php } ?>
							</div>
							<div>
							<?php foreach ($val['order_goods'] as $v){
							?>
								<p><?= substr($v['goods_name'],0,12) ?>*<?= $v['goods_number'] ?></p>
							<?php } ?>
							</div>
							
							<div>
								<?= str_repeat('<br/>', $i-1) ?>
								<p><span class="ff">￥</span><?= $val['order_amount'] ?></p>
							</div>
							
						</li>
					<?php }}}  ?>

				</ul>
			</div>
			
		</div>
	</div>
	<div class="sp100"></div>

