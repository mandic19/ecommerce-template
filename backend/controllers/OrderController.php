<?php

namespace backend\controllers;

use common\components\actions\SearchAction;
use common\components\actions\ViewAction;
use common\components\controllers\BaseController;
use common\models\Order;
use common\models\search\OrderItemSearch;
use common\models\search\OrderSearch;
use yii\helpers\ArrayHelper;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends BaseController
{
    public $modelClass = Order::class;
    public $searchModelClass = OrderSearch::class;

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'class' => SearchAction::class,
                'searchModel' => $this->searchModelClass,
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass,
                'modalView' => 'view',
                'params' => function($action, Order $model) {
                    $searchModel = new OrderItemSearch(['order_id' => $model->id]);
                    return [
                        'model' => $model,
                        'orderItemsDataProvider' => $searchModel->search([])
                    ];
                }
            ]
        ]);
    }
}
