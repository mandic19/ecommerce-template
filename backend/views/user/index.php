<?php

use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div class="row my-2">
        <div class="col-md-6">
            <h1 class="m-0"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col-md-6 text-right">
            <?= Html::a(
                Html::tag('i', '', ['class' => 'fa fa-user fa-lg mr-3']) . Yii::t('app', 'Add New User'),
                ['create'],
                ['class' => 'btn btn-success m-0']
            ) ?>
        </div>
    </div>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped table-primary mb-2'],
        'layout' => "{items}\n{summary}{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => Yii::t('app', 'User'),
                'format' => 'raw',
                'value' => function (User $model) {
                    return $this->render('partials/_avatar', ['model' => $model]);
                }
            ],
            [
                'label' => Yii::t('app', 'Contact Details'),
                'format' => 'raw',
                'value' => function (User $model) {
                    $emailRowContent = "<i class='fa fa-envelope mr-2'></i><a href='mailto:{$model->email}'>{$model->email}</a>";
                    $emailRow = !empty($model->email) ? Html::tag('div', $emailRowContent, ['class' => 'mb-1']) : "";

                    $phoneRowContent = "<i class='fa fa-phone mr-2'></i><a href='tel:{$model->email}'>+38766638976</a>";
                    $phoneRow = !empty($model->email) ? Html::tag('div', $phoneRowContent) : "";

                    return "{$emailRow}{$phoneRow}";
                }
            ],
            [
                'label' => Yii::t('app', 'Location'),
                'format' => 'raw',
                'value' => function (User $model) {
                    $addressRow = !empty($model->address) ? "<div class='mb-1'><strong>{$model->address}</strong></div>" : "";
                    $tempArray = [];

                    if(!empty($model->city)){
                        $tempArray[] = $model->city;
                    }
                    if(!empty($model->country)){
                        $tempArray[] = $model->country;
                    }
                    if(!empty($model->zip)){
                        $tempArray[] = $model->zip;
                    }

                    $cityCountryZipRow = (!empty($tempArray)) ? Html::tag('div', implode(', ', $tempArray)) : '';
                    return "{$addressRow}{$cityCountryZipRow}";
                }
            ],
            //'status',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
