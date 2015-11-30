<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

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
class Brand extends Model
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%brand}}';
    }
    
    
    /**
     * 取出所有品牌（显示的，排序，取出指定个数的品牌）
     */
    public static  function brand_list($num){
    	$data = Brand::find(['select'=>['brand_id','brand_name']])->where(['is_show'=>1])->asArray()->orderBy('sort_order')->batch($num);

    	foreach($data as $val){
    		$arr[$val['brand_id']] = $val['brand_name'];

    	}
    	return $arr;
    }
    
    /**
     * @param $pid
     * @return array
     */
    public function getBrandList($cat_id)
    {
    	$model = Brand::findAll(array('cat_id'=>$cat_id));
    	return ArrayHelper::map($model, 'brand_id', 'brand_name');
    }
    
    /**
     * 获得指定分类的所有品牌
     * @param unknown $cat_id
     */
    public static function get_cat_brand($cat_id){
    	if($cat_id > 0){
    		
    		return (new \yii\db\Query())->select('brand_id, brand_name')
    		->from('cm_brand')
    		->where('cat_id=:cat_id',[':cat_id'=>$cat_id])
    		->all();
    	}
    	
    } 
    
    /**
     * 返回品牌名
     * @param unknown $id
     */
	public static function get_brand_name($id){
		if($id < '1')
			return '无';
		return Brand::findOne($id)['brand_name'];
	}
}
