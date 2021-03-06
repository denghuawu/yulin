<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "yl_job".
 *
 * @property integer $id
 * @property string $job_name
 * @property string $job_desc
 * @property integer $parent_id
 * @property integer $depart_id
 */
class Job extends \yii\db\ActiveRecord
{
	public $people;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'yl_job';
    }
    
    public function scenarios(){
    	return [
    			'create'=>['parent_id', 'depart_id', 'job_name', 'job_desc','input_time'],
    			'update'=>['parent_id', 'depart_id', 'job_name', 'job_desc','input_time'],
    	];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'depart_id'], 'integer','on'=>['create','update']],
            [['job_name','depart_id','parent_id'], 'required','on'=>['create','update']],
            [['job_name'], 'string', 'max' => 255,'on'=>['create','update']],
            [['job_desc'], 'string', 'max' => 800,'on'=>['create','update']],
        	[['input_time'],'default','value'=>time(),'on'=>'create'],
        	['job_name', 'checkUniqueName','on'=>['create','update']],
        ];
    }

    /**
     * 检查职位名称的唯一性
     * @return boolean
     */
    public function checkUniqueName(){
    	if($this->isNewRecord){
    		if(self::find()->where(['parent_id'=>$this->parent_id,'depart_id'=>$this->depart_id,'job_name'=>$this->job_name])->exists()){
    			$this->addError('job_name','所选择的部门和上级职位已存在同名职位名称');
    			return false;
    		}
    	}else{
    		if(self::find()->where(['parent_id'=>$this->parent_id,'depart_id'=>$this->depart_id,'job_name'=>$this->job_name])
    				->andWhere('id!='.$this->id)->exists()){
    			$this->addError('job_name','所选择的部门和上级职位已存在同名职位名称');
    			return false;
    		}
    	}
    	return true;
    }
    
    /**
     * 删除前，检查有无下属职位
     * @see \yii\db\BaseActiveRecord::beforeDelete()
     */
    public function beforeDelete(){
    	if(self::find()->where('parent_id='.$this->id)->exists()){
    		return false;
    	}
    	return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_name' => '职位名称',
            'job_desc' => 'Job Desc',
            'parent_id' => '上级领导',
            'depart_id' => '所属部门',
        ];
    }
    
    public static function get_job(){
    	return self::find()->asArray()->all();
    }
}
