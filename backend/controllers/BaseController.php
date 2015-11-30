<?php

namespace backend\controllers;

use Yii;
use Yii\web\Session;
use backend\models\Action;
use backend\models\Admin;
use backend\models\Role;
use backend\models\ActionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\functions\tools;

/**
 * ActionController implements the CRUD actions for Action model.
 */
class BaseController extends Controller
{
	public $baseInit = true;
	public $layout = 'bui';
	public $title = '';
	
    public function init(){
  
    	// 当前动作
    	$action = Yii::$app->request->get('r');
    	// 打开session
    	$session = Yii::$app->session;
    	$session->open();
    	
    	// 如果没有登录
    	if($_SESSION['admin']['user_id'] < 1 ){
    		return $this->redirect(['/site/login']);
    	}
    	
    	/* 避免重复执行 */
    	/* if(empty($_SESSION['admin']['action_list'])){
    		// 取出导航菜单
    		$action_list = Action::action_nav();
    		$_SESSION['admin']['action_list'] = $action_list;
    		 
    		// 取出当前角色的权限列表
    		$role = Role::role_one($_SESSION['admin']['role_id']);
    		$_SESSION['admin']['my_action'] = explode(',', $role['action_list']);
    	} */

    	/* 检查权限 */ 
		// 获得当前路由访问的控制器和方法
		$action = Yii::$app->request->get('r');
		/* if(!in_array($action, $_SESSION['admin']['my_action'])){
			//跳转到错误
			return $this->redirect(['/index/index', 'error_num' => 404]);
		} */
		
		
    }

}
