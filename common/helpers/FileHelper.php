<?php

namespace common\helpers;

use common\models\File;
use yii\helpers\Url;

class FileHelper extends \yii\helpers\FileHelper
{
    const MIME_TYPE_OCTET_STREAM = 'application/octet-stream';
    const MIME_TYPE_EXCEL_2003 = 'application/vnd.ms-excel';
    const MIME_TYPE_EXCEL_2007 = 'application/vnd.openxmlformats-officedocument';
    const MIME_TYPE_EXCEL_2010 = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';

    public static function sanitizeName($name)
    {
        return preg_replace(array('/\s/', '/\.[\.]+/', '/[^\w_\.\-]/'), array('_', '.', ''), $name);
    }

    public static function getDummyUserImgUrl()
    {
        return Url::to(['/images/users/avatar-1.jpg']);
    }

    public static function getPreviewFileName($mimeType)
    {
        if (self::getIsImageByMimeType($mimeType)) {
            return '_image';
        }

        if ($mimeType == 'text/plain') {
            return '_text';
        }

        if ($mimeType == 'video/mp4') {
            return '_mp4_video';
        }

        return '_not_supported';
    }

    public static function getIsImageByMimeType($mimeType)
    {
        return strpos($mimeType, 'image') !== false;
    }

    public static function getFileList()
    {
        $files = File::find()->all();

        return ArrayHelper::map($files, 'id', 'original_name');
    }
}