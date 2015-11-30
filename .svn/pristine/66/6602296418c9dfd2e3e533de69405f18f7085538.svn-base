<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Order;

/**
 * OrderSearch represents the model behind the search form about `backend\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'order_status', 'shipping_status', 'pay_status','shipping_id', 'pay_id', 'add_time', 'confirm_time', 'pay_time', 'shipping_time'], 'integer'],
            [['order_sn', 'address', 'shipping_name', 'pay_name', 'extension_code', 'message'], 'safe'],
            [['goods_amount', 'shipping_fee', 'pay_fee', 'order_amount'], 'number'],
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
        $query = Order::find();

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
            'order_id' => $this->order_id,
            'user_id' => $this->user_id,
            'order_status' => $this->order_status,
            'shipping_status' => $this->shipping_status,
            'pay_status' => $this->pay_status,
            'shipping_id' => $this->shipping_id,
            'pay_id' => $this->pay_id,
            'goods_amount' => $this->goods_amount,
            'shipping_fee' => $this->shipping_fee,
            'pay_fee' => $this->pay_fee,
            'order_amount' => $this->order_amount,
            'add_time' => $this->add_time,
            'confirm_time' => $this->confirm_time,
            'pay_time' => $this->pay_time,
            'shipping_time' => $this->shipping_time,
        ]);

        $query->andFilterWhere(['like', 'order_sn', $this->order_sn])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'shipping_name', $this->shipping_name])
            ->andFilterWhere(['like', 'pay_name', $this->pay_name])
            ->andFilterWhere(['like', 'extension_code', $this->extension_code])
            ->andFilterWhere(['like', 'message', $this->message]);

        return $dataProvider;
    }
}
