<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'code',
            'subtotal',
            'total_tax',
            'total_discount',
            'shipping_cost',
            'total',
            'currency',
            'status',
            'delivery_first_name',
            'delivery_last_name',
            'delivery_address',
            'delivery_city',
            'delivery_zip',
            'delivery_country',
            'delivery_phone',
            'delivery_notes',
            'customer_ip_address',
            'customer_user_agent',
            'request:ntext',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            'is_deleted',
        ],
    ]) ?>

</div>
