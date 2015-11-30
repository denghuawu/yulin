<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%admin_action}}".
 *
 * @property integer $action_id
 * @property integer $parent_id
 * @property string $action_name
 * @property string $action_code
 * @property string $action_url
 * @property integer $action_sort
 */
class Action extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_action}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'action_sort','is_show'], 'integer'],
            [['action_name', 'action_code', 'action_url'], 'required'],
            [['action_code'], 'unique'],
            [['action_name', 'action_code'], 'string', 'max' => 20],
            [['action_url'], 'string', 'max' => 100],
            [['action_sort'], 'default', 'value' => 0],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'action_id' => 'id',
        	'parent_id' => '上级菜单',
            'action_name' => '行为名称',
            'action_code' => '行为代码',
            'action_url' => '行为url',
            'action_sort' => '排序',
            'is_show' => '是否显示于菜单',
        ];
    }
    
    /* 取出所有行为 */
    public function action_list(){
    	
    	$data = array('0'=>'顶级菜单');
    	
    	// 找出父行为
    	$actions = $this->findBySql("SELECT action_id,action_name FROM {{%admin_action}} WHERE parent_id=0")->asArray()->all();

    	foreach ($actions as $val){
    		if($val['action_id'] > 0){
    			
    			$data[$val['action_id']] = $val['action_name'];
    			// 根据父行为找子行为
    			$child_data = $this->find()->where(['parent_id'=>$val['action_id']])->asArray()->all();
    			
    			foreach ($child_data as $v){
    				$data[$v['action_id']] = '　　-'.$v['action_name'];
    			}
    		}
    	}
    	
    	return $data;
    }
    
    /**
     * 取出行为列表（提供checkbox遍历使用）
     */
    public static function action_checkbox(){
    	 
    	$top_action = Action::find()->where(['parent_id'=>0])->asArray()->all();
    	 
    	$data = array();
    	foreach ($top_action as $key=>$val){
    
    		$data[$key] = $val;
    		// 取出子行为
    		$child_action = Action::find()->where(['parent_id'=>$val['action_id']])->asArray()->all();
    
    		foreach ($child_action as $k=>$v){
    			 
    			if($v['action_id'] > 0){
    
    				$data[$key]['child'][] = $v;
    			}
    		}
    	}
    	return $data;
    }
    
    /**
     * 取出可显示的行为列表（导航菜单）
     */
    public static  function action_nav(){
    
    	$top_action = Action::find()->where(['parent_id'=>0,'is_show'=>1])->asArray()->orderBy(['action_sort'=>'ASC'])->all();
  	
    	$data = array();
    	foreach ($top_action as $key=>$val){	
    
    		$data[$key] = $val;
    		// 取出子行为
    		$child_action = Action::find()->where(['parent_id'=>$val['action_id'],'is_show'=>1])->asArray()->orderBy(['action_sort'=>'ASC'])->all();
    
    		foreach ($child_action as $k=>$v){
    
    			if($v['action_id'] > 0){
    
    				$data[$key]['child'][] = $v;
    			}
    		}
    	}
    	return $data;
    }
    
    
    
}
