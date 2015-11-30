<?php

namespace backend\controllers;

use Yii;
use backend\models\Role;
use backend\models\RoleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Action;
use yii\base\ErrorException;
use yii\base\yii\base;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        

        return $this->renderPartial('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
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
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();


        $post_data = Yii::$app->request->post();
        if(!empty($post_data['Role']['action_list'])){
        	$post_data['Role']['action_list'] = join(',',$post_data['Role']['action_list']);
        }
        
        if ($model->load($post_data) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderPartial('create', [
                'model' => $model,
            	'data'=>Action::action_checkbox(),
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
    	$post_data = Yii::$app->request->post();
    	if(!empty($post_data['Role']['action_list'])){
        	$post_data['Role']['action_list'] = join(',',$post_data['Role']['action_list']);
        }
	
        if ($model->load($post_data)){	
        
		        if(empty($post_data['Role']['action_list'])){
		        	$model->action_list=null;
		        }
        		if($model->save()) {
        			return $this->redirect(['index']);
        		}
            
        } else {
        	
            return $this->renderPartial('update', [
                'model' => $model,
            	'data'=>Action::action_checkbox(),
            ]);
        }
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {	
        //$this->findModel($id)->delete();
        if(Role::role_existed($id)){
        	yii::$app->session->setFlash('failed','删除失败，存在此角色的管理员');
        }else{
        	$this->findModel($id)->delete();
        }
		/*<a href="<?= Url::toRoute('site/logout');?>">退出后台</a>  生成路由fangfa */
        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {

            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
