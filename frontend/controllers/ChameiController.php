<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\OrderInfo;
use frontend\models\Refund;
use frontend\models\frontend\models;

/**
 * 茶妹管理
 */
class ChameiController extends BaseController
{

    /**
     * 成交记录（昨日、今日、近三个月）
     * @return mixed
     */
	public function actionIndex($type=1,$keyword=null)
    {
    		$type = intval($type);
    		$keyword = trim($keyword);
    	    $model = new OrderInfo();
    	    $data = $model->bargain_record($type,$keyword);
    	    
    	    if($keyword){
    	    	return $this->render('record', ['order'=>$data]);
    	    }
			return $this->render('index', ['order'=>$data]);
    }
    
    /**
     * 茶妹发货，交由后台处理
     * @param unknown $id
     * @return \yii\web\Response
     */
    /* public function actionDelivery($id){
    	$id = intval($id);
    	if($id > 0){
    		$model = new OrderInfo();
    		$model->update_order_status($id, SHIPPED);
    	}
    	
    	return $this->redirect(Yii::$app->request->referrer);
    } */
    
    /**
     * 茶妹同意退款，交由后台处理
     * @param unknown $id
     * @return \yii\web\Response
     */
    /* public function actionRefund($id){
    	$id = intval($id);
    	if($id > 0){
    		$refund_id = OrderInfo::findOne($id)->refund_id;
    		if($refund_id > 0){
    			Refund::updateAll(['refund_status'=>AGREE_REFUND], ['refund_id'=>$refund_id] );
    		}
    		
    	}
    	return $this->redirect(Yii::$app->request->referrer);
    } */
    
    /**
     * 订单（退款中，待付款，待发货）
     * @param number $status
     */
    /* public function actionOrder($status){
    	$status = intval($status);
    	if($status > 0){
    		
    		$model = new OrderInfo();
    		$data = $model->bargain_record('','',$status);
    		
    		foreach ($data as &$val){
    			if($val['refund_id'] < 1)
    				continue;
    			// 取出退款状态
    			$refund = Refund::findOne($val['refund_id'])->refund_status;
    			$val['refund_status'] = $refund->refund_status;
    			$val['refund_money'] = $refund->refund_money;
    			
    		}
    		
    		return $this->render('order', ['order'=>$data]);
    	}
    } */

}
