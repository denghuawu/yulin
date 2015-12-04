<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>	<?= $this->title; ?>	</title>
	<!-- 加载yii样式和js脚本文件 -->
	<link href="assets/css/dpl.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/bui.css" rel="stylesheet" type="text/css" />
	<link href="assets/css/main_i.css" rel="stylesheet" type="text/css">
	
	<!-- <link href="assets/css/yii-main.css" rel="stylesheet" type="text/css" /> -->
	<script type="text/javascript" src="./assets/js/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="./assets/js/bui.js"></script>
	<script type="text/javascript" src="./assets/js/config-min.js"></script>
	<!-- end -->

</head>
<body>

<?php echo $content; ?>


<!--   输出底部运行信息栏	-->
<?php $this->endBody() ?>

</body>
</html>