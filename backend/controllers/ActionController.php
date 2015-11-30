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
 * ActionController implements the CRUD actions for Action model.
 */
class ActionController extends Controller
{
	//public $enableCsrfValidation = false;
	
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
     * Lists all Action models.
     * @return mixed
     */
    public function actionIndex()
    {

   
        $searchModel = new ActionSearch(); 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pagesize' => '6'];

        return $this->renderPartial('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Action model.
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
     * Creates a new Action model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Action();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->action_id]);
        } else {
        	
        	$data = $model->action_list();
            return $this->renderPartial('create', [
                'model' => $model,
            	'data'=>$data,
            ]);
        }
    }

    /**
     * Updates an existing Action model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->action_id]);
        } else {
        	$data = $model->action_list();
        	
            return $this->renderPartial('update', [
                'model' => $model,
            	'data'=>$data,
            ]);
        }
    }

    /**
     * Deletes an existing Action model.
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
     * Finds the Action model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Action the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Action::findOne($id)) !== null) {
		
        	// 取出上级菜单
        	//$model[] = Action::find()->where(['action_id'=>$model['attributes']['parent_id']])->one()['action_name'];
        	
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
