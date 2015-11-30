<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\Category;
use frontend\models\Goods;
use frontend\models\Brand;

/**
 * UserController implements the CRUD actions for User model.
 */
class CategoryController extends Controller
{
	public function behaviors()
	{
		return [
				[
						'class' => 'yii\filters\PageCache',
						'duration' => 60,
						'variations'=> [
								$_REQUEST['page'],
								$_REQUEST['price_max'],
								$_REQUEST['price_min'],
								$_REQUEST['brand_id'],
								$_REQUEST['cat_id'],
								$_REQUEST['keyword'],
								$_REQUEST['price'],
								$_REQUEST['sell'],
								$_REQUEST['top_cat'],
								$_REQUEST['is_hot'],
								$_REQUEST['is_new'],
								$_REQUEST['is_recommend'],
						],
				],
		];
	}

    /**
     * 分类-品牌等属性检索处理
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
    	/* 初始化分页信息 */
    	$page = isset($_REQUEST['page'])   && intval($_REQUEST['page'])  > 0 ? intval($_REQUEST['page'])  : 1;
    	$data['price_max'] = isset($_REQUEST['price_max']) && intval($_REQUEST['price_max']) > 0 ? intval($_REQUEST['price_max']) : 0;
    	$data['price_min'] = isset($_REQUEST['price_min']) && intval($_REQUEST['price_min']) > 0 ? intval($_REQUEST['price_min']) : 0;
    	$data['brand_id'] = isset($_REQUEST['brand_id']) && intval($_REQUEST['brand_id']) > 0 ? intval($_REQUEST['brand_id']) : 0;
    	$data['is_hot'] = isset($_REQUEST['is_hot']) && intval($_REQUEST['is_hot']) > 0 ? intval($_REQUEST['is_hot']) : 0;
    	$data['is_new'] = isset($_REQUEST['is_new']) && intval($_REQUEST['is_new']) > 0 ? intval($_REQUEST['is_new']) : 0;
    	$data['is_recommend'] = isset($_REQUEST['is_recommend']) && intval($_REQUEST['is_recommend']) > 0 ? intval($_REQUEST['is_recommend']) : 0;
    	$data['cat_id'] = isset($_REQUEST['cat_id']) && intval($_REQUEST['cat_id']) > 0 ? intval($_REQUEST['cat_id']) : 0;
    	$data['keyword'] = !empty($_REQUEST['keyword']) ? trim($_REQUEST['keyword']) : '';

    	// 排序
    	$data['price'] = isset($_REQUEST['price']) && intval($_REQUEST['price']) > 0 ? intval($_REQUEST['price']) : 0;
    	$data['sell'] = isset($_REQUEST['sell']) && intval($_REQUEST['sell']) > 0 ? intval($_REQUEST['sell']) : 0;
    	// 顶级分类，从首页点击分类进来会带上
    	$top_cat = isset($_REQUEST['top_cat']) && intval($_REQUEST['top_cat']) > 0 ? intval($_REQUEST['top_cat']) : 0;
    	
    	if($data['cat_id'] > 0){
    		// 取出大类下的子类id
    		$cat_data = Category::get_all_cat();
    		$data['cat_childen'] = Category::get_cat_childen($cat_data,$data['cat_id']);
    	}
    	
    	/* 实例化商品类，传入接收的数据，返回商品信息 */
    	$goods = new Goods();
    	$goods_data = $goods->get_goods_by_condition($data);
    	
    	if($data['sell']=='1'){
    		$data['sell'] = 2;
    	}elseif ($data['sell']=='2'){
    		$data['sell'] = 1;
    	}
    	
    	if($data['price']>0 && $data['price']=='1'){
    		$data['price'] = 2;
    	}elseif ($data['price']>0 && $data['price']=='2'){
    		$data['price'] = 1;
    	}
    	unset($data['cat_childen']);
    	
    	$sear_data['cat_list'] = $goods_data['cat_list'];
    	$sear_data['brand_list'] = $goods_data['brand_list'];
    	$data['page_count'] = $goods_data['page_count'];
    	unset($goods_data['cat_list'],$goods_data['brand_list'],$goods_data['page_count']);
    	
    	if($_REQUEST['ajax'] == '1'){
    		echo json_encode(['goods_data' => $goods_data,'con'=>$data,'sear_data'=>$sear_data]);
    		exit;
    	}
    	
    	return $this->render('index', ['goods_data' => $goods_data,'con'=>$data,'sear_data'=>$sear_data, 'json_con'=>json_encode($data),'goFrom'=>true]);
    }
    
    
    /**
     * ajax获取指定分类下的品牌
     * @param unknown $cat_id
     * @return string
     */
    public function actionGetbrand($cat_id){
    	$cat_id = intval($cat_id);
    	if($cat_id > 0){
    		
    		$res = Brand::get_cat_brand($cat_id);
    		return json_encode($res);
    	}
    }

    
}
