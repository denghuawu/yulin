<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user_rank}}".
 *
 * @property integer $rank_id
 * @property string $rank_name
 * @property string $rank_desc
 */
class Rank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_rank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rank_name'], 'string', 'max' => 30],
            [['rank_desc'], 'string', 'max' => 255],
            [['rank_name'], 'required', 'message'=>'等级名称不能为空'],
            [['rank_name'], 'unique', 'message'=>'已存在此等级名称'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rank_id' => 'id',
            'rank_name' => '名称',
            'rank_desc' => '等级描述',
        ];
    }
    
    public static function rank_list(){
    	$ranks = Rank::find()->asArray()->all();
    	
    	foreach ($ranks as $r){
    		$res[$r['rank_id']] = $r['rank_name'];
    	}
    	return $res;
    }
    
    // 返回等级名称
    public static function get_rank_name($id){
    	return Rank::find()->where(['rank_id'=>$id])->asArray()->one()['rank_name'];
    }
}
