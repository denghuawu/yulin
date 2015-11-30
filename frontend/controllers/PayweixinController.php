<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Weixin;
use yii\helpers\Url;
use frontend\models\OrderInfo;
use frontend\models\OrderGoods;

/**
 * Native（原生）支付-模式二
 * ====================================================
 * 商户生成订单，先调用统一支付接口获取到code_url，
 * 此URL直接生成二维码，用户扫码后调起支付。
 * 
*/
class PayweixinController extends BaseController
{
	//private $pay_ok_url='http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'?r=payweixin/pay_ok';//接收微信成功地址
	private $native='NATIVE';//交易类型
	/*
	*支付
	*/

	public function actionUnify(){
		//校验参数的合法性
        $request=Yii::$app->request;
        $oid=$request->get('id');//订单Id
        //根据订单ID查询出要支付的金额
        $OrderGObj=new OrderInfo;
        $arr=$OrderGObj->getOrderMoney($oid);
        $newArr=$arr[0];
        $_SESSION['order_id']=$oid;
        $osn=$newArr['osn'];
        $oid=$newArr['oid'];
        //$pay_fee=((int) ($newArr['pay_fee']*100));
        $pay_fee=1;
        if (empty($osn) && !is_string($osn) && $osn<=0) {
        	$this->pay_messgae('支付失败！');
        }
        if (empty($osn) && !is_string($osn) && $osn<=0) {
        	$this->pay_messgae('支付失败！');
        }
        if (empty($pay_fee) && !is_int($pay_fee) && $pay_fee<=0) {
        	$this->pay_messgae('支付失败！');
        }
        if($_SERVER["HTTP_X_FORWARDED_FOR"]==""){
			$user_ip=$_SERVER["REMOTE_ADDR"];
		}else{
			$user_ip=$_SERVER["HTTP_X_FORWARDED_FOR"];
		}
		$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'].'?r=payweixin/pay_ok';
		$timeStamp = time();
		$out_trade_no ="123";
		//使用统一支付接口
		$unifiedOrder = new Weixin();
		//设置统一支付接口参数
		//设置必填参数
		$unifiedOrder->setParameter("appid",APPID);//公众账号ID
	   	$unifiedOrder->setParameter("mch_id",MCHID);//商户号
	   	$unifiedOrder->setParameter("device_info",WEB);//设备号
	   	$unifiedOrder->setParameter("nonce_str",$unifiedOrder->createNoncestr());//随机字符串
	   	$unifiedOrder->setParameter("body",$osn);//商品描述
		$unifiedOrder->setParameter("out_trade_no",$oid);//商户订单号
		$unifiedOrder->setParameter("total_fee",$pay_fee);//总金额
		$unifiedOrder->setParameter("spbill_create_ip",$user_ip);//生成订单终端IP
		$unifiedOrder->setParameter("notify_url",$url);//通知地址 
		$unifiedOrder->setParameter("trade_type",$this->native);//交易类型
		//$unifiedOrder->setParameter("time_expire",$timeStamp);//交易结束时间

		//spbill_create_ip已填,商户无需重复填写
		//sign已填,商户无需重复填写
		//$unifiedOrder->setParameter("auth_code",'817036');
		//非必填参数，商户可根据实际情况选填
		//$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号  
		//$unifiedOrder->setParameter("device_info","XXXX");//设备号 
		//$unifiedOrder->setParameter("attach","XXXX");//附加数据 
		//$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
		//$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间 
		//$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记 
		//$unifiedOrder->setParameter("openid","XXXX");//用户标识
		//$unifiedOrder->setParameter("product_id","XXXX");//商品ID
		
		//获取统一支付接口结果
		$unifiedOrderResult = $unifiedOrder->getResult();
			
		//商户根据实际情况设置相应的处理流程
		if ($unifiedOrderResult["return_code"] == "FAIL") 
		{
			//商户自行增加处理流程
			echo "通信出错：".$unifiedOrderResult['return_msg']."<br>";
		}
		elseif($unifiedOrderResult["result_code"] == "FAIL")
		{
			//商户自行增加处理流程
			echo "错误代码：".$unifiedOrderResult['err_code']."<br>";
			echo "错误代码描述：".$unifiedOrderResult['err_code_des']."<br>";
		}
		elseif($unifiedOrderResult["code_url"] != NULL)
		{
			//从统一支付接口获取到code_url
			$code_url = $unifiedOrderResult["code_url"];
			//商户自行增加处理流程
			return $this->redirect('../../yulin_erweima/index.php?url='.$code_url);
		}
	}

	/*
	*接收微信通知信息
	*/
	public function actionPay_ok(){
		echo 'ok';
	}

	/*
	* 错误提示
	*/	
	public function pay_messgae($str){
        $msg['message'] = $str;
                $msg['error'] = 1;
                $msg['link'] = [
                ['title'=>'返回首页','href'=>'index.php?r=index/index'],
            ];
            return $this->redirect(['/site/message', 'msg'=>$msg]);
    }

}