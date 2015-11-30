<?php

namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use backend\models\Goods;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pagesize'=>10];

        return $this->renderPartial('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        $model->setScenario('create');
        
        if ($model->load(Yii::$app->request->post())) {
        
        	if(!empty($_FILES['Category']['name']['category_img'])){
        
        		$dir = ROOT_PATH.'common/upload/category';	// 指定上传目录
        		$image = UploadedFile::getInstance($model, 'category_img');
        		$ext = $image->extension;
        		$file_name = rand_name($ext);
        		$img_name = $dir.'/'.$file_name;
        
        		if (file_exists($img_name)) {
        			$img_name = $dir.'/'.rand_name($ext);
        		}
        		$image->saveAs($img_name);
        		$model->category_img = $file_name;
        	}
        
        	if ($model->save()) {
        		return $this->redirect(['index']);
        	}
        }
        $model->is_hot = 1;
        $model->is_show = 1;
        $data = 	Category::get_all_cat();
        $cat_list = Category::cat_list($data,0,true);
        return $this->renderPartial('create', [
        		'model' => $model,
        		'cat_list' => $cat_list,
        ]);
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->setScenario('update');
        $model->tmp_img = $model->category_img;
        
        if ($model->load(Yii::$app->request->post())) {
        
        	if(!empty($_FILES['Category']['name']['category_img'])){
        
        		$dir = ROOT_PATH.'common/upload/category';	// 指定上传目录
        		$image = UploadedFile::getInstance($model, 'category_img');
        		$ext = $image->extension;
        		$file_name = rand_name($ext);
        		$img_name = $dir.'/'.$file_name;
        
        		if (file_exists($img_name)) {
        			$img_name = $dir.'/'.rand_name($ext);
        		}
        		$image->saveAs($img_name);
        		$model->category_img = $file_name;
        	}
        
        	$model->flag = 1;
        	if ($model->update()) {
        		return $this->redirect(['index']);
        	}
        }
        
        $data = 	Category::get_all_cat();
        $cat_list = Category::cat_list($data,0,true);
        return $this->renderPartial('update', [
        		'model' => $model,
        		'cat_list' => $cat_list,
        ]);
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	// 检查该分类是否关联商品
    	if(Goods::find()->where(['cat_id'=>$id])->exists()){
    	
    		yii::$app->session->setFlash('failed','删除失败，存在商品与此分类有关联');
    		return $this->redirect(Yii::$app->request->referrer);
    	}
    
        // 删除分类图片
        $model = $this->findModel($id);
        $file = COMMON_PATH.'upload/category/'.$model->category_img;
        $model->delete();
       
        if($model->category_img && file_exists($file)){
        	unlink($file);
        }
        
        return $this->redirect(['index']);
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
