<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Brand;

/**
 * BrandSearch represents the model behind the search form about `backend\models\Brand`.
 */
class BrandSearch extends Brand
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_id', 'cat_id', 'sort_order', 'is_show'], 'integer'],
            [['brand_name', 'brand_logo', 'brand_desc'], 'safe'],
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
        $query = Brand::find();

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
            'brand_id' => $this->brand_id,
            'cat_id' => $this->cat_id,
            'sort_order' => $this->sort_order,
            'is_show' => $this->is_show,
        ]);

        $query->andFilterWhere(['like', 'brand_name', $this->brand_name])
            ->andFilterWhere(['like', 'brand_logo', $this->brand_logo])
            ->andFilterWhere(['like', 'brand_desc', $this->brand_desc]);

        return $dataProvider;
    }
}
