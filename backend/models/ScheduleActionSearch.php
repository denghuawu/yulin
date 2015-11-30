<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ScheduleAction;

/**
 * ScheduleActionSearch represents the model behind the search form about `backend\models\ScheduleAction`.
 */
class ScheduleActionSearch extends ScheduleAction
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sch_type', 'customer_id', 'execute_id', 'priority_level', 'sch_time_start', 'sch_time_end', 'em_id', 'admin_id', 'createed_time'], 'integer'],
            [['sch_theme', 'execute_partner', 'shc_desc'], 'safe'],
            [['complete_level'], 'number'],
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
        $query = ScheduleAction::find();

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
            'id' => $this->id,
            'sch_type' => $this->sch_type,
            'customer_id' => $this->customer_id,
            'execute_id' => $this->execute_id,
            'priority_level' => $this->priority_level,
            'sch_time_start' => $this->sch_time_start,
            'sch_time_end' => $this->sch_time_end,
            'complete_level' => $this->complete_level,
            'em_id' => $this->em_id,
            'admin_id' => $this->admin_id,
            'createed_time' => $this->createed_time,
        ]);

        $query->andFilterWhere(['like', 'sch_theme', $this->sch_theme])
            ->andFilterWhere(['like', 'execute_partner', $this->execute_partner])
            ->andFilterWhere(['like', 'shc_desc', $this->shc_desc]);

        return $dataProvider;
    }
}
