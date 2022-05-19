<?php

use common\helpers\PriceHelper;
use common\helpers\TimeHelper;
use common\models\Order;
use common\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;


/* @var $this View */
/* @var $model Order */
/* @var ActiveDataProvider $orderItemsDataProvider */

$this->title = "Order #{$model->code}";
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$pjaxId = 'order-items-pjax';

?>
<div class="row">
    <div class="col-xl-7 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="m-0">
                    <i class="fa fa-receipt mr-1"></i>
                    <?= Yii::t('app', 'Order') ?>
                    <strong>#<?= $model->code ?></strong>
                </h5>
                <?php if ($model->created_at) : ?>
                    <div class="ml-auto">
                        <?= TimeHelper::formatAsDateTime($model->created_at) ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php Pjax::begin(['id' => $pjaxId]); ?>
                <?= ListView::widget([
                    'dataProvider' => $orderItemsDataProvider,
                    'itemView' => 'partials/_order_item_card',
                    'pjaxId' => $pjaxId
                ]) ?>
                <?php Pjax::end() ?>
                <hr>
                <div class="row">
                    <div class="col-lg-8"></div>
                    <div class="col-lg-4">
                        <div class="d-flex align-items-center">
                            <span class="mr-auto"><?= Yii::t('app', 'Subtotal') ?></span>
                            <span><?= PriceHelper::format($model->subtotal) ?></span>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center">
                            <span class="mr-auto"><?= Yii::t('app', 'Total Tax') ?></span>
                            <span><?= PriceHelper::format($model->total_tax) ?></span>
                        </div>
                        <hr>
                        <div class="d-flex align-items-center font-weight-bold">
                            <span class="mr-auto"><?= Yii::t('app', 'Total') ?></span>
                            <span><?= PriceHelper::format($model->total) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-5">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <h5 class="m-0">
                    <i class="fa fa-truck mr-1"></i>
                    <?= Yii::t('app', 'Delivery details') ?>
                </h5>
                <?= Html::a('<i class="fa fa-wrench"></i>', Url::to(['order/update', 'id' => $model->id]), [
                    'class' => 'btn btn-sm btn-round btn-white btn-just-icon ml-auto',
                    'title' => Yii::t('app', 'Update')
                ]); ?>
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
</div>
