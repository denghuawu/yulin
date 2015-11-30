<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Rank;

/**
 * RankSearch represents the model behind the search form about `backend\models\Rank`.
 */
class RankSearch extends Rank
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rank_id'], 'integer'],
            [['rank_name', 'rank_desc'], 'safe'],
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
        $query = Rank::find();

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
            'rank_id' => $this->rank_id,
        ]);

        $query->andFilterWhere(['like', 'rank_name', $this->rank_name])
            ->andFilterWhere(['like', 'rank_desc', $this->rank_desc]);

        return $dataProvider;
    }
}
