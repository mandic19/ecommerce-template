<?php
/**
 * Created by Marko Mandić on Dec, 2021
 * Email: marko.mandic.engr@gmail.com
 */

use common\helpers\BaseHelper;
use common\helpers\OrderStatusHelper;
use common\helpers\PriceHelper;
use common\helpers\TimeHelper;
use common\models\Order;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $pjaxId string */
/* @var $gridId string */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $customerColumnVisible boolean */

?>

<?= GridView::widget([
    'id' => $gridId,
    'pjaxId' => $pjaxId,
    'dataProvider' => $dataProvider,
    'title' => Yii::t('app', 'Orders'),
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => Yii::t('app', 'Order #'),
            'format' => 'raw',
            'attribute' => 'order',
            'value' => function (Order $model) {
                $statusBadge = OrderStatusHelper::getStatusBadge($model->status);
                $code = Html::a($model->code, Url::to(['order/view', 'id' => $model->id]), [
                    'data-pjax' => 0,
                ]);
                $createdAt = $model->created_at ? TimeHelper::formatAsDateTime($model->created_at) : '';
                $details = Html::tag('div', "<strong>{$code}</strong><br><small>{$createdAt}</small>", [
                    'class' => 'ml-2'
                ]);

                return Html::tag('div', "{$statusBadge}{$details}", [
                    'class' => 'd-flex align-items-center'
                ]);
            }
        ],
        [
            'label' => Yii::t('app', 'Customer'),
            'attribute' => 'customer',
            'format' => 'raw',
            'visible' => $customerColumnVisible ?? true,
            'value' => function (Order $model) {
                $user = $model->user;

                return !empty($user) ? $this->render(Url::to(['shared/partials/_avatar']), [
                    'model' => $model->user
                ]) : null;
            }
        ],
        [
            'label' => Yii::t('app', 'Delivery Address'),
            'attribute' => 'delivery_address',
            'format' => 'raw',
            'value' => function (Order $model) {
                $addressRow = !empty($model->delivery_address) ? "<div class='mb-1'><strong>{$model->delivery_address}</strong></div>" : "";
                $cityCountryZipRow = BaseHelper::formatToCharSeparatedString([$model->delivery_city, $model->delivery_country, $model->delivery_zip]);

                $cityCountryZipRow = !empty($cityCountryZipRow) ? Html::tag('div', $cityCountryZipRow) : '';
                return "{$addressRow}{$cityCountryZipRow}";
            }
        ],
        [
            'label' => Yii::t('app', 'Subtotal'),
            'attribute' => 'subtotal',
            'format' => 'raw',
            'value' => function (Order $model) {
                $formattedPrice = PriceHelper::format($model->subtotal);
                return Html::tag('strong', $formattedPrice);
            }
        ],
        [
            'label' => Yii::t('app', 'Total Tax'),
            'attribute' => 'total_tax',
            'format' => 'raw',
            'value' => function (Order $model) {
                $formattedPrice = PriceHelper::format($model->total_tax);
                return Html::tag('strong', $formattedPrice);
            }
        ],
        [
            'label' => Yii::t('app', 'Total'),
            'attribute' => 'total',
            'format' => 'raw',
            'value' => function (Order $model) {
                $formattedPrice = PriceHelper::format($model->total);
                return Html::tag('strong', $formattedPrice);
            }
        ],
    ],
]); ?>
