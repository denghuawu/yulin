<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use frontend\models\OrderInfo;

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
class Refund extends ActiveRecord
{

	public $order_id;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%refund}}';
    }
    
    public function rules(){
    	return [
    		
    		[['refund_reason','refund_type'], 'required'],
    		[['refund_desc'], 'string', 'max'=>'500'],
    		[['refund_status'], 'default', 'value'=>1],
    		[['refund_time'], 'default', 'value'=>time()],
    		[['refund_reason'], 'checkRepeat'],
    	];
    }
    
    public function checkRepeat(){
    	
    	if(OrderInfo::findOne($this->order_id)->order_status != RETURNED){
    		return true;
    	}
    	
    	$this->addError('refund_reason', '不能重复提交退款申请');
    	return false;
    }
    
    public function attributeLabels(){
    	return [
    			
    		'refund_reason' =>'退款原因',
    		'refund_desc' =>'退款描述',
    		'refund_type' =>'退款类型',
    	];
    }
}
