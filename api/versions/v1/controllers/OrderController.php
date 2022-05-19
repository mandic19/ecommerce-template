<?php
/**
 * Created by Marko Mandić on Jan, 2022
 * Email: marko.mandic.engr@gmail.com
 */

namespace api\versions\v1\controllers;

use api\components\actions\CreateAction;
use api\components\web\BaseApiController;
use api\models\OrderForm;
use common\models\Order;
use common\models\search\OrderSearch;
use yii\helpers\ArrayHelper;
use yii\rest\OptionsAction;

class OrderController extends BaseApiController
{
    public $modelClass = Order::class;
    public $searchModelClass = OrderSearch::class;

    public $guestActions = ['create', 'options'];

    public function accessRules()
    {
        return ArrayHelper::merge(parent::accessRules(), [
            [
                'actions' => ['create', 'options'],
                'allow' => true
            ]
        ]);
    }

    public function actions()
    {
        return [
            'create' => [
                'class' => CreateAction::class,
                'modelClass' => OrderForm::class,
                'checkAccess' => [$this, 'checkAccess'],
                'scenario' => $this->createScenario,
            ],
            'options' => [
                'class' => OptionsAction::class
            ]
        ];
    }
}
