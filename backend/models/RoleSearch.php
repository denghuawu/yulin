<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Role;

/**
 * RoleSearch represents the model behind the search form about `backend\models\Role`.
 */
class RoleSearch extends Role
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id'], 'integer'],
            [['role_name', 'action_list'], 'safe'],
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
        $query = Role::find();

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
            'role_id' => $this->role_id,
        ]);

        $query->andFilterWhere(['like', 'role_name', $this->role_name])
            ->andFilterWhere(['like', 'action_list', $this->action_list]);

        return $dataProvider;
    }
}
