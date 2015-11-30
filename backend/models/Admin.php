<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Role;

/**
 * This is the model class for table "{{%admin_user}}".
 *
 * @property integer $user_id
 * @property string $user_name
 * @property string $email
 * @property string $password
 * @property integer $role_id
 */
class Admin extends \yii\db\ActiveRecord
{
	public $comfirm_password;	//确认密码
	public $flag; 		//表示当前是否是更新操作
	public $new_password;	// 新密码，用于重置密码
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_user}}';
    }
    
    public function scenarios()
    {
    	return [
    			'login' => ['user_name', 'password'],
    			'create' => ['role_id', 'user_name','password','mobile_phone','email','comfirm_password'],
    			'reset' => ['password','new_password','comfirm_password'],
    	];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {	
        return [
            [['role_id'], 'integer','on'=>['create']],
            [[ 'mobile_phone','comfirm_password','role_id'], 'required','on'=>['create']],
        	[[ 'user_name'], 'required', 'message'=>'用户名不能为空', 'on'=>['create','login']],
        	[[ 'password'], 'required', 'message'=>'密码不能为空','on'=>['create','login','reset']],
        	[[ 'comfirm_password'], 'required', 'message'=>'确认密码不能为空','on'=>['create','reset']],
        	[[ 'new_password'], 'required', 'message'=>'新密码不能为空','on'=>['reset']],
        		
            [['email'], 'email', 'message'=>'邮箱输入有误','on'=>['create']],
            [['user_name'], 'string','min'=>4,'max' => 20, 'message'=>'用户名必须是4-20个由数字或者字母组成','on'=>['create']],
        	[['user_name'], 'unique','message'=>'用户名已存在','on'=>['create']],
            [['password'], 'string', 'min'=>6,'max' => 32,'on'=>['create','reset']],
            [['new_password'], 'string', 'min'=>6,'max' => 32,'on'=>['reset']],
        	[['mobile_phone'], 'unique','message'=>'手机号码已存在','on'=>['create']],
        	[['mobile_phone'],'match','pattern'=>'/^1[0-9]{10}$/','message'=>'请输入正确的手机号码','on'=>['create']],
        	[['comfirm_password'], 'compare', 'compareAttribute'=>'password','on'=>['create']],
        	[['comfirm_password'], 'compare', 'compareAttribute'=>'new_password', 'message'=>'和新密码密码不一致', 'on'=>['reset']],
        		
        	['password', 'validatePassword', 'on'=>['login']],
        	['password', 'validatePassword2', 'on'=>['reset']],
        ];
    }
    
    // 验证码用户名和密码的正确性
    public function validatePassword()
    {
    	// 如果前面没有错误
    	if(!$this->hasErrors()){	
    		$user = (new \yii\db\Query())
    		->select('user_id')
    		->from('yl_admin_user')
    		->where('user_name=:user_name AND password=:password',[':user_name'=>$this->user_name,':password'=>md5($this->password)])
    		->exists();
    		
    		if (!$user) {
    			$this->addError('password','用户名或者密码错误~！');
    			return false;
    		}
    		return true;
    	}
    	
    }
    // 验证码用户名和密码的正确性
    public function validatePassword2()
    {
    	// 如果前面没有错误
    	if(!$this->hasErrors()){	
    		$user = (new \yii\db\Query())
    		->select('user_id')
    		->from('yl_admin_user')
    		->where('user_name=:user_name AND password=:password',[':user_name'=>$_SESSION['admin']['user_name'],':password'=>md5($this->password)])
    		->exists();

    		if (!$user) {
    			$this->addError('password','与当前用户的密码错误~！');
    			return false;
    		}
    		return true;
    	}
    	
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => '用户ID',
            'user_name' => '用户名',
            'email' => '邮箱',
            'password' => '密码',
            'role_id' => '角色',
        	'comfirm_password'=>'确认密码',
        	'mobile_phone'=>'手机号码',
        	'last_login'=>'上次登录',
        	'flag'=>'',
        	'new_password'=>'新密码',
        ];
    }
    
    /**
     * 数据插入前处理
     * @param unknown $insert
     * @return boolean
     */
    public function beforeSave($insert)
    {	
    	if(parent::beforeSave($insert)){
    		if($this->isNewRecord){
    			$this->password = md5($this->password);
    			$this->created_at = time();
    		}else{
    			if(Yii::$app->request->post('Admin')['flag']){
    				// 判断是否需要修改密码
    				$user = (new \yii\db\Query())
		    		->select('*')
		    		->from('yl_admin_user')
		    		->where('user_name=:user_name AND password=:password',[':user_name'=>$this->user_name,':password'=>$this->password])
		    		->count();
    				if($user < 1){
    					$this->password = md5($this->password);
    				}
    			}
    			
    		}
    		return true;
    	}else{
    		return false;
    	}
    }
    
    // 后台登录
    public function login($dataModel){
	
    	$this->user_name = $dataModel['Admin']['user_name'];
    	$this->password = $dataModel['Admin']['password'];
    	
    	$this->setScenario('login');
    	
		if($this->validate()){
			
    		$user = (new \yii\db\Query())
    		->select('user_id, user_name,mobile_phone,role_id')
    		->from('yl_admin_user')
    		->where('user_name=:user_name',[':user_name'=>$this->user_name])
    		->one();
    	
    		// 更新登录时间
    		$model = Admin::findOne($user['user_id']);
    		$model->last_login = time();
    		$model->save(false);
    		
    		// 缓存用户信息
    		$session = Yii::$app->session;
    		$session->open();
    		$_SESSION['admin']['user_id'] = $user['user_id'];
    		$_SESSION['admin']['user_name'] = $user['user_name'];
    		$_SESSION['admin']['mobile_phone'] = $user['mobile_phone'];
    		$_SESSION['admin']['role_id'] = $user['role_id'];
    		return true;
		}else{
			 return $model->errors;
		}
    }
    
    public static function getManager(){
    	
    	$model = self::find()->where(['role_id'=>113])->all();
    	return ArrayHelper::map($model, 'user_id', 'user_name');
    }
    
    /**
     * 获得关联后台管理员列表
     */
    public static function get_role_admin(){
    	
    	$sql = "SELECT a.user_id,a.user_name,r.role_name FROM 
    			yl_admin_role AS r , yl_admin_user AS a WHERE r.role_id=a.role_id
    			";
    	$res = self::findBySql($sql)->asArray()->all();
    	
    	$list = [''=>'请选择'];
    	
    	if($res){
    		foreach ($res as $val){
    			$list[$val['user_id']] = $val['role_name'].' -- '.$val['user_name'];
    		}
    	}
    	return $list;
    }

}
