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
	<title></title>
	<link rel="stylesheet" type="text/css" href="./yulin_home/css/style.css">
	<script type="text/javascript" src="./yulin_home/js/jquery.js"></script>
	<script type="text/javascript" src="./yulin_home/js/public.js"></script>
</head>
<body>
	<div class="nav_top clearfix"></div>
		<center>
		<div class="wrap">
			<div class="register_over fs30 ">
				<div class="<?php if (!empty($msg['error'])): echo $msg['error'];else: echo 'over';endif; ?>"></div>
				<div class="text"><?php echo $msg['message'];?></div>
				<?php if($msg['link']){
						foreach ($msg['link'] as $value) {
				?>
				<a href="<?php echo $value['href'] ?>" ><div class="btn"><?php echo $value['title'] ?></div></a><br/>
				<?php } } ?>
			</div>
		</center>
	</div>	
</body>
</html>
	
