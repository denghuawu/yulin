<?php 
use yii\helpers\Url;

?>
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