<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `backend\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['position_status',  'depart_id', 'job_id','sex','marriage'], 'integer'],
            [['em_sn', 'em_name', 'marriage','birthday', 'sex', 'political_status','entry_time','depart_id','job_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
    	/* $sql = "SELECT e.*,d.depart_name,j.job_name FROM {{%employee}} AS e LEFT JOIN {{%department}} AS d ON e.depart_id=d.id
    			LEFT JOIN {{%job}} AS j ON e.job_id=j.id"; */
        $query = Employee::find()->joinWith('department')->joinWith('job');
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
		if($params['EmployeeSearch']){
			foreach ($params['EmployeeSearch'] as &$val){	
				$val = explode(',', $val)[0];
			}
		}
		
        $this->load($params);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'depart_id' => $this->depart_id,
            'job_id' => $this->job_id,
        	'position_status' => $this->position_status,
        	'sex' => $this->sex,
        	'marriage' => $this->marriage,
        	'education_level' => $this->education_level
        ]);

        $this->birthday ? $query->andWhere('birthday '.$this->birthday) : null;
        $this->entry_time ? $query->andWhere('entry_time '.$this->entry_time) : null;
        $query->andFilterWhere(['like', 'em_name', $this->em_name]);
        
        return $dataProvider;
    }
}
