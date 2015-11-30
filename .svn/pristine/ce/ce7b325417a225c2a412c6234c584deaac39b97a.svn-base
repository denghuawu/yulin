<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Category;

/**
 * CategorySearch represents the model behind the search form about `backend\models\Category`.
 */
class CategorySearch extends Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'parent_id', 'sort_order', 'is_hot', 'is_show'], 'integer'],
            [['cat_name', 'cat_desc', 'category_img'], 'safe'],
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
        $query = Category::find();

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
            'cat_id' => $this->cat_id,
            'parent_id' => $this->parent_id,
            'sort_order' => $this->sort_order,
            'is_hot' => $this->is_hot,
            'is_show' => $this->is_show,
        ]);

        $query->andFilterWhere(['like', 'cat_name', $this->cat_name])
            ->andFilterWhere(['like', 'cat_desc', $this->cat_desc])
            ->andFilterWhere(['like', 'category_img', $this->category_img]);

        return $dataProvider;
    }
}
