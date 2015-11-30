<?php

namespace backend\controllers;

use Yii;
use backend\models\Goods;
use backend\models\GoodsSearch;
use backend\models\Category;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\UploadedFile;
use backend\models\OrderGoods;
use backend\models\Variety;

/**
 * GoodsController implements the CRUD actions for Goods model.
 */
class GoodsController extends BaseController
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

    public function actions()
    {
    	return [
    			'Kupload' => [
    					'class' => 'pjkui\kindeditor\KindEditorAction',
    			]
    	];
    }
    
    /**
     * Lists all Goods models.
     * @return mixed
     */
    public function actionIndex()
    {	p($_REQUEST['msg']);
    	// 接收关键词检索
    	$_REQUEST['GoodsSearch']['goods_name'] = $_REQUEST['GoodsSearch']['goods_name'] ? $_REQUEST['GoodsSearch']['goods_name'].','.$_REQUEST['GoodsSearch']['goods_name'] : '';
    
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination = ['pagesize'=>10];

        // 取出分类  和 系列   列表
        $data['category'] = 	Category::get_cat_list();
        $data['variety'] = 	Variety::get_variety_list();
     
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        	'data' => $data,
        ]);
    }

    /**
     * Displays a single Goods model.
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
     * Creates a new Goods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Goods();
        $model->setScenario('create');
        
        if ($model->load(Yii::$app->request->post())) {
        
        	if(!empty($_FILES['Goods']['name']['goods_img'])){
        
        		$dir = ROOT_PATH.'common/upload/goods';	// 指定上传目录
        		$image = UploadedFile::getInstance($model, 'goods_img');
        		$ext = $image->extension;
        		$file_name = rand_name($ext);
        		$img_name = $dir.'/'.$file_name;
        
        		if (file_exists($img_name)) {
        			$img_name = $dir.'/'.rand_name($ext);
        		}
        		$image->saveAs($img_name);
        		$model->goods_img = $file_name;
        	}
    
        	if ($model->save()) {
        		return $this->redirect(['index']);
        	}
        }

        return $this->redirect(['index','msg'=>$model->getErrors()]);
    }

    /**
     * Updates an existing Goods model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->setScenario('update');
        $model->tmp_img = $model->goods_img;
        
        if ($model->load(Yii::$app->request->post())) {
        
        	if(!empty($_FILES['Goods']['name']['goods_img'])){
        
        		$dir = ROOT_PATH.'common/upload/goods';	// 指定上传目录
        		$image = UploadedFile::getInstance($model, 'goods_img');
        		$ext = $image->extension;
        		$file_name = rand_name($ext);
        		$img_name = $dir.'/'.$file_name;
        
        		if (file_exists($img_name)) {
        			$img_name = $dir.'/'.rand_name($ext);
        		}
        		$image->saveAs($img_name);
        		$model->goods_img = $file_name;
        	}
        
        	$model->flag = 1;
        	if ($model->update()) {
        		return $this->redirect(['index']);
        	}
        }
        if($model->goods_attr){
        	// 处理商品属性、参数
        	$goods_attr = unserialize($model->goods_attr);
        	$model->goods_attr = NULL;
        	if(is_array($goods_attr)){
        		foreach($goods_attr as $k=>$v){
        			$model->goods_attr .= $k.':'.$v.PHP_EOL;
        		}
        	}
        }
        $data = 	Category::get_all_cat();
        $cat_list = Category::cat_list($data,0,false);
        return $this->renderPartial('update', [
        		'model' => $model,
        		'cat_list' => $cat_list,
        		'brand_arr' => [$model->brand_id=>Brand::get_brand_name($model->brand_id)]
        ]);
    }

    /**
     * Deletes an existing Goods model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
    	
    	// 检查订单商品是否有该商品
    	if(OrderGoods::find()->where(['goods_id'=>$id])->exists()){
    		
    		yii::$app->session->setFlash('failed','删除失败，存在订单与此商品有关的信息');
    		return $this->redirect(Yii::$app->request->referrer);
    	}
    	
    // 删除分类图片
        $model = $this->findModel($id);
        $goods_img = $model->goods_img;
        $goods_gallery = $model->goods_gallery;
        $file = COMMON_PATH.'upload/goods/'.$goods_img;
        
        if($model->delete()){
        	echo json_encode(['msg'=>'删除成功','success'=>1]);
        }else {
        	echo json_encode(['msg'=>'操作失败','error'=>1]);
        }
        
        
       
        // 删除商品图片
        if($goods_img && file_exists($file)){
        	unlink($file);
        }
        // 删除轮播图
        if($goods_gallery){
        	
        	foreach (explode(';', $goods_gallery) as $val){
        		$file = COMMON_PATH.'upload/goods/'.$val;
        		if($val && file_exists($file)){
        			unlink($file);
        		}
        	}
        }
		exit;
    }
    
    /**
     * Finds the Goods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Goods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Goods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * 分类联动
     * @param unknown $cat_id
     */
    public function actionLinkcat($cat_id){
    	 
    	$model = new Brand();
    	$model = $model->getBrandList($cat_id);
    	 
    	foreach($model as $value=>$name)
    	{
    		echo Html::tag('option',Html::encode($name),array('value'=>$value));
    	}
    }
    
    public function actionPrint($data=null){
    	$data = unserialize($data);
    	
    	$searchModel = new GoodsSearch();
    	$dataProvider = $searchModel->search($data);
    	$dataProvider->pagination = ['pagesize'=>10];
    	
    	// 取出分类  和 系列   列表
    	$cat_list = 	Category::get_cat_list();
    	$variety_list = 	Variety::get_variety_list();
    	
    	$data = [];
    	$data['title'] = '产品报表';
    	$data['fileName'] = '产品报表'.date('Y-m-d',time());
    	$data['head'] = ['产品编号','产品名称','产品系列','年份','产品分类','标准价格','出厂价','当前库存','库存上限','库存下限'];
    	
    	foreach ($dataProvider->getModels() as $val){
    		$tmp = [];
			$tmp[] = $val['goods_sn'];
			$tmp[] = $val['goods_name'];
			$tmp[] = $variety_list[$val['variety_id']];
			$tmp[] = $val['goods_year'];
			$tmp[] = $cat_list[$val['cat_id']];
			$tmp[] = $val['goods_price'];
			$tmp[] = $val['factory_price'];
			$tmp[] = $val['goods_number'];
			$tmp[] = $val['warehouse_upper_limit'];
			$tmp[] = $val['warehouse_down_limit'];
			$data['row_data'][] = $tmp;
    	}
  
    	down_xls3($data);
    	exit;
    }
    
    /**
     * 上传轮播图
     * @param unknown $id
     * @return string
     */
    public function actionPlupload(){
    	
    	if(Yii::$app->request->post('goods_id') > 0){
    		// 执行上传
    		$post_data = Yii::$app->request->post();
    		// 取出文件名
    		preg_match_all('/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/', $post_data['goods_gallery'], $arr);
    		if(!empty($arr[1])){
    			foreach($arr[1] as $val){
    				if(!$val)
    					continue;
    				$img_name .= basename($val).';';
    			}
    			rtrim($img_name,';');
    		}

    		$goods = Goods::findOne(Yii::$app->request->post('goods_id'));
    		$goods->goods_gallery = $img_name;
    		$goods->ueditor_data = $post_data['goods_gallery'];
    		$goods->save(false);
    		
    		return $this->redirect(['index']);
    	}
    	
    	$goods = Goods::findOne($_REQUEST['id']);
    	
    	return $this->renderPartial('plupload',['data'=>$goods->ueditor_data]);
    }
}

