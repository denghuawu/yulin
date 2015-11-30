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
	<link rel="stylesheet" type="text/css" href="./yulin_home/css/style.css">
	<script type="text/javascript" src="./yulin_home/js/jquery.js"></script>
	<script type="text/javascript" src="./yulin_home/js/public.js"></script>
<?php echo $content;?>
<div class="nav_foot clearfix">
		<div class="nav_foot_con">
			<div><a href="<?= Url::to(['index/index']) ?>" class="home opt"></a></div>
			<div><a href="<?= Url::to(['cart/index']) ?>" class="shopping"></a></div>
			<div><a href="<?= Url::to(['user/index']) ?>" class="personal"></a></div>
		</div>
	</div>
</body>
</html>