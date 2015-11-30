<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Goods;

/**
 * GoodsSearch represents the model behind the search form about `backend\models\Goods`.
 */
class GoodsSearch extends Goods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['goods_name', 'variety_id','goods_year','goods_number','goods_price','goods_sn'], 'safe'],
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
        $query = Goods::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        if($params['GoodsSearch']){
        	foreach ($params['GoodsSearch'] as &$val){
        		$val = explode(',', $val)[0];
        	}
        }

        $this->load($params);

        if (!$this->validate()) {	
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'goods_year' => $this->goods_year,
            'variety_id' => $this->variety_id
        ]);

        $query->orFilterWhere(['like', 'goods_name', $this->goods_name])
        		->orFilterWhere(['like', 'goods_sn', $this->goods_name]);
        $query->andWhere("goods_price{$this->goods_price}");
        $this->goods_number == '1' ? $query->andWhere("goods_number<=warehouse_down_limit") : null;
        $this->goods_number == '2' ? $query->andWhere("goods_number>=warehouse_upper_limit") : null;

        return $dataProvider;
    }
}
