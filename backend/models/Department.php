<?php

namespace backend\models;

use Yii;
use backend\models\Job;
use backend\models\Employee;

/**
 * This is the model class for table "{{%department}}".
 *
 * @property integer $id
 * @property string $depart_name
 * @property integer $parent_id
 * @property integer $head_id
 * @property integer $sort
 */
class Department extends \yii\db\ActiveRecord
{
	static public $treeList = array();
	static public $depart_childen = [];
	public $people_num;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%department}}';
    }
    
    public function scenarios(){
    	return [
    			'create'=>['parent_id', 'head_id', 'sort', 'depart_name','input_time','depart_sn'],
    			'update'=>['parent_id', 'head_id', 'sort', 'depart_name','input_time'],
    	];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'head_id', 'sort'], 'integer','on'=>['update','create']],
            [['parent_id', 'depart_name'], 'required','on'=>['update','create']],
            [['depart_name'], 'string', 'max' => 255,'on'=>['update','create']],
            [['parent_id','sort','head_id'], 'default','value'=>0,'on'=>['update','create']],
        	[['input_time'],'default','value'=>time(),'on'=>['update','create']],
        	['depart_sn', 'default',$this->makeDepartSn(),'on'=>['create']],
        	['depart_name', 'checkUniqueName','on'=>['update','create']],
        ];
    }
    
    public function getEmployee(){
    	return $this->hasMany(Employee::className(), ['depart_id'=>'id']);
    }

    /**
     * 删除前，检查有无下级部门
     * @see \yii\db\BaseActiveRecord::beforeDelete()
     */
    public function beforeDelete(){
    	if(self::find()->where('parent_id='.$this->id)->exists()){
    		return false;
    	}
    	return true;
    }
    
    /**
     * 检查部门名称的唯一性
     * @return boolean
     */
	public function checkUniqueName(){
    	if($this->isNewRecord){
    		if(self::find()->where(['parent_id'=>$this->parent_id,'depart_name'=>$this->depart_name])->exists()){
    			$this->addError('depart_name','所选择的部门下已存在同名部门名称');
    			return false;
    		}
    	}else{
    		if(self::find()->where(['parent_id'=>$this->parent_id,'depart_name'=>$this->depart_name])
    				->andWhere('id!='.$this->id)->exists()){
    			$this->addError('depart_name','所选择的部门下已存在同名部门名称');
    			return false;
    		}
    	}
    	return true;
    }

    public function makeDepartSn(){
    	echo 9999;die;
    	$max_sn = self::findBySql('SELECT MAX(depart_sn) AS sn FROM {{%department}}')->one()->sn;
    	p($max_sn);die;
    	return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'depart_name' => '部门名称',
            'parent_id' => '上级部门',
            'head_id' => 'Head ID',
            'sort' => '排序',
        	'depart_sn'=>'部门编号',
        ];
    }

    public static function get_department_list(&$data,$parent_id=0, $top=false,$count=0){

    		if($top){
    			self::$treeList[0] = '无';
    		}
    		if($data){
    			foreach ($data as $key => $value){
    				if($value['parent_id']==$parent_id){
    					$input = strlen($value['depart_name'])+$count;		// 计算填充长度
    					$depart_name =  str_pad($value['depart_name'], $input, "--", STR_PAD_LEFT); // 填充前缀
    					self::$treeList [$value['id']] =  $depart_name;
    					unset($data[$key]);
    					self::get_department_list($data,$value['id'],false,$count+2);
    				}
    			}
    		}
    		return self::$treeList;
    }
    
    public static function get_department_list2(&$data,$parent_id=0){

    		if($data){
    			foreach ($data as $key => $value){	
    				if($value['parent_id']==$parent_id){echo 5;
    					self::$treeList [$value['id']] =  $value;
    					unset($data[$key]);
    					self::get_department_list2($data,$value['id']);
    				}
    				
    			}
    		}
    		return self::$treeList;
    }
    
    /**
     * 取出所有相应部门下的职位
     * @param unknown $departs
     * @param unknown $jobs
     * @return Ambigous <multitype:, string, unknown>
     */
    public static function get_depart_and_job(&$departs,$jobs){

    	foreach ($departs as $key => $value){
    		foreach ($jobs as $k => $v){
    			if($value['id'] == $v['parent_id']){
    				$departs[$value['id']]['job'][] = $v;
    			}
    		}
    		self::$treeList[$value['id']] = $departs;
    		unset($key);
    		
    	}
    	return self::$treeList;
    }
    
    /**
     * 将数据格式化成树形结构
     * @author Xuefen.Tong
     * @param array $items
     * @return array
     */
    public static function genTree9($items) {
    	$tree = array(); //格式化好的树
    	foreach ($items as $item)	
    		if (isset($items[$item['parent_id']]))
    			$items[$item['parent_id']]['son'][] = &$items[$item['id']];
    		else
    			$tree = &$items[$item['id']];
    		
    		return $items;
    }

    public static function get_departments(){
    	
    	return self::find()->orderBy(['parent_id'=>'ASC','id'=>'ASC'])->asArray()->all();
    }
    
    /**
     * 获取检索部门
     * @param number $parent_id
     */
    public static function get_con_department($parent_id=0){
    	return self::find()->where('parent_id='.$parent_id)->asArray()->all();
    }

    /**
     * 获得指定分类下所有底层分类的ID
     */
    public static function get_childen_department(&$data,$depart_id=0){
    
    	self::$depart_childen[] = intval($depart_id);
    	if($data){
    		foreach ($data as $key => $value){
    			if($value['parent_id']==$depart_id){
    				self::$depart_childen[] = intval($value['id']);
    				unset($data[$key]);
    				self::get_childen_department($data,$value['id']);
    			}
    		}
    	}
    	return array_unique(self::$depart_childen);
    }
}
