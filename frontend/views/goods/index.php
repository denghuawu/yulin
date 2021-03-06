<?php
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<Meta http-equiv="Pragma" Content="No-cach">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width,initial-scale=0.5,maximum-scale=0.5,minimum-scale=0.5,user-scalable=no">
	<meta name="MobileOptimized" content="320">
	<meta http-equiv="cleartype" content="on">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">

	<meta charset="UTF-8">
	<title>商品详情</title>
	<link rel="stylesheet" href="./yulin_home/css/swiper.css">	
	<link rel="stylesheet" type="text/css" href="./yulin_home/css/style.css">
	<script type="text/javascript" src="./yulin_home/js/jquery.js"></script>
	<script type="text/javascript" src="./yulin_home/js/swiper.js"></script>
	<script type="text/javascript" src="./yulin_home/js/public.js"></script>
</head>
<body>
	<div class="nav_top clearfix"><div class="nav_top_con"><a href="javascript:history.back()" class="re_left"></a>商品详情<a href="<?= Url::to(['cart/index']) ?>" class="re_cat"></a></div></div>
	<div class="wrap">
		<div class="shop_con fs30 pb70">
			<div class="shop_top">
				<div class="swiper-container ppt hidden">
				  	<div class="swiper-wrapper hidden">
					  	<?php foreach ($data['goods_gallery'] as $key=>$value) :?>
					      <div class="swiper-slide" dd="<?php echo $key?>"> 
					         <div><img src="../../common/upload/goods/<?php echo $value?>"></div>
					      </div>
						<?php endforeach;?>
				    </div>
				</div>
				<div class="swiper_nav">
		  	
				</div>
			</div>
			<div class="shop_con_c fs25">
				<div class="shop_info ">
					<div class="clearfix pc40 fs30">
						 <div class="f_l shop_n pm10"><?php echo $data['goods_name']?></div>
					</div>
					<div class="fs35 pl40 f12">￥<?php echo $data['goods_price']?>
					</div>
					<div class="f5 clearfix r pl40 pb10 bbd1">
						
						<div class="b f_l">库存：<?php echo $data['goods_number'],$data['goods_unit']?></div>
					</div>
					<div class="sp5"></div>
					<div class="pl40">
						<div class="shop_info_nav clearfix">
							<div class="i f13">产品参数<div></div></div>
						</div>
						<div class="sp1"></div>
						<div class="shop_info_con">
							<div class="i">
							<?php
								if(!empty($data['goods_attr'])){
										foreach($data['goods_attr'] as $title=>$con){
											if(!$title)
												continue;
											echo "<p>{$title}：{$con}</p>";
										}
								}else{
									echo '暂无数据';
								}
							?>
							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="shop_btn">
				<div class="shop_btn_con">
					<form action="<?= Url::to(['cart/atonce']) ?>" method='post'>
						<div><input type="hidden" name="goods_id" value="<?php echo $goods_id;?>"></div>
						<div class="input f_l">
							<input type="button" value="-" class=""><input type="text" value="1" name="num" class="" maxlength="5" onkeyup="value=value.replace(/[^\d]/g,'')"  onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''))" max='10' ><input type="button" value="+" class="">
						</div>
						<div class="cat f_l">加入购物车</div><input type="submit" class="buy f_l" value="立即购买">
					</form>
				</div>
				</div>
			</div>

		</div>
	</div>
</body>
</html>

	
