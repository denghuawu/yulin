<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%img}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $type
 * @property string $url
 * @property integer $sort_order
 */
class Img extends \yii\db\ActiveRecord
{
	public $tmp_img;
	public $flag;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%img}}';
    }
    
    public function scenarios(){
    	return [
    			'create' => ['name','url','sort_order','type','act_type','is_show'],
    			'update' => ['name','url','sort_order','type','act_type','is_show'],
    	];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','url'], 'required', 'on'=>['create']],
            [['type', 'sort_order'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 255],
        	[['name'], 'file', 'extensions' => 'jpg, png', 'mimeTypes' => 'image/jpeg, image/png'],
        	[['sort_order'], 'default', 'value'=>0],
        	[['type'], 'default', 'value'=>1],
        	[['act_type'], 'default', 'value'=>1],
        	[['is_show'], 'default', 'value'=>1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => '首页广告图',
            'url' => '跳转地址',
            'sort_order' => '排序',
        	'type' => '类型',
        	'act_type' => '推荐类型',
        	'is_show' => '是否显示',
         ];
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
    				$this->name = $this->name ? $this->name : $this->tmp_img;
    			}
    		}
    		return true;
    	}else{
    		return false;
    	}
    }
}
