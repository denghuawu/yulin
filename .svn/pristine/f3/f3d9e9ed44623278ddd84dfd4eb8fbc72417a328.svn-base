<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%field_option}}".
 *
 * @property integer $id
 * @property string $option_code
 * @property string $option_name
 * @property integer $option_value
 */
class FieldOption extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%field_option}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_value'], 'integer'],
            [['option_code'], 'string', 'max' => 50],
            [['option_name'], 'string', 'max' => 255],
            [['option_name'], 'required'],
            [['parent_id','option_value'], 'default', 'value' => ''],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'option_code' => '选项标记',
            'option_name' => '选项名',
            'option_value' => '选项值',
        	'parent_id' => '选项类别',
        ];
    }
    
    public static function get_parent_option(){
    	
    	$model = self::findAll(array('parent_id'=>0));
    	return ArrayHelper::map($model, 'id', 'option_name');
    }
}
