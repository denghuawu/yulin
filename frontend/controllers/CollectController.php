<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\Collect;
use frontend\models\UserAddress;
use yii\db\Connection;

/**
 * UserController implements the CRUD actions for User model.
 */
class CollectController extends BaseController
{

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
    	$model = new Collect();
    	$data = $model->get_collect();
    	
        return $this->render('index', ['collect'=>$data]);
    }
    
    /**
     * ajax 添加商品到购物车
     * @param int $goods_id
     * @param int $num
     */
    public function actionAddcart($goods_id,$num){
    	$goods_id = intval($goods_id);
    	$num 	= intval($num);
    	
    	if($goods_id > 0 && $num > 0){
    		$cart = new Cart();
    		$res =  $cart->add_cart($goods_id, $num);
    		echo json_encode($res);
    		exit;
    	}
    	
    	echo json_encode(['code'=>0, 'error'=>'添加购物车失败']);
    	exit;
    }
    
    /**
     * 删除收藏
     * @param unknown $id
     * @return \yii\web\Response
     */
    public function actionDelcollect($id){
    	$id = rtrim($id,',');
    	
    	if(!empty($id)){
    		$connection=Yii::$app->db;
    		$sql = "DELETE FROM cm_collect_goods WHERE collect_id IN ( {$id} )  ";
    		$command = $connection->createcommand($sql);
    		$command->query();
    	}
    	return $this->redirect(Yii::$app->request->referrer);
    }
    
    /**
     * 清空失效收藏
     * @param unknown $cart_id
     */
    public function actionEmpty(){
    	
    	$model = new Collect();
    	$data = $model->get_collect();
    	foreach ($data as $val){
    		if($val['is_updown'] == '0'){
    			$id_str .= $val['collect_id'].',';
    		}
    	}
    	
    	$id_str = rtrim($id_str,',');
    	Collect::deleteAll('collect_id IN ('.$id_str.')');
    	
    	return $this->redirect(['collect/index']);
    }

    protected function findModel($id)
    {
    	if (($model = Cart::findOne($id)) !== null) {
    		return $model;
    	} else {
    		throw new NotFoundHttpException('The requested page does not exist.');
    	}
    }

}
