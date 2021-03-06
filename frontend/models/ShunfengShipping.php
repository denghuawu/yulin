<?php
namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
class ShunfengShipping extends ActiveRecord{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {

        return '{{%shunfeng_shipping}}';
    }
    /**
     * 根据地区id查询出该地区的物流基数
     */
    public function getCar($province,$city){
    	if (empty($province) || empty($city)) {
    		return false;
    	}
    	$sql='SELECT * FROM {{%shunfeng_shipping}} WHERE province=:p and city=:c ';
        $data= DebangShipping::findBySql($sql,array(':p'=>$province,':c'=>$city))->asArray()->all();
        return $data;
    }
}