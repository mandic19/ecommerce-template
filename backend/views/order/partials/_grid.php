<?php
/**
 * Created by Marko Mandić on Dec, 2021
 * Email: marko.mandic.engr@gmail.com
 */

use common\components\image\ImageSpecification;
use common\helpers\OrderStatusHelper;
use common\helpers\RbacHelper;
use common\helpers\TimeHelper;
use common\models\Order;
use common\models\Product;
use common\widgets\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $pjaxId string */
/* @var $gridId string */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>

<?= GridView::widget([
    'id' => $gridId,
    'pjaxId' => $pjaxId,
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'label' => Yii::t('app', 'Order #'),
            'format' => 'raw',
            'value' => function(Order $model) {
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
            'format' => 'raw',
        ],
        'total'
    ],
]); ?>
