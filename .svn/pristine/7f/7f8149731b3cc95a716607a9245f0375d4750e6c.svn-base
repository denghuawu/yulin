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
class Collect extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%collect_goods}}';
    }

    /**
     * 收藏或取消收藏商品
     * @param int $goods_id
     * @return multitype:
     */
    public function collect_goods($goods_id){
    	
    	$res = self::find()->where(['goods_id'=>$goods_id, 'user_id'=>$_SESSION['frontend']['user_id']])->one();
    	
    	if($res){
    		// 为真删除收藏
    		$model = self::findOne($res->collect_id);
    		$count = $model->delete();
    	}else{
    		// 添加收藏
    		$model = new Collect();
    		$model->goods_id = $goods_id;
    		$model->user_id = $_SESSION['frontend']['user_id'];
    		$model->add_time = time();
    		$count = $model->save();
    	}
    	
    	if($count > 0){
    		return true;
    	}else{
    		return false;
    	}
    }
    
    /**
     * 取出当前会员的所有收藏
     * @param number $type
     */
    public function get_collect(){
    	
    	$sql = "SELECT g.goods_id,g.goods_name,g.goods_price,g.goods_img,g.is_updown,c.collect_id,c.add_time
    			FROM cm_collect_goods AS c , cm_goods AS g 
    			WHERE c.goods_id=g.goods_id AND c.user_id={$_SESSION['frontend']['user_id']}
    			ORDER BY c.add_time DESC
    			";
    	
    	return self::findBySql($sql)->asArray()->all();
    	
    }
    
    /**
     * 是否已收藏商品
     * @param unknown $goods_id
     */
    public static function is_collect($goods_id){
    
    	if(self::find()->where(['goods_id'=>$goods_id, 'user_id'=>$_SESSION['frontend']['user_id']])->exists()){
    		return 1;
    	}else{
    		return '';
    	}
    }
    
    /**
     * 清空失效收藏
     */
    public function emptyCollect(){
    	
    	 
    }


}
