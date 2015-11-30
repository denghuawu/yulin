<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * 全国地区联动
 *
 * @property integer $region_id
 * @property integer $parent_id
 * @property string $region_name
 * @property integer $region_type
 * @property integer $user_id
 * @property integer $sort_order
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%region}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'region_type', 'user_id', 'sort_order'], 'integer'],
            [['region_name'], 'string', 'max' => 120],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'region_id' => '全国地区表(国家省市区)',
            'parent_id' => '上级地名',
            'region_name' => '名称',
            'region_type' => '类型',
            'user_id' => '会员id',
            'sort_order' => 'Sort Order',
        ];
    }

    // 地区列表
    public static function region_list($parent_id=0)
    {
    	$model = Region::findAll(array('parent_id'=>$parent_id));
    	return ArrayHelper::map($model, 'region_id', 'region_name');
    }
    
    /*<?= $form->field($model, 'province')->dropDownList(
    		\yii\helpers\ArrayHelper::map(Region::region_list(),'region_id','region_name'),
    		[
    				'prompt'>'select province',
    				'onchange'>'
	            $.post("index.php?r=user/region&id='.'"+$(this).val(),function(data){
	                $("select#user-city").html(data);
	            });',
    		]
    	) ?>;
    	
    	
    	<?= $form->field($model, 'city')->dropDownList(
    	    \yii\helpers\ArrayHelper::map(Region::region_list(),'region_id','region_name'),
    	    [
    	        'prompt'=>'Select city',
    	    ]
    	) ?>*/
    
    /**
     * 返回地区名
     * @param $pid int 省
     * @param $cid int 市
     * @param $did int 区
     */
    public static function region_name($pid=0,$cid=0,$did=0)
    {
    	$id = null;
    	$id = $pid>0 ? $pid.',' : '';
    	$id .= $cid>0 ? $cid.',' : '';
    	$id .= $did>0 ? $did.',' : '';
    	$id = rtrim($id,',');
    	
    	if($id){
    		$name = null;
    		$data = Region::findBySql('SELECT region_name FROM {{%region}} WHERE region_id IN('.$id.')')->asArray()->all();
    		foreach($data as $v){
    			$name .= $v['region_name'];
    		}
    		return $name;
    	}
    }
}
