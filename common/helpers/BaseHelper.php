<?php

namespace common\helpers;

class BaseHelper
{
    public static function formatToCharSeparatedString($array, $separator = ', ') {

        $array = array_filter($array, function ($value) {
            return !empty($value);
        });

        return implode($separator, $array);
    }

}