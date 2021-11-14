<?php

namespace common\models\search;

use common\helpers\SearchHelper;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    public $q;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'category_id'], 'integer'],
            [['q'], 'string'],
        ];
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
        $query = Product::find()->joinWith('category');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => $this->getSort()
        ]);

        $this->load($params, '');

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'category_id' => $this->category_id,
        ]);

        if (!empty($this->q)) {
            $this->q = str_replace("'", '', $this->q);
            $query = SearchHelper::addSearchQuery($query, $this->q, [
                'product.name',
                'product_category.name'
            ]);
        }

        return $dataProvider;
    }

    protected function getSort() {
        return [
            'attributes' => [
                'product' => [
                    'asc' => ['product.name' => SORT_ASC],
                    'desc' => ['product.name' => SORT_DESC],
                ],
                'category' => [
                    'asc' => ['product_category.name' => SORT_ASC],
                    'desc' => ['product_category.name' => SORT_DESC],
                ],
                'active' => [
                    'asc' => ['product.is_active' => SORT_ASC],
                    'desc' => ['product.is_active' => SORT_DESC],
                ]
            ],
        ];
    }
}
