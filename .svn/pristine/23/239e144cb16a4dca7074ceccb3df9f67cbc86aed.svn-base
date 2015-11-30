<?php

namespace backend\controllers;

use Yii;
use common\models\Img;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ImgController implements the CRUD actions for Img model.
 */
class ImgController extends Controller
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
     * Lists all Img models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Img::find(),
        ]);

        return $this->renderPartial('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Img model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Img();
        
        $model->setScenario('create');
        
        
        if ($model->load(Yii::$app->request->post())) {
        
        	if(!empty($_FILES['Img']['name']['name'])){
        
        		$dir = ROOT_PATH.'common/upload/img';	// 指定上传目录
        		$image = UploadedFile::getInstance($model, 'name');
        		$ext = $image->extension;
        		$file_name = rand_name($ext);
        		$img_name = $dir.'/'.$file_name;
        
        		if (file_exists($img_name)) {
        			$img_name = $dir.'/'.rand_name($ext);
        		}
        		$image->saveAs($img_name);
        		$model->name = $file_name;
        	}
        
        	if ($model->save()) {
        		return $this->redirect(['index']);
        	}
        }
		$model->type = 1;
		$model->act_type = 1;
        return $this->renderPartial('create', [
        		'model' => $model,
        ]);
    }

    /**
     * Updates an existing Img model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->setScenario('update');
        $model->tmp_img = $model->name;
        
        if ($model->load(Yii::$app->request->post())) {
        
        	if(!empty($_FILES['Img']['name']['name'])){
        
        		$dir = ROOT_PATH.'common/upload/img';	// 指定上传目录
        		$image = UploadedFile::getInstance($model, 'name');
        		$ext = $image->extension;
        		$file_name = rand_name($ext);
        		$img_name = $dir.'/'.$file_name;
        
        		if (file_exists($img_name)) {
        			$img_name = $dir.'/'.rand_name($ext);
        		}
        		$image->saveAs($img_name);
        		$model->name = $file_name;
        	}
        
        	$model->flag = 1;
        	if ($model->update()) {
        		return $this->redirect(['index']);
        	}
        }
        return $this->renderPartial('update', [
        		'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Img model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        // 删除分类图片
        $model = $this->findModel($id);
        $file = COMMON_PATH.'upload/img/'.$model->name;
        $model->delete();
         
        if($model->name && file_exists($file)){
        	unlink($file);
        }
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Img model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Img the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Img::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
