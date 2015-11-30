<?php

namespace common\models;

use Yii;

/**
 * 全国地区联动
 *
 * @property integer $region_id
 * @property integer $parent_id
 * @property string $region_name
 * @property integer $region_type
 * @property integer $user_id
 * @property integer $sort_order
 */
class Shipping extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shipping}}';
    }
    
    /**
     * 发货
     * @param unknown $data
     */
    public function Doshipping($data){
    	
    	$connection=Yii::$app->db;
    	$transaction = $connection->beginTransaction();
    	$time = time();
    	try{
    		$sql1 = "INSERT INTO {{%shipping}}(shipping_express,shipping_time,shipping_order,shipping_name,shipping_code)
    						 VALUES (:shipping_express,:shipping_time,:shipping_order,:shipping_name,:shipping_code)";
    		$command = $connection->createCommand($sql1);
    		$command->bindParam(":shipping_express",$data['express']);
    		$command->bindParam(":shipping_time",$time);
    		$command->bindParam(":shipping_order", $data['id']);
    		$command->bindParam(":shipping_name",$data['shipping_name']);
    		$command->bindParam(":shipping_code",$data['shipping_code']);
    		$command->execute();
    		$ship_id = Yii::$app->db->getLastInsertID();
    		
    		$sql2 = "UPDATE {{%order_info}} SET shipping_id=:shipping_id,shipping_name=:shipping_name,shipping_time=:shipping_time
    						 WHERE order_id=:id ";
    	
    		$command = $connection->createCommand($sql2);
    		$command->bindParam(":shipping_id",$ship_id);
    		$command->bindParam(":shipping_name",$data['shipping_name']);
    		$command->bindParam(":shipping_time", $time);
    		$command->bindParam(":id", $data['id']);
    		$command->execute();
    		
    		$transaction->commit();
    		return true;
    	} catch (Exception $e) {
    		$transaction->rollBack();
    	}
    	
    	return false;
    }


}
