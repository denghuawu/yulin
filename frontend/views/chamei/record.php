
	<div class="nav_top clearfix">个人中心</div>
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
			</div>
			<div class="con_list fs25">
			
				<?php if($order){
							foreach ($order as $val){
								if($val['order_id'] < 1)
									continue;
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
					<?php }}  ?>
				
			</div>
			
		</div>
	</div>
	<div class="sp100"></div>

	<?php require_once("../views/layouts/footer.php"); ?>