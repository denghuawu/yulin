<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use backend\models\Brand;

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
class Category extends ActiveRecord
{
	public static  $cat_childen = array();
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }
    
    //获取所有的顶级分类
    public  static function get_cate(){
        return Category::findBySql('SELECT cat_id,parent_id,cat_name FROM yl_category WHERE parent_id = 0 ORDER BY sort_order ASC')->asArray()->all();
    }

    /**
     * 关联品牌表
     * @return ActiveQuery
     */
    public function getBrand(){
    	// 第一个参数为要关联的子表模型类名，
    	// 第二个参数指定 通过子表的customer_id，关联主表的id字段
    	return $this->hasMany(Brand::className(), ['cat_id' => 'cat_id']);
    }
    
    /**
     * 取出所有品牌（显示的，排序，取出指定个数的品牌）
     */
    public static  function cat_list($num){
    	return Category::find()->where(['is_show'=>1])->asArray()->orderBy('sort_order')->all();

    }
    
    /**
     * 获得分类下的所有品牌
     * @param unknown $cat_id
     */
    public static function get_cat_brand($cat_id){
    	
    	static $brand;
    
    	$data = Category::find(['select'=>['cm_brand.brand_id,cm_category.parent_id']])->where(['cm_category.cat_id'=>$cat_id])->joinWith('brand')->asArray()->all();
    	if($data[0]['brand']){
    		foreach($data[0]['brand'] as $val){
    			$brand[] = $val['brand_id'];
    		}

    		// 找子分类下的品牌
    		self::get_cat_brand($data[0]['parent_id']);
    	}
    	
    	return $brand;
    }
    
    /**
     * 获得指定分类下的所有商品
     * @param unknown $brand_id
     */
    public function get_cat_goods($brand_id){
    	 
    	$where = $attr['min_price'];	//价格区间
    	$where = $attr['max_price'];	//价格区间
    	$order = $attr['sell'];	//销量
    	$order = $attr['price'];	//价格
    	 
    	$brand_id = intval($brand_id);
    	if($brand_id > 0){
    
    
    
    		$data = Goods::find()->where(['cm_goods.brand_id'=>$brand_id])->joinWith('brand')->asArray()->all();
    		
    	}
    	 
    }
    
    /**
     * 获得指定分类下所有底层分类的ID
     */
    public static function get_cat_childen(&$data,$cat_id=0){

    	self::$cat_childen[] = $cat_id;
    	if($data){
    		foreach ($data as $key => $value){	
    			if($value['parent_id']==$cat_id){
					self::$cat_childen[] = intval($value['cat_id']);	
					unset($data[$key]);
    				self::get_cat_childen($data,$value['cat_id']);
    			}
    		}
    	}
    	return array_unique(self::$cat_childen);
    }
    
    public static function get_all_cat(){
    	return Category::find(['select'=>'cat_id,parent_id,cat_name'])->asArray()->all();
    }
    
    public static function get_one_cat($id){
    	return Category::find()->where('cat_id=:id',[':id'=>$id])->asArray()->one();
    }


}
