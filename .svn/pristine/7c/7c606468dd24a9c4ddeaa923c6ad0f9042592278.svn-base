<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use backend\models\Admin;
use backend\models\Role;
use backend\models\Action;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
              'access' => [
                'class' => AccessControl::className(),
              	'only' => ['login','logout','reset'],
                'rules' => [
                    [
                        'actions' => ['login', 'index'],
                        'allow' => true,
                    	'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['reset'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],

                ],
            ], 
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    public function init(){}

    public function actionIndex()
    {	

        return $this->render('index');
    }

    public function actionLogin()
    {	
        $model = new Admin();
        if ($model->load(Yii::$app->request->post()) && $model->login(Yii::$app->request->post())) {
        	
        	/* 避免重复执行 ,取出菜单列表，权限行为  */
        	
        		// 取出导航菜单
        		$_SESSION['admin']['action_list'] = null;
        		$_SESSION['admin']['my_action'] = null;
        		$action_list = Action::action_nav();	
        		$_SESSION['admin']['action_list'] = $action_list;
        		
        		// 取出当前角色的权限列表
        		$role = Role::role_one($_SESSION['admin']['role_id']);
        		$_SESSION['admin']['my_action'] = explode(',', $role['action_list']);
        	
        		return $this->redirect('index.php');
        	
        } else {
        	$this->layout= false;
            return $this->renderPartial('login', [
                'model' => $model,
            ]);
        }
    }
    
    // 注销登录
    public function actionLogout()
    {	
    	$session = Yii::$app->session;
    	$session->open();
    	$_SESSION['admin'] = array();
    	$session->destroy('admin');
    	$session->close();
    	 
    	 return $this->renderPartial('login');
    }
    
    // 编辑个人资料
    public function actionReset()
    {
    
    	$model = Admin::findOne($_SESSION['admin']['user_id']);
    	$model->setScenario('reset');
    	 
    	if ($model->load(Yii::$app->request->post())) {
    		if($model->validate()){
    			$model->password = md5($model->comfirm_password);
    			$model->update(false);
    			// 重新登录
    			yii::$app->session->setFlash('warnning','请重新登录！');
    			$this->redirect(['logout']);
    		}
    	}
    	
    	$model->password = null;
    	return $this->renderPartial('reset',['model'=>$model]);
    	
    }
    

    /* public function actionLogout()
    {	
    	$session = Yii::$app->session;
    	$session->open();
    	$_SESSION['admin'] = array();
    	$session->destroy('admin');
    	$session->close();
    
    	return $this->redirect(['login']);
    } */
}
