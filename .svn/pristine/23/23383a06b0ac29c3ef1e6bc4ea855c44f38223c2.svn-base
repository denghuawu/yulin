<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
 
/**
 *控制器调用之前执行一段代码
 */
class BaseController extends Controller
{
	//判断当前用户是否登录，将用户的登录信息存入session中
	public function init(){
		// 开启session
		if(empty($_SESSION['frontend']['user_id']) || ($_SESSION['frontend']['user_id']<1)){
			
			Yii::$app->session->setFlash('failed', '请先登录~！');
			
			return $this->redirect(['/login/index']);
		}
	}
}
