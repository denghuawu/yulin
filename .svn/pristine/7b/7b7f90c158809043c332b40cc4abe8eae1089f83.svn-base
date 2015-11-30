<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%variety}}".
 *
 * @property integer $id
 * @property string $variety_name
 */
class Variety extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%variety}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['variety_name'], 'required'],
            [['variety_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'variety_name' => '系列名称',
        ];
    }
    
    public static function get_variety_list(){
    	$model = self::find()->all();
    	return ArrayHelper::map($model, 'id', 'variety_name');
    }
}
