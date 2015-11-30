<?php
/* 
 * 定义各种常量
 *  */

define('COMMON', '/common');

// 交易流程
define('UNPAYED', 1);	//	状态-》已下单，未付款 	 动作=》付款，取消订单
define('PAYED', 2);		//	状态-》已付款 （等待商家发货）	 	动作=》申请售后
define('SHIPPED', 3);	//	状态-》已发货  		动作=》确认收货	申请售后
define('FINISHED', 4);	//	状态-》已收货  （交易完成）		动作=》申请售后
define('COMMENTED', 5);	//	状态-》交易完成（已评价）
define('RETURNED', 6);	//	状态-》退货退款 		动作=》取消退货
define('CANCEL', 7);	//	状态-》已取消订单		动作=》恢复订单
define('FAILED', 8);	//	状态-》交易失败

// 退款状态
define('APPLY_REFUND', 1);	// 客户申请退款（填写退款资料）
define('AGREE_REFUND', 2);	// 茶妹同意退款（交给后台处理）
define('SUCCESS_REFUND', 3);	// 后台填写退款信息（微信转账流水号）
define('FAIL_REFUND', 4);		// 退款失败

// 微信
//define('APPID', 'wxec407ab76208d834');
//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
const APPID = 'wxec407ab76208d834';
//受理商ID，身份标识
const MCHID = '1269667101';
//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
const KEY = 'dsjaflkLHJLK65123hkhsjlGIGN6fsds';

define('SECRET', '6f8c5a4a29a3b8c0e8f9fe822830d696');
$appid = APPID;
$secret = SECRET;

//物流
define('DBKH',1);  //德邦卡航
define('DBQY',2);  //德邦汽运
define('SFKJ',11);  //顺丰标准快件

