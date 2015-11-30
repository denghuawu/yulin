<?php

namespace backend\controllers;

use Yii;
use backend\models\Rank;
use backend\models\RankSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\User;

/**
 * RankController implements the CRUD actions for Rank model.
 */
class RankController extends Controller
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
     * Lists all Rank models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RankSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderPartial('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rank model.
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
     * Creates a new Rank model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rank();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderPartial('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rank model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderPartial('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Rank model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	// 检查此等级下是否有会员
    	if(User::find()->where(['user_rank'=>$id])->exists()){
    	
    		yii::$app->session->setFlash('failed','删除失败，存在会员与此等级有关联');
    		return $this->redirect(Yii::$app->request->referrer);
    	}
    	
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Rank model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rank the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rank::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
