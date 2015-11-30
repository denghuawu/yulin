<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%area}}".
 *
 * @property string $area_id
 * @property string $area_name
 * @property integer $admin_id
 * @property integer $area_sort
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%area}}';
    }
    
    public function scenarios()
    {
    	return [
    			'update' => ['area_name', 'admin_id','admin_id', 'area_sort'],
    			'create' => ['area_name', 'admin_id','admin_id', 'area_sort'],
    	];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_name', 'admin_id'], 'required' , 'on'=>['create','update']],
            [['admin_id', 'area_sort'], 'integer', 'on'=>['create','update']],
            [['area_name'], 'unique', 'on'=>['create','update']],
            [['area_sort'], 'default', 'value'=>1],
            [['area_name'], 'string', 'max' => 255, 'on'=>['create','update']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'area_id' => 'id',
            'area_name' => '区域名称',
            'admin_id' => '大区经理',
            'area_sort' => '排序',
        ];
    }
}
