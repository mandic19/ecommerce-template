<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form of `common\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by', 'is_deleted'], 'integer'],
            [['code', 'currency', 'delivery_first_name', 'delivery_last_name', 'delivery_address', 'delivery_city', 'delivery_zip', 'delivery_country', 'delivery_phone', 'delivery_notes', 'customer_ip_address', 'customer_user_agent', 'request'], 'safe'],
            [['subtotal', 'total_tax', 'total_discount', 'shipping_cost', 'total'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'subtotal' => $this->subtotal,
            'total_tax' => $this->total_tax,
            'total_discount' => $this->total_discount,
            'shipping_cost' => $this->shipping_cost,
            'total' => $this->total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'delivery_first_name', $this->delivery_first_name])
            ->andFilterWhere(['like', 'delivery_last_name', $this->delivery_last_name])
            ->andFilterWhere(['like', 'delivery_address', $this->delivery_address])
            ->andFilterWhere(['like', 'delivery_city', $this->delivery_city])
            ->andFilterWhere(['like', 'delivery_zip', $this->delivery_zip])
            ->andFilterWhere(['like', 'delivery_country', $this->delivery_country])
            ->andFilterWhere(['like', 'delivery_phone', $this->delivery_phone])
            ->andFilterWhere(['like', 'delivery_notes', $this->delivery_notes])
            ->andFilterWhere(['like', 'customer_ip_address', $this->customer_ip_address])
            ->andFilterWhere(['like', 'customer_user_agent', $this->customer_user_agent])
            ->andFilterWhere(['like', 'request', $this->request]);

        return $dataProvider;
    }
}
