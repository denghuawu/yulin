<?php
namespace frontend\controllers;

use Yii;
use frontend\models\OrderInfo;
use frontend\models\OrderGoods;
use yii\web\Controller;



/*
* 支付
*/
class PaymoneyController extends BaseController{
	public $layout;
	/*
	* 支付首页
	*/
	public function actionIndex(){
		//校验参数的合法性
        $request=Yii::$app->request;
        $oid=$request->get('id');//订单Id
        //根据订单ID查询出要支付的金额
        $OrderGObj=new OrderInfo;
        $arr=$OrderGObj->getOrderMoney($oid);
        $_SESSION['order_id']=$oid;
        $str="<li>快递费：".$arr[0]['exp_money']."</li><li>支付总金额：".$arr[0]['order_amount']."</li>";
        $msg['message'] = $str;
                $msg['error'] = 1;
                $msg['link'] = [
                ['title'=>'确认支付','href'=>'index.php?r=paymoney/end'],
            ];
            return $this->redirect(['/site/message', 'msg'=>$msg]);
    }
    /*
	* 支付完成
	*/
	public function actionEnd(){
		$this->layout="header";
		//更改订单转态
		$OrderGObj=new OrderInfo;
		$re=$OrderGObj->upStatus($_SESSION['order_id'],PAYED);
        return $this->render('end');
	}
	/*
	* 错误提示
	*/	
	public function pay_messgae($str){
        $msg['message'] = $str;
                $msg['error'] = 1;
                $msg['link'] = [
                ['title'=>'确认支付','href'=>'index.php?r=paymoney/end'],
            ];
            return $this->redirect(['/site/message', 'msg'=>$msg]);
    }

}
