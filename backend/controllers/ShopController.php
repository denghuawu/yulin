<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Html;
use common\models\Shop;



/**
 * UserController implements the CRUD actions for User model.
 */
class ShopController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
    	if(Yii::$app->request->post()){
    		$model = new Shop();	
    		foreach(Yii::$app->request->post() as $key=>$val){
    			$model = new Shop();
    			$model->updateAll(['value'=>$val],['code'=>$key]);
    		}
    	}
    	
        $shop = Shop::findBySql("SELECT * FROM cm_shop_config ORDER BY sort_order ASC")->asArray()->all();
        
        return $this->renderPartial('index', ['shop'=>$shop]);
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	$model = $this->findModel($id);
    	$model->sex = $model->sex=='1' ? '男' : '女';
    	$model->reg_time = date('Y/m H:i');
    	$model->last_login = $model->last_login>0 ? date('Y/m H:i') : '未曾登录';
    	$model->parent_id = User::findOne($model->parent_id)['real_name'];
    	$model->user_rank = Rank::get_rank_name($model->user_rank);
        return $this->renderPartial('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        // 指定场景
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->post())) {

        	if(!empty($_FILES['User']['name']['figure'])){
        		
        		$dir = ROOT_PATH.'common/upload/figure';	// 指定上传目录
        		$model->file = UploadedFile::getInstance($model, 'figure');
        		$ext = $model->file->extension;
        		$file_name = rand_name($ext);
        		$img_name = $dir.'/'.$file_name;
        		
        		if (file_exists($img_name)) {
        			$img_name = $dir.'/'.rand_name($ext);
        		}
        		$model->file->saveAs($img_name);
        		$model->figure = $file_name;
        	}
        	
        	
        	if ($model->save()) {
        		return $this->redirect(['index']);
        	}
        }
        
        return $this->renderPartial('create', [
             'model' => $model,
             'rank_list' => Rank::rank_list(),
             'manager_list' => User::manager_list(),
        	 'city_option' => [''=>'请选择'],
        ]);
        
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // 指定场景
        $model->setScenario('update');
        $model->tmp_figure = $model->figure;
        if ($model->load(Yii::$app->request->post())) {
        	
        	if(!empty($_FILES['User']['name']['figure'])){
        	
        		$dir = ROOT_PATH.'common/upload/figure';	// 指定上传目录
        		$model->file = UploadedFile::getInstance($model, 'figure');
        		$ext = $model->file->extension;
        		$file_name = rand_name($ext);
        		$img_name = $dir.'/'.$file_name;
        	
        		if (file_exists($img_name)) {
        			$img_name = $dir.'/'.rand_name($ext);
        		}
        		$model->file->saveAs($img_name);
        		$model->figure = $file_name;
        	}	
        	$model->flag = 1;
        	if ($model->update()) {
        		return $this->redirect(['index']);
        	}

        }
       
        $model->confirm_password = $model->password;
        return $this->renderPartial('create', [
        		'model' => $model,
        		'rank_list' => Rank::rank_list(),
        		'manager_list' => User::manager_list(),
        		'city_option' => [$model->city=>Region::region_name(0,$model->city)],
        ]);
    }


}
