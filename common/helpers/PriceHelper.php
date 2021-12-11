<?php
/**
 * Created by Marko Mandić on Dec, 2021
 * Email: marko.mandic.engr@gmail.com
 */

namespace common\helpers;

class PriceHelper
{
    public static function format($price, $currencySign = '$', $decimals = 2) {
        $value = number_format($price, $decimals);
        return "{$currencySign}{$value}";
    }
}