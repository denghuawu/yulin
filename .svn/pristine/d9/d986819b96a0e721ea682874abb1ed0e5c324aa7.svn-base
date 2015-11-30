<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Action;

/**
 * ActionSearch represents the model behind the search form about `backend\models\Action`.
 */
class ActionSearch extends Action
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action_id', 'parent_id', 'action_sort'], 'integer'],
            [['action_name', 'action_code', 'action_url'], 'safe'],
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
        $query = Action::find();

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
            'action_id' => $this->action_id,
            'parent_id' => $this->parent_id,
            'action_sort' => $this->action_sort,
        ]);

        $query->andFilterWhere(['like', 'action_name', $this->action_name])
            ->andFilterWhere(['like', 'action_code', $this->action_code])
            ->andFilterWhere(['like', 'action_url', $this->action_url]);

        return $dataProvider;
    }
}
