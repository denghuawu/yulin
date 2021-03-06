<?php 
use yii\helpers\Url;
?>
<title>商品列表</title>
</head>
<body>
	<div class="wrap fs26">
		<div class="commodity fs25">
			<div class="commodity_search">
				<form action="<?= Url::to(['index/seo']) ?>" method="get">
					<input type="hidden" value="index/seo" name="r">
					<input type="text" value="" placeholder="请在此输入搜索" name="seo"><input type="submit" value="">				
				</form>
			</div>
			<div class="commodity_top">
				<div class="nav clearfix">
					<?php if (!empty($cate)):?>
						<?php foreach ($cate as $key => $value):?>
							<a href="<?= Url::to(['index/getgoods', 'id'=>$value['cat_id']]) ?>">
								<div class="<?php 
												if($key==0):
													echo 'opt';
												else:
													echo '';
												endif;
											?>">
									<?php echo $value['cat_name']?>
								</div>
							</a>
						<?php endforeach;?>
					<?php else:?>
						<?php echo '暂无分类信息';?>
					<?php endif;?>
				</div>
			</div>

			<div class="commodity_con clearfix">
				<?php if ($error==200):?>
					<?php foreach ($goods as $key => $value) :?>
					<div>
						<a href="<?= Url::to(['goods/index', 'id'=>$value['id']]) ?>"><div>
							<img src="<?php echo '../../common/upload/goods/'.$value['img']?>" alt="">
						</div>
						<div>
							<p class="t"><?php echo mb_substr($value['name'], 0,12,'utf-8')?></p>
							<p class="b">
								<span class="f12 fs28">￥<?php echo $value['price']?></span><span class="f_r f31 fs22">库存：<?php echo $value['num'],$value['unit']?></span>
							</p>						
						</div></a>
					</div>
					<?php endforeach;?>
				<?php else:?>
					<?php echo $error?>
				<?php endif;?>
			</div>
		</div>
	</div>
