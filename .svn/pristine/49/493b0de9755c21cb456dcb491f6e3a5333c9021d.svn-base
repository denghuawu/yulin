<?php
use yii\helpers\Url;
?>
	<div class="nav_top clearfix"><span class="re_left"></span>历史记录<span class="n_t_r" id='empty'>清空</span>
	</div>
	<div class="wrap">
		<div class="history bcf7 fs30">
			<?php if($scan){ 
					foreach ($scan as $val){
			?>
			<div class="clearfix">
				<a href="<?= Url::to(['goods/index', 'id'=>$val['goods_id']]); ?>">
					<div class="f_l"><img src="/common/upload/goods/<?= $val['goods_img'] ? $val['goods_img'] : 'default.png' ?>" alt=""></div>
				</a>
				<div class="f_r c">
					<a href="<?= Url::to(['goods/index', 'id'=>$val['goods_id']]); ?>">
						<p><?= $val['goods_name'] ?></p>
					</a>
					<p class="b"><span class="f1"><span class="ff">￥</span> <?= $val['goods_price'] ?></span></p>
				</div>
			</div>
			
			<?php }} ?>
			
		</div>
	</div>

	<script>
		$('#empty').click(function(){
			affirm('确定清空','确定要清空历史记录？',function(){
				location.href = 'index.php?r=history/empty';
			})
		})

	</script>