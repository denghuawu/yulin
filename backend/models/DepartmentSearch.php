<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Department;

/**
 * DepartmentSearch represents the model behind the search form about `backend\models\Department`.
 */
class DepartmentSearch extends Department
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'parent_id', 'head_id', 'sort', 'input_time'], 'integer'],
            [['depart_name','id'], 'safe'],
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
//         $sql = " SELECT d.*,COUNT(e.id) as ec FROM {{%department}} as d LEFT JOIN {{%employee}} as e ON d.id=e.depart_id GROUP BY d.id";
        $query = Department::find(['select'=>['{{%department}}.*,employee.id']])->joinWith('employee')->asArray();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->load($params);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            //'id' => $this->id,
            'parent_id' => $this->parent_id,
            'head_id' => $this->head_id,
            'sort' => $this->sort,
            'input_time' => $this->input_time,
        ]);
        
        $query->andFilterWhere(['like', 'depart_name', $this->depart_name]);
        $query->andWhere('{{%department}}.id IN('.$this->id.')');

        return $dataProvider;
    }
}
