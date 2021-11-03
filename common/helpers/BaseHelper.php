<?php

namespace common\helpers;

use common\components\image\ImageSpecification;
use common\models\Image;
use Yii;
use yii\helpers\Url;

class BaseHelper
{
    public static function formatToCharSeparatedString($array, $separator = ', ')
    {

        $array = array_filter($array, function ($value) {
            return !empty($value);
        });

        return implode($separator, $array);
    }

    public static function extractIdsFromDropzoneValue($value, $limit = false)
    {
        if (empty($value) || !is_string($value)) {
            return [];
        }

        $array = explode(', ', str_replace(['[', ']'], '', $value));

        if ($limit == false || !is_int($limit)) {
            return $array;
        }

        $counter = 0;
        $tempArray = [];
        foreach ($array as $item) {
            $tempArray[] = $item;
            $counter++;
            if ($counter === $limit) {
                break;
            }
        }

        return $tempArray;
    }

    /**
     * @param Image[] $images
     * @return array
     */
    public static function convertImagesToDropzoneFormat(array $images)
    {
        return array_map(function (Image $model) {
            return [
                'id' => $model->id,
                'name' => $model->original_name,
                'size' => $model->size,
                'status' => 'success',
                'url' => Url::to(['/image/view', 'id' => $model->id, 'spec' => ImageSpecification::THUMB_MEDIUM_SQUARED]),
                'src' => Url::to(['/image/view', 'id' => $model->id, 'spec' => ImageSpecification::MAX_WIDTH])
            ];
        }, $images);
    }
}