<?php
/**
 * Created by Marko Mandić on Dec, 2021
 * Email: marko.mandic.engr@gmail.com
 */

namespace common\helpers;

use Yii;

class PriceHelper
{
    public static function format($price, $currencySign = 'KM', $decimals = 2) {
        $value = number_format($price, $decimals);
        return "{$value} {$currencySign}";
    }

    public static function extractTax($price) {
        return ($price / 100) * Yii::$app->params['tax'];
    }
}