<?php

namespace backend\controllers;

use Yii;
use backend\models\Admin;
use backend\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Role;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends BaseController
{
	
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                	'onBeforeSave'=>'beforeSave',
                ],
            ],
        ];
    }
    
    public function actions() {
    	return [
    			'captcha' =>  [
    					'class' => 'yii\captcha\CaptchaAction',
    					'height' => 50,
    					'width' => 80,
    					'minLength' => 4,
    					'maxLength' => 4
    			],
    	];
    }
    
    /**
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderPartial('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderPartial('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Admin();
        $model->scenario = 'create';
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
    
            return $this->redirect(['index']);
        } else {
            return $this->renderPartial('create', [
                'model' => $model,
            	'data'=>Role::role_list(),
            ]);
        }
    }

    /**
     * Updates an existing Admin model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('create');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {	
        	$model->comfirm_password = $model->password;
        	$model->flag = 1;
            return $this->renderPartial('update', [
                'model' => $model,
            	'data'=>Role::role_list(),

            ]);
        }
    }

    /**
     * Deletes an existing Admin model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    

    /**
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    
}
