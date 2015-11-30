<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

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
class Brand extends \yii\db\ActiveRecord
{
	public $tmp_img;
	public $flag;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%brand}}';
    }
    
    public function scenarios(){
    	return [
    			'update' => ['cat_id', 'brand_desc','sort_order','is_show','brand_logo','brand_name'],
    			'create' => ['cat_id', 'brand_desc','sort_order','is_show','brand_logo','brand_name'],
    	];
    }
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'sort_order', 'is_show'], 'integer','on'=>['create','update']],
            [['brand_desc'], 'string','on'=>['create','update']],
        	[['brand_name'],'trim', 'on'=>['create','update']],
            [['brand_name','cat_id'], 'required', 'message'=>'必填项不能为空','on'=>['create','update']],
        	[['brand_logo'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png','on'=>['create','update']],
        	[['is_show'], 'default', 'value'=>1,'on'=>['create','update']],
        	[['sort_order'], 'default', 'value'=>0,'on'=>['create','update']],
        	[['brand_name'], 'valideUnique','on'=>['create','update']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => '品牌id',
            'cat_id' => '所属分类',
            'brand_name' => '品牌名称',
            'brand_logo' => '品牌logo',
            'brand_desc' => '品牌描述',
            'sort_order' => '显示序号',
            'is_show' => '是否显示',
        ];
    }
    
    /**
     * 验证品牌是否唯一
     */
    public function valideUnique(){
    	$res = Brand::find()->where(['cat_id'=>$this->cat_id,'brand_name'=>$this->brand_name])->count();
    	if($this->isNewRecord && $res > 0){
    		$this->addError('brand_name','当前分类等级下已存在这个品牌名~！');
    		return false;
    	}
    	
    	return true;
    }
    
    /**
     * 数据插入前处理
     * @param unknown $insert
     * @return boolean
     */
    public function beforeSave($insert)
    {
    	if(parent::beforeSave($insert)){
    		if(!$this->isNewRecord){
    			if($this->flag){
    				// 避免空的值覆盖
    				$this->brand_logo = $this->brand_logo ? $this->brand_logo : $this->tmp_img;
    			}
    		}
    		return true;
    	}else{
    		return false;
    	}
    }
    
    /**
     * 取出所有品牌
     */
    public static  function brand_list(){
    	$data = Brand::find(['select'=>['brand_id','brand_name']])->asArray()->all();

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
     * 返回品牌名
     * @param unknown $id
     */
	public static function get_brand_name($id){
		if($id < '1')
			return '无';
		return Brand::findOne($id)['brand_name'];
	}
}
