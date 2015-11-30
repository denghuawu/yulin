<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use frontend\models\User;

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
class Comment extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%comment}}';
    }

    public function get_comment($id){
    	
    	$sql = "SELECT c.*,u.mobile_phone,u.user_name,u.figure FROM cm_comment AS c LEFT JOIN cm_users AS u ON c.user_id=u.user_id
    			WHERE c.goods_id = {$id}
    			";
    	
    	return self::findBySql($sql)->orderBy(['comment_time'=>'DESC'])->asArray()->all();
    }

}
