<?php 
use yii\helpers\Url;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Pragma" Content="No-cach">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width,initial-scale=0.5,maximum-scale=0.5,minimum-scale=0.5,user-scalable=no">
	<meta name="MobileOptimized" content="320">
	<meta http-equiv="cleartype" content="on">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta charset="UTF-8">
	<title>地址管理</title>
	<link rel="stylesheet" type="text/css" href="./yulin_home/css/style.css">
	<script type="text/javascript" src="./yulin_home/js/jquery.js"></script>
	<script type="text/javascript" src="./yulin_home/js/public.js"></script>
</head>
<body>
	<div class="nav_top"><div class="nav_top_con clearfix"><a href="javascript:history.go(-1);" class="re_left"></a>收货地址</div></div>
	<div class="wrap">
		<div class="site fs30">
			<div class="site_l">
				<?php foreach ($data as $key => $value):?>
				<a href="<?= Url::to(['address/update', 'id'=>$value['address_id']]) ?>" class="site_list <?php if ($value['is_default']==1):echo 'now';else:echo '';endif;?>">
					<p class="clearfix">
						<span class="f_l"><?php echo $value['address_name']?></span>
						<span class="f_r"><?php echo $value['mobile']?></span>
					</p>
					<p class="f7"><?php if ($value['province']==$value['city']):?>
										<?php echo $value['city'].'市'.$value['district'].'&nbsp;'.$value['address'];?>
									<?php else:?>
										<?php echo $value['province'].'省'.$value['city'].'市'.$value['district'].'&nbsp;'.$value['address'];?>
									<?php endif;?></p>
				</a>
				<?php endforeach;?>
				
			</div>
			<div class="site_add"><a href="<?= Url::to(['address/create']) ?>"><div>添加新地址</div></a></div>
			
		</div>
	</div>
</body>
</html>