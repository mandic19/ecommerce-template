<?php
/**
 * Created by Marko Mandić on Jan, 2022
 * Email: marko.mandic.engr@gmail.com
 */

namespace api\versions\v1\controllers;

use api\components\web\BaseApiController;
use common\models\Product;
use common\models\search\ProductSearch;

class ProductController extends BaseApiController
{
    public $modelClass = Product::class;
    public $searchModelClass = ProductSearch::class;
}
