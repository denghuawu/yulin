<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\OrderInfo;
use frontend\models\Goods;


/**
 * 定时任务
 */
class TaskController extends Controller
{

    /**
     * 检测超过指定天数没有确认收货的订单
     * @return mixed
     */
    public function actionIndex()
    {
    	// 检查过期没有确认收货的订单
    	$model = new OrderInfo();
    	$model->check_order();
    	
    	// 检查过期没有付款的订单
    	$model->check_unpay();
    	
    	// 检查库存为0的，仍然处于上架状态的
    	$goods = new Goods();
    	$goods->check_updown();
    	echo 1;
    	exit;
    }
    

}
