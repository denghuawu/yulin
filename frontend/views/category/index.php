<?php
use yii\helpers\Url;
?>


	<div class="nav_top clearfix"><span class="re_left"></span>
		<div class="search">
			<span><s></s></span>
	</div></div>
	<div class="wrap">
		<div class="commodity fs25">
			<div class="commodity_top">
				<div class="nav clearfix">
					<div class="f_l"><a href="<?= Url::to(['category/index','sell'=>$con['sell']=='2' ? 2 : 1,'price'=>$con['price'],'price_min'=>$con['price_min'],'is_hot'=>$con['is_hot'],'is_recommend'=>$con['is_recommend'],'is_new'=>$con['is_new'],'price_max'=>$con['price_max'],'cat_id'=>$con['cat_id'],'brand_id'=>$con['brand_id']]) ?>">销量优先</a></div>
					<div class="f_l">综合排序<s></s></div>
					<div class="f_l">筛选<s></s></div>
				</div>
				<div class="h dn">
				<form action="index.php" method='get'>
					<input type='hidden' name='r' value='category/index'>
					<div class="s">
						价格区间（元）<input name='price_min' type="text"> — <input name='price_max' type="text">
					</div>
					<br>
					<div class="f <?php if(!$sear_data['cat_list']){echo 'dn';} ?>">
						<span>所有分类:</span><br>
						<div class="clearfix">
						  <?php if($sear_data['cat_list']){ ?>
							<?php foreach ($sear_data['cat_list'] as $key=>$val){
									if(!$key)
										continue;
							?>
								<div c_id="<?= $key ?>"><?= $val ?></div>
							<?php }} ?>
							<input type="hidden" name="cat_id" value="<?= $con['cat_id'] ?>">
						</div>
					</div>
					<br>
					<div class="b">
						<span>品牌:</span><br>
						<div class="clearfix">
						 <?php if($sear_data['brand_list']){ ?>
							<?php foreach ($sear_data['brand_list'] as $key=>$val){?>
								<div c_id="<?= $key ?>"><?= $val ?></div>
							<?php }} ?>
							<input type="hidden" name="brand_id" value="<?= $con['brand_id'] ?>">
						</div>
					</div>
					<br>
					<div class="btn cen">
						<input type="hidden" name="is_hot" value="<?= $con['is_hot'] ?>">
						<input type="hidden" name="is_recommend" value="<?= $con['is_recommend'] ?>">
						<input type="hidden" name="is_new" value="<?= $con['is_new'] ?>">
						<input type="submit" name='submit' value="确&nbsp;&nbsp;&nbsp;&nbsp;认">
					</div>
					</form>
				</div>
				<div class="z dn">
					<a href="<?= Url::to(['category/index','sell'=>$con['sell'],'price'=>0,'is_hot'=>$con['is_hot'],'is_recommend'=>$con['is_recommend'],'is_new'=>$con['is_new'],'price_min'=>$con['price_min'],'price_max'=>$con['price_max'],'cat_id'=>$con['cat_id'],'brand_id'=>$con['brand_id']]) ?>"><div class="c">综合排序</div></a>    
					<a href="<?= Url::to(['category/index','sell'=>$con['sell'],'price'=>1,'is_hot'=>$con['is_hot'],'is_recommend'=>$con['is_recommend'],'is_new'=>$con['is_new'],'price_min'=>$con['price_min'],'price_max'=>$con['price_max'],'cat_id'=>$con['cat_id'],'brand_id'=>$con['brand_id']]) ?>"><div>价格从低到高</div></a>
					<a href="<?= Url::to(['category/index','sell'=>$con['sell'],'price'=>2,'is_hot'=>$con['is_hot'],'is_recommend'=>$con['is_recommend'],'is_new'=>$con['is_new'],'price_min'=>$con['price_min'],'price_max'=>$con['price_max'],'cat_id'=>$con['cat_id'],'brand_id'=>$con['brand_id']]) ?>"><div>价格从高到低</div></a>
				</div>
			</div>

			
				<div class="commodity_con bcf7">
				 <?php if($goods_data){ ?>
				 	<?php foreach ($goods_data as $val){ 
				 		if($val['goods_id'] < 1)
				 			continue;
				 	 ?>
						<div>
							<a href="<?= Url::to(['goods/index', 'id'=>$val['goods_id']]); ?>">
								<img src="/common/upload/goods/<?= $val['goods_img'] ? $val['goods_img'] : 'default.png' ?>" alt="">
								<p class="t"><?= mb_substr($val['goods_name'],0,25,'utf-8'); ?></p>
							</a>
							<p class="b"><span class="f1"><span class="ff">￥</span> <?= $val['goods_price'] ?></span><span class="f_r f3"><?= $val['goods_sell'] ?>人已付款</span></p>
						</div>
					<?php } ?>
				<?php }else{ ?>
					<div style="width:100%" class="cen fs30">
						暂无商品信息
					</div>
				<?php } ?>
	
				</div>
		</div>
	</div>
	
	
<script type="text/javascript">
	var page = 1;
	window.onload=function(){
		loadS('http://chamei.com/frontend/web/index.php?r=category/index&ajax=1'+location.search.replace('?r=category%2Findex',''),function(d){
			var d=$('<div><a href="index.php?category/index&'+d['goods_id']+'"><img Lsrc="/common/upload/goods/'+d['goods_img']+'" alt=""><p class="t">'+d['brand_name']+'</p></a><p class="b"><span class="f1"><span class="ff">￥</span> '+d['goods_price']+'</span><span class="f_r f3">'+d['goods_price']+'人已付款</span></p></div>');
			onlo(d.find('img'));
			$('.commodity_con').append(d);
		});
	}
	$(".commodity_top .b div div,.commodity_top .f div div").click(function(){
		$(this).parent().children('div').removeClass('c');
		$(this).addClass('c');
		$(this).siblings('input').val($(this).attr('c_id'));
	});
</script>
	