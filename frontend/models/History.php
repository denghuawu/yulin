<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "{{%brand}}".
 *
 * @property integer $brand_id
 * @property integer $parent_id
 * @property string $brand_name
 * @property string $brand_logo
 * @property string $brand_desc
 * @property integer $sort_order
 * @property integer $is_show
 */
class History extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%scan_history}}';
    }
    
    /**
     * 取出当前会员的历史浏览记录
     */
    public function get_history_info(){
    	
    	$sql = "SELECT g.goods_name,g.goods_id,g.goods_img,g.goods_price,h.history_id 
    			FROM cm_goods AS g, cm_scan_history AS h
    			WHERE h.goods_id=g.goods_id AND h.user_id={$_SESSION['frontend']['user_id']}";
    	
    	return self::findBySql($sql)->orderBy(['scan_time'=>'DESC'])->asArray()->all();
    }
    
    /**
     * 添加或更新浏览历史
     * @param unknown $goods_id
     * @return boolean
     */
    public function add_history($goods_id){
    	
    	/* 查重 */
    	$scan = self::find()->
    			where('goods_id=:goods_id AND user_id=:user_id', [':goods_id'=>$goods_id, ':user_id'=>$_SESSION['frontend']['user_id']])
    			->one();
    	
    	if($scan && $scan->history_id>0){
    		// 存在则更新浏览时间
    		$scan->scan_time = time();
    		$scan->update();
    	}else{
    		// 不存在则添加
    		$model = new History();
    		$model->user_id = $_SESSION['frontend']['user_id'];
    		$model->goods_id = $goods_id;
    		$model->scan_time = time();
    		$model->save();
    	}
    	
    	return true;
    }
    

}
