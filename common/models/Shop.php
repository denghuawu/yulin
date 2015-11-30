<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%shop_config}}".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $name
 * @property string $code
 * @property string $type
 * @property string $store_range
 * @property string $store_dir
 * @property string $value
 * @property integer $sort_order
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort_order'], 'integer'],
            [['name', 'value','code'], 'required'],
            [['name', 'store_range', 'store_dir'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 30],
            [['type'], 'string', 'max' => 10],
            [['value'], 'string', 'max' => 500],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'code' => 'Code',
            'type' => 'Type',
            'store_range' => 'Store Range',
            'store_dir' => 'Store Dir',
            'value' => 'Value',
            'sort_order' => 'Sort Order',
        ];
    }
    
    public static  function get_shop(){
    	
    	$res = self::find()->asArray()->all();
    	$con = [];
    	
    	if($res){
    		foreach ($res as $val){
    			$con[$val['code']] = $val['value'];
    		}
    	}
        return $con;
    } 
}
