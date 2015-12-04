<?php

namespace backend\models;

use Yii;
use backend\models\Rank;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "{{%users}}".
 *
 * @property string $user_id
 * @property string $email
 * @property string $user_name
 * @property string $figure
 * @property string $password
 * @property integer $sex
 * @property string $user_money
 * @property string $address_id
 * @property string $reg_time
 * @property string $last_login
 * @property integer $user_rank
 * @property string $mobile_phone
 * @property string $real_name
 * @property string $weixin
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $district
 */
class User extends \yii\db\ActiveRecord
{
	public $confirm_password;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }
    
    public function scenarios()
    {
    	return [			
    			'create' => ['user_name','real_name','birthday','password',
    						'sex','user_money','reg_time','user_rank','admin_id',
    						'mobile_phone','email','qq','is_validated','detail_address',
    						'province','city','district','native_place','user_type','shop_name','bank_card','id_card'],
    			
    			'update' => ['real_name','birthday',
    						'sex','user_money','reg_time','user_rank','admin_id',
    						'mobile_phone','email','qq','detail_address',
    						'province','city','district','native_place','user_type','shop_name','bank_card','id_card'],
    	];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['real_name', 'email','native_place','detail_address'], 'trim','on'=>['create','update']],
            [['mobile_phone','real_name'], 'required','on'=>['create','update']],
            [['sex', 'user_rank', 'admin_id','user_type','id_card'], 'integer','on'=>['create','update']],
        	['email','email', 'on'=>'create'],
        	[['mobile_phone'],'match','pattern'=>'/^(0|86|17951)?(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/','message'=>'请输入正确的手机号码','on'=>['create','update']],
        	['id_card','match','pattern'=>'/(^\d{15}$)|(^\d{17}([0-9]|X)$)/','message'=>'请输入正确的身份证号码', 'on'=>'create'],
        	[['sex'], 'default', 'value'=>'1','on'=>['create','update']],
        	[['user_money','is_validated','user_money'], 'default', 'value'=>'0','on'=>['create']],
        	[['reg_time'], 'default', 'value'=>time(),'on'=>['create']],
        	['user_name', 'default', 'value' => $this->make_username(), 'on'=>'create'],
        	['password', 'default', 'value' => md5(123456), 'on'=>'create'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => '用户id',
            'email' => '邮箱',
            'user_name' => '用户名',
            'figure' => '头像',
            'password' => '密码',
            'sex' => '性别',
            'user_money' => '用户资金',
            'address_id' => '关联user_address表',
            'reg_time' => '注册时间',
            'last_login' => '上次登录时间',
            'user_rank' => '会员等级',
            'admin_id' => '隶属管理',
            'mobile_phone' => '手机号码',
            'real_name' => '真实姓名',
            'weixin' => '微信open_id',
        	'confirm_password' => '确认密码',
        	'province' => '省',
        	'city' => '市',
        	'admin_id' => '关联后台管理员',
        	'id_card' => '身份证号',
        ];
    }
    
    /**
     * 生成唯一用户名
     * @return string
     */
    public function make_username(){
    	
    	//基于以微秒计的当前时间，生成一个唯一的 ID.
    	$uid = uniqid(microtime(true));
    	// 去后八位
    	return substr($uid,strlen($uid)-8,8);
    }

	/**
     * 数据插入前处理
     * @param unknown $insert
     * @return boolean
     */
    /* public function beforeSave($insert)
    {	
    	if(parent::beforeSave($insert)){
    		if($this->isNewRecord){
    			$this->password = md5($this->password);
    		}else{
    			if($this->flag){
    				// 判断是否需要修改密码
    				$user = (new \yii\db\Query())
		    		->select('*')
		    		->from('cm_users')
		    		->where('user_name=:user_name AND password=:password',[':user_name'=>$this->user_name,':password'=>$this->password])
		    		->count();
    				if($user < 1){
    					$this->password = md5($this->password);
    				}
    				// 避免空的值覆盖
    				$this->figure = $this->figure ? $this->figure : $this->tmp_figure;
    			}
    			
    		}
    		return true;
    	}else{
    		return false;
    	}
    }  */

    // 为多表查询定义关联关系
    public function getRank()
    {
    	/**
    	 * 第一个参数为要关联的字表模型类名称，
    	 *第二个参数指定 通过子表的 customer_id 去关联主表的 id 字段
    	 */
    	return $this->hasMany(Rank::className(), ['rank_id' => 'user_rank']);
    }
    
    /**
     * 获取上级管理员
     */
    public static function manager_list(){
    	$res['0'] = '无';
    	
    	$data = User::find()->where(['>','user_rank','5'])->joinWith('rank')->asArray()->all();
    
    	if($data){
    		foreach ($data as $key=>$val){
    			if(empty($val['rank'][0]['rank_name'])){
    				continue;
    			}
    			$res[$val['user_id']] = $val['rank'][0]['rank_name'].'--'.$val['user_name'];
    		}
    	}
    	
    	
    	return $res;
    }
    
    /**
     * 取出用户地区
     * @param number $parent_id
     * @return Ambigous <multitype:, multitype:unknown , unknown>
     */
    public function user_region($parent_id=0){
    	$sql = 'SELECT Distinct(u.province),r.region_name FROM  {{%users}} AS u 
    			LEFT JOIN {{%region}} AS r ON u.province=r.region_id
    			WHERE r.parent_id='.$parent_id;
    	$model = self::findBySql($sql);
    	
    	return ArrayHelper::map($model, 'province', 'region_name');
    }
    
    /**
     * 生成不重复的用户名
     */
    public static function make_user_name(){
    	$prefix = 'yl';
    	$now_time = substr(time(),3,5);
    	$user_name = $prefix.$now_time;
    	if(User::find()->where(['user_name'=>$user_name])->exists()){
    		self::make_user_name();
    	}
    	return $user_name;
    }
    
    public static function get_user_name($id){
    	return self::findOne($id)->user_name;
    }
    
}
