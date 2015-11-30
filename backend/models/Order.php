<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%order_info}}".
 *
 * @property string $order_id
 * @property string $order_sn
 * @property string $user_id
 * @property integer $order_status
 * @property integer $shipping_status
 * @property integer $pay_status
 * @property string $address
 * @property integer $shipping_id
 * @property string $shipping_name
 * @property integer $pay_id
 * @property string $pay_name
 * @property string $goods_amount
 * @property string $shipping_fee
 * @property string $pay_fee
 * @property string $order_amount
 * @property string $add_time
 * @property string $confirm_time
 * @property string $pay_time
 * @property string $shipping_time
 * @property string $extension_code
 * @property string $message
 */
class Order extends \yii\db\ActiveRecord
{
	public $user;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => '订单id',
            'order_sn' => '订单号',
            'user_id' => '会员id',
            'order_status' => '订单状态',
            'shipping_status' => '发货状态',
            'pay_status' => '支付状态',
            'address' => '收货地址',
            'shipping_id' => '发货id',
            'shipping_name' => '快递名称',
            'pay_id' => '支付id，管理支付表',
            'pay_name' => '支付名称',
            'goods_amount' => '商品总数',
            'shipping_fee' => '快递费用',
            'pay_fee' => '支付费用',
            'order_amount' => '订单总额',
            'add_time' => '添加时间',
            'confirm_time' => '交易完成时间',
            'pay_time' => '支付时间',
            'shipping_time' => '发货时间',
            'extension_code' => '扩展码',
            'message' => '客户给商家的留言',
            'user' => '会员',
        ];
    }

    /**
     * @inheritdoc
     * @return OrderInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderInfoQuery(get_called_class());
    }
    
    /**
     * 退款
     * @param unknown $data
     */
    public function doRefund($data){
    	
    	$connection=Yii::$app->db;
    	$transaction = $connection->beginTransaction();
    	$time = time();
    	try{
    		$sql1 = "UPDATE cm_refund SET refund_money=:refund_money,trade_no=:trade_no,refund_status=:status WHERE refund_id=:refund_id ";
    		$command = $connection->createCommand($sql1);
    		$status = SUCCESS_REFUND;
    		$command->bindParam(":refund_money",$data['refund_money']);
    		$command->bindParam(":trade_no",$data['trade_no']);
    		$command->bindParam(":refund_id",$data['refund_id']);
    		$command->bindParam(":status",$status);
    		$command->execute();
    	
    		$sql2 = "UPDATE cm_order_info SET order_status=:status WHERE order_id=:id ";
    		
    		$status = FINISHED;
    		$command = $connection->createCommand($sql2);
    		$command->bindParam(":status",$status);
    		$command->bindParam(":id",$data['id']);
    		$command->execute();
    	
    		$transaction->commit();
    		return true;
    	} catch (Exception $e) {
    		$transaction->rollBack();
    	}
    	
    	return false;
    }
}
