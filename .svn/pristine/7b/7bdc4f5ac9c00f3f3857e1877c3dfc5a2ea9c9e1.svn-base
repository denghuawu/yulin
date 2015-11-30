<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Job;


/**
 * JobSearch represents the model behind the search form about `backend\models\Job`.
 */
class JobSearch extends Job
{
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_id'], 'integer'],
            [['job_name', 'job_desc', 'depart_id'], 'safe'],
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
    	$sql = " SELECT j.*,COUNT(e.id) as ec FROM {{%job}} as j LEFT JOIN {{%employee}} as e ON j.id=e.job_id GROUP BY j.id";
        $query = Job::findBySql($sql)->asArray();
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->load($params);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'job_name', $this->job_name])
        	;
        $query->andWhere('depart_id in('.$this->depart_id.')');
            //->andFilterWhere(['and', 'id>']);
        
        return $dataProvider;
    }
}
