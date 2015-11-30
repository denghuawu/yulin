<?php 
use yii\helpers\Url;
?>
	<div class="nav_top clearfix"></span>我的收藏</div>
	<div class="wrap">
		<div class="collect">
			<div class="collect_top fs30 clearfix">
				<div class="f_l  cl1">全部</div>
				<div class="f_l">已下架</div>
			</div>
			<div class="collect_con fs25">
			
			<?php if(empty($collect)){ ?>
				<div class="cen dn">暂无收藏</div>
			<?php } ?>
				
			 <?php if(!empty($collect)){  ?>
				<ul class="collect_remove">
					<?php foreach ($collect as $val){  ?>
						<li class="clearfix" collect_id="<?= $val['collect_id'] ?>">
						
							<div class="check f_l"><span class="r1"></span></div>
							<a href="<?= Url::to(['goods/index', 'id'=>$val['goods_id']]); ?>">
							<div class="f_l"><img src="/common/upload/goods/<?= $val['goods_img'] ? $val['goods_img'] : 'default.png' ?>" alt=""></div>
							</a>
							<div class="f_l s">
								<a href="<?= Url::to(['goods/index', 'id'=>$val['goods_id']]); ?>"><p><?= $val['goods_name'] ?></p></a>
								<p class="p  clearfix"><span class="f1 f_l ">￥<?= $val['goods_price'] ?> </span></p>
							</div>
						
						</li>
					
					<?php } ?>
			
					<li class="handle"><div>
						<div>删&nbsp;&nbsp;&nbsp;&nbsp;除</div>
					</div></li>			
				</ul> 
			<?php }  ?>	
				
			<?php if(!empty($collect)){  ?>
				<ul class="collect_out dn">
					<?php foreach ($collect as $val){ 
						if($val['is_updown']<1){
					?>
						
						<li class="clearfix">
							<div class="f_l"><img src="/common/upload/goods/<?= $val['goods_img'] ? $val['goods_img'] : 'default.png' ?>" alt=""></div>
							<div class="f_l s">
								<p><?= $val['goods_name'] ?></p>
								<p class="p  clearfix"><span class="f1 f_l ">￥<?= $val['goods_price'] ?> </span><span class="f_r f7">已下架</span></p>
							</div>
						</li>
					<?php }} ?>
					<li class="handle"><div>
						<div><a href="<?= Url::to(['collect/empty']) ?>"><div>清&nbsp;&nbsp;&nbsp;&nbsp;空</div></a></div>
					</div></li>
				</ul>
			<?php }  ?>	

			</div>

			<?php require_once("../views/layouts/footer.php"); ?>
			
		</div>
	</div>