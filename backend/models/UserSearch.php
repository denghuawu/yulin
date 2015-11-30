<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sex', 'user_rank'], 'integer'],
            [['email', 'user_name', 'figure', 'password', 'mobile_phone', 'real_name'], 'safe'],
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
        $query = User::find();
        
        /* 如果以函数的方式调用，会返回一个 ActiveQuery 对象（$customer->getOrders()->all()）
如果以属性的方式调用，会直接返回模型的结果($customer */

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
            'sex' => $this->sex,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'mobile_phone', $this->mobile_phone])
            ->andFilterWhere(['like', 'real_name', $this->real_name]);

        return $dataProvider;
    }
}
