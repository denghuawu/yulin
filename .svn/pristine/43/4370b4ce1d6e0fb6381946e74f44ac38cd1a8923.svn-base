<?php

namespace backend\models;

use Yii;
use backend\models\Action;
use backend\models\Admin;



/**
 * This is the model class for table "{{%admin_role}}".
 *
 * @property integer $role_id
 * @property string $role_name
 * @property string $action_list
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_name'], 'required'],
            [['role_name'], 'string', 'max' => 100],
            [['role_desc'], 'string', 'max' => 255],
            [['action_list'], 'string', 'max' => 1000],
            [['action_list'], 'default', 'value'=>null],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_id' => '角色ID',
            'role_name' => '角色名称',
            'role_desc' => '角色描述',
            'action_list' => '角色权限列表',
        ];
    }
    
    /**
     * 取出所有角色
     */
    public static  function role_list(){
    	$data = Role::find(['select'=>['role_id','role_name']])->asArray()->all();
    	$arr = array();
    	foreach($data as $val){
    		$arr[$val['role_id']] = $val['role_name'];
    	}
    	
    	return $arr;
    }
    
    /**
     * 检查删除的角色对象是否和管理员有关联
     * @return boolean
     */
    public static function role_existed($id){
    	
    	if(Admin::find()->where(['role_id'=>$id])->exists()){
    		return true;
    	}
    }
    
    /**
     * 检查删除的角色对象是否和管理员有关联
     * @return boolean
     */
    public static function role_one($id){
    	$role = Role::find()->where(['role_id'=>$id])->asArray()->one();
    	if($role){
    		return $role;
    	}
    	return false;
    }
      
    
}
