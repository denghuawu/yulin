<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Region;
use yii\helpers\Html;

/**
 * ActionController implements the CRUD actions for Action model.
 */
class RegionController extends Controller
{
	// 地区联动
	public function actionGetlink($parent_id)
	{
	
		$model = Region::region_list($parent_id);
	
		foreach($model as $value=>$name)
		{
			echo Html::tag('option',Html::encode($name),array('value'=>$value));
		}
	}
}
