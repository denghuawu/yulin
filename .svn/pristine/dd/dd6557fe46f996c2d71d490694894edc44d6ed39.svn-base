<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\User;

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
                'only' => ['signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {	
        return $this->redirect(['index/index']);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $model = new User();
       	$model->setScenario('login');
       
        if ($model->load(Yii::$app->request->post())) {
        	if($model->login()){
        		return $this->redirect(['user/index']);
        	}
        }
        
        return $this->render('login', [
            'model' => $model,
            'errors' => $model->getErrors(),
        ]);
        
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {	
        unset($_SESSION['frontend']);
        
        return $this->redirect(['index/index']);
    }


    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {	
        $model = new User(['scenario'=>'signup']);
        
        if ($model->load(Yii::$app->request->post())) {	
        	$model->user_name = $model->mobile_phone;
            if ($model->save()) {
            	// 注册用户后，自动登录
                if ($model->login($model)) {
                	$msg = ['message'=>'恭喜您，注册成功~！'];
                    return $this->render('message', ['msg'=>$msg]);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        	'errors' => $model->getErrors(),
        ]);
    }
    
    public function actionLost(){
    	return $this->render('lost');
    }
    
    public function actionMenu(){
    	makeMenu();
    	echo 'it is over!';
    }

    /**
     * 显示信息提示页面
     * @return Ambigous <string, string>
     */
    public function actionMessage(){
    	return $this->render('message', ['msg'=>yii::$app->request->get('msg')]);
    }
}
