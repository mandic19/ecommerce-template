<?php
/**
 * Created by Marko Mandić on Dec, 2021
 * Email: marko.mandic.engr@gmail.com
 */

namespace common\helpers;

use common\models\Order;
use Yii;
use yii\helpers\Html;

class OrderStatusHelper
{
    public static function getOptions() {
        return [
            Order::STATUS_PENDING => Yii::t('app', 'Pending'),
            Order::STATUS_PROCESSING => Yii::t('app', 'Processing'),
            Order::STATUS_COMPLETED => Yii::t('app', 'Completed'),
            Order::STATUS_CANCELLED => Yii::t('app', 'Cancelled'),
            Order::STATUS_FAILED => Yii::t('app', 'Failed'),
            Order::STATUS_REFUNDED => Yii::t('app', 'Refunded'),
        ];
    }

    public static function getStatusBadge($status) {
        $color = self::getColorById($status);
        $icon = self::getIconForId($status);
        $label = self::getLabelById($status);

        $iconElement = Html::tag('i', null, [
            'class' => "{$icon} fa-lg text-white"
        ]);

        return Html::tag('span', $iconElement, [
            'class' => "badge badge-circle badge-{$color} d-block-inline",
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'title' => $label
        ]);
    }

    public static function getLabelById($status)
    {
        return self::getOptions()[$status] ?? Yii::t('app', 'Unknown');
    }

    public static function getColorById($status)
    {
        return self::getColors()[$status] ?? 'secondary';
    }

    public static function getIconForId($status)
    {
        return self::getIcons()[$status] ?? 'question';
    }

    public static function getColors() {
        return [
            Order::STATUS_PENDING => 'info',
            Order::STATUS_PROCESSING => 'violet',
            Order::STATUS_COMPLETED => 'success',
            Order::STATUS_CANCELLED => 'danger',
            Order::STATUS_FAILED => 'danger',
            Order::STATUS_REFUNDED => 'danger',
        ];
    }

    public static function getIcons() {
        return [
            Order::STATUS_PENDING => 'fa fa-spinner',
            Order::STATUS_PROCESSING => 'fab fa-stack-overflow',
            Order::STATUS_COMPLETED => 'fa fa-check',
            Order::STATUS_CANCELLED => 'fa fa-ban',
            Order::STATUS_FAILED => 'fas fa-exclamation-triangle',
            Order::STATUS_REFUNDED => 'fa fa-undo',
        ];
    }
}