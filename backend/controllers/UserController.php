<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\User;
use backend\models\UserSearch;
use common\models\Region;


/**
 * 客户管理
 * 接口
 * 显示、添加、编辑、删除客户
 * 显示、添加、编辑、删除联系人
 * 导出excel表
 */
class UserController extends BaseController
{
	public $title = '客户管理';
	
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
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
    	// 接收关键词检索
    	$_REQUEST['UserSearch']['real_name'] = $_REQUEST['UserSearch']['real_name'] ? $_REQUEST['UserSearch']['real_name'].','.$_REQUEST['UserSearch']['real_name'] : '';
    	$_REQUEST['UserSearch']['province_id'] = $_REQUEST['UserSearch']['province_id'] ? $_REQUEST['UserSearch']['province_id'].','.$_REQUEST['UserSearch']['province_id'] : '';
    	$_REQUEST['UserSearch']['sex'] = $_REQUEST['UserSearch']['sex'] ? $_REQUEST['UserSearch']['sex'].','.$_REQUEST['UserSearch']['sex'] : '';
    	$UserSearch = [];
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        // 取出地区
        //$data['region_list'] = $searchModel->user_region($_REQUEST['UserSearch']['province_id']);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        	'data' => $data,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {	
        $model = new Employee();
        $model->setScenario('create');
// 		p($_REQUEST);die;
        $_POST['User']['birthday'] = $_POST['User']['birthday'] ? strtotime($_POST['User']['birthday']) : null;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        
        return $this->redirect(['index','msg'=>$model->getErrors()]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()){
        	return json_encode(['msg'=>'删除成功','success'=>1]);
        }
        
        return json_encode(['msg'=>'操作失败','error'=>1]);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
