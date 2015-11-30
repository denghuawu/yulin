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
	<title>购物车</title>
	<link rel="stylesheet" type="text/css" href="./yulin_home/css/style.css?a=5">
	<script type="text/javascript" src="./yulin_home/js/jquery.js"></script> 
</head>
<body>
	<div class="nav_top clearfix"><div class="nav_top_con"><a href="javascript:history.go(-1);" class="re_left"></a>购物车<span class="re_txt f8 fs30">编辑</span></div></div>
	<div class="wrap shopcat">
		<div class="shopping">
		<form action="" method="post" subsrc="<?= Url::to(['cart/suborder']) ?>" resrcr="<?= Url::to(['cart/delcart']) ?>" id="shopcat">
			<ul class="fs26">
					<?php 
					if ($error==200) :
						foreach ($cart as $key=>$value) :?>
						<li class="clearfix" product_id="<?php $cart[$key]['gid']?>">
							<div class="c">
								<p class="t"><span class=""></span>
								<input type="hidden" name="opt[]" value="0">
								<input type="hidden" name="cid[]" value="<?php echo $cart[$key]['cid']?>">
								<input type="hidden" name="good_id[]" value="<?php echo $cart[$key]['gid']?>"></p>
							</div>
							<div class="i">
								<p><a href="<?= Url::to(['index/getgoods', 'id'=>$cart[$key]['gid']]) ?>"><img src="<?php echo '../../common/upload/goods/'.$cart[$key]['img']?>" alt=""></a></p>
							</div>
							<div class="n">
								<a href="<?= Url::to(['index/getgoods', 'id'=>$cart[$key]['gid']]) ?>"><p><?php echo $cart[$key]['name']?></p></a>
								<p class="s clearfix"><span class="f_l f2 fs26">￥<?php echo $cart[$key]['price'];?>
																				</span><span class="f_r">x<?php echo $cart[$key]['num'];?>
																											</span></p>
								<p class="plural"><input type="button" value="-" name="-"><input type="text" name="num[]" value="<?php echo $cart[$key]['num'];?>" min="1"><input type="button" value="+" name="+"></p>
							</div>
						</li>
						<?php 
							endforeach;
						else:
							echo '<center>暂无商品<a href="'.Url::to(['index/index']).'">&nbsp; 返回首页 &nbsp;</a><center>';
						endif;
						?>
		</ul>
		</form>
		</div>
		<div class="shopcat_total fs30 ">
			<div class="shopcat_total_con">
				<div class="submit  clearfix">
					<div class="f_l">合计：<span class="total f1">￥0</span></div>
					<div class="f_r">确认</div>
				</div>
				<div class="remove dn clearfix">
					<div class="all f_l"><p class="t f_l"><span class=""></span></p>全选</div>
					<div class="f_r">删除</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src='./yulin_home/js/public.js'></script>

</body>
</html>