<?php

namespace backend\controllers;

use Yii;
use backend\models\Area;
use backend\models\Admin;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AreaController implements the CRUD actions for Area model.
 */
class AreaController extends Controller
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
     * Lists all Area models.
     * @return mixed
     */
    public function actionIndex()
    {
    	foreach ($_SESSION['admin']['action_list'] as $key => $value) {
    		if(isset($value['child']) && in_arrays($value['child'],$_SESSION['admin']['my_action'])){
    			$json_str = null;
    			$json_str = "id:'".$value['action_code']."', menu:[";
    			$json_str .= "{text:'".$value['action_name']."',items:[";
    			 
    			foreach ($value['child'] as $k => $v) {
    				if(in_array($v['action_url'],$_SESSION['admin']['my_action'])){
    					$json_str .= "{id:'".$v['action_url']."',text:'".$v['action_name']."',href:'index.php?r=".$v['action_url']."'},";
    				}
    			}
    			$json_str .= "]}],";
    			//echo $json_str;
    		}
    	}
        $dataProvider = new ActiveDataProvider([
            'query' => Area::find(),
        ]);

        return $this->renderPartial('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Area model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderPartial('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Area model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Area();
        $model->setScenario('create');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
        	
        	$manage = Admin::getManager();
        	
            return $this->renderPartial('create', [
                'model' => $model,
            	'manage' => $manage,
            ]);
        }
    }

    /**
     * Updates an existing Area model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->setScenario('update');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
        	
        	$manage = Admin::getManager();
            return $this->renderPartial('update', [
                'model' => $model,
            	'manage' => $manage,
            ]);
        }
    }

    /**
     * Deletes an existing Area model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Area model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Area the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Area::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
