<?php

namespace backend\controllers;

use Yii;
use backend\models\Action;
use backend\models\ActionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\BaseController;
 
/**
 * 错误跳转处理器
 */
class ErrorController extends Controller
{
	
    public function actionIndex($error_num){
    	return $this->renderPartial($error_num);
    }
}
