<?php
/**
 * Created by Marko Mandić on Jan, 2022
 * Email: marko.mandic.engr@gmail.com
 */

namespace api\versions\v1\controllers;

use api\components\web\BaseApiController;
use common\models\ProductCategory;
use common\models\search\ProductCategorySearch;
use yii\helpers\ArrayHelper;


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
}
