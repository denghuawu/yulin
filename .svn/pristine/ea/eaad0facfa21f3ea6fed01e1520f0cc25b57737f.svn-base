<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Goods */

$this->title = '上传轮播图';
$this->params['breadcrumbs'][] = ['label' => 'Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

 <?= $this->render('../layouts/common'); ?>
 
 <script type="text/javascript" charset="utf-8" src="../../ext/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="../../ext/ueditor/ueditor.all.min.js"> </script>
    <script type="text/javascript" charset="utf-8" src="../../ext/ueditor/lang/zh-cn/zh-cn.js"></script>


<form action="index.php?r=goods/plupload" method='post'>
    <h1><?= Html::encode($this->title) ?></h1>

 	<textarea  name='goods_gallery' id='goods_gallery'>
 		<?php echo $data ?>
 	</textarea>
 	<input type='hidden' name='goods_id' value="<?= yii::$app->request->get('id') ?>" />
 	
<div class="form-group">
        <?= Html::submitButton('上传', ['class' => 'btn btn-primary']) ?>
    </div>

<script type="text/javascript">  
var editor = UE.getEditor('goods_gallery',{  
    //这里可以选择自己需要的工具按钮名称,此处仅选择如下五个  
    toolbars:[['simpleupload','insertimage','fullscreen']],  

    //关闭字数统计  
    wordCount:false,  
    //关闭elementPath  
    elementPathEnabled:false,  
    //默认的编辑区域高度  
    initialFrameHeight:300  

}); 

</script>  
