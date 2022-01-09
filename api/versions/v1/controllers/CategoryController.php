<?php
/**
 * Created by Marko Mandić on Jan, 2022
 * Email: marko.mandic.engr@gmail.com
 */

namespace api\versions\v1\controllers;

use api\components\actions\SearchAction;
use api\components\web\BaseApiController;
use common\models\ProductCategory;
use common\models\search\ProductCategorySearch;
use yii\helpers\ArrayHelper;
use yii\rest\IndexAction;
use yii\rest\ViewAction;

class CategoryController extends BaseApiController
{
    public $modelClass = ProductCategory::class;
    public $searchModelClass = ProductCategorySearch::class;

    public $guestActions = ['index', 'view', 'options'];

    public function accessRules()
    {
        return ArrayHelper::merge(parent::accessRules(), [
            [
                'actions' => ['index', 'view', 'options'],
                'allow' => true
            ]
        ]);
    }

    public function actions()
    {
        return [
            'index' => [
                'class' => SearchAction::class,
                'modelClass' => $this->searchModelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'view' => [
                'class' => ViewAction::class,
                'modelClass' => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
        ];
    }
}
