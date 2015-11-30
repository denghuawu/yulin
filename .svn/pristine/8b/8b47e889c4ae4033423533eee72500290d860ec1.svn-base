<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\WorkReport;

/**
 * WorkReportSearch represents the model behind the search form about `backend\models\WorkReport`.
 */
class WorkReportSearch extends WorkReport
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'report_type', 'submit_leader', 'report_time_start', 'report_time_end', 'em_id', 'admin_id', 'report_time'], 'integer'],
            [['report_title', 'report_summary', 'next_plan'], 'safe'],
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
        $query = WorkReport::find();

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
            'report_type' => $this->report_type,
            'submit_leader' => $this->submit_leader,
            'report_time_start' => $this->report_time_start,
            'report_time_end' => $this->report_time_end,
            'em_id' => $this->em_id,
            'admin_id' => $this->admin_id,
            'report_time' => $this->report_time,
        ]);

        $query->andFilterWhere(['like', 'report_title', $this->report_title])
            ->andFilterWhere(['like', 'report_summary', $this->report_summary])
            ->andFilterWhere(['like', 'next_plan', $this->next_plan]);

        return $dataProvider;
    }
}
