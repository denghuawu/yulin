<?php

namespace backend\controllers;

use Yii;
use backend\models\FieldOption;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FieldOptionController implements the CRUD actions for FieldOption model.
 */
class FieldOptionController extends Controller
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
     * Lists all FieldOption models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => FieldOption::find(),
        ]);

        return $this->renderPartial('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new FieldOption model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FieldOption();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
        	$parent_option = FieldOption::get_parent_option();
            return $this->renderPartial('create', [
                'model' => $model,
            	'parent_option' => $parent_option,
            ]);
        }
    }

    /**
     * Updates an existing FieldOption model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->render('index');
        } else {
        	$parent_option = FieldOption::get_parent_option();
            return $this->renderPartial('update', [
                'model' => $model,
            	'parent_option' => $parent_option,
            ]);
        }
    }

    /**
     * Deletes an existing FieldOption model.
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
     * Finds the FieldOption model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FieldOption the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FieldOption::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
