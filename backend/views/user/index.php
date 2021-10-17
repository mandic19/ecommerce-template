<?php

use common\helpers\BaseHelper;
use common\helpers\RbacHelper;
use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;

$pjaxId = 'user-index-pjax';

?>

<div class="user-index">
    <div class="row mb-2 mb-sm-4">
        <div class="col-sm-6">
            <div class="d-flex align-items-center">
                <h1><?= Html::encode($this->title) ?></h1>
                <div class="form-group top_search m-0 mx-4">
                    <div class="input-group m-0">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 d-flex">
            <?= Html::tag('span', '<i class="fa fa-user fa-lg mr-3"></i>' . Yii::t('app', 'Add New User'), [
                'data-href' => Url::to(['user/create']),
                'class' => 'btn btn-success btn-modal-control btn-loading my-auto ml-sm-auto',
            ]); ?>
        </div>
    </div>
    <?php Pjax::begin(['id' => $pjaxId]); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'options' => ['class' => 'table-responsive'],
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

                    $phoneRowContent = "<i class='fa fa-phone mr-2'></i><a href='tel:{$model->phone}'>{$model->phone}</a>";
                    $phoneRow = !empty($model->email) ? Html::tag('div', $phoneRowContent) : "";

                    return "{$emailRow}{$phoneRow}";
                }
            ],
            [
                'label' => Yii::t('app', 'Location'),
                'format' => 'raw',
                'value' => function (User $model) {
                    $addressRow = !empty($model->address) ? "<div class='mb-1'><strong>{$model->address}</strong></div>" : "";
                    $cityCountryZipRow = BaseHelper::formatToCharSeparatedString([$model->city, $model->country, $model->zip]);

                    $cityCountryZipRow = !empty($cityCountryZipRow) ? Html::tag('div', $cityCountryZipRow) : '';
                    return "{$addressRow}{$cityCountryZipRow}";
                }
            ],
            [
                'label' => Yii::t('app', 'Active'),
                'format' => 'raw',
                'value' => function (User $model) use ($pjaxId) {
                    $input = Html::activeInput('checkbox', $model, "[{$model->id}]status", ['checked' => $model->status === User::STATUS_ACTIVE]);
                    $label = Html::label('', Html::getInputId($model, "[{$model->id}]status"));

                    $content =
                        "<div class='toggle-switch-wrap'>
                            <span class='toggle-switch toggle-switch-reverse'>
                                {$input}
                                {$label}
                            </span>
                        </div>";

                    if ($model->status === User::STATUS_ACTIVE) {
                        $url = Url::to(['user/deactivate', 'id' => $model->id]);
                        $action = 'deactivate';
                    } else {
                        $url = Url::to(['user/activate', 'id' => $model->id]);
                        $action = 'activate';
                    }

                    return Html::tag('div', $content, [
                        'class' => 'btn-control-confirm',
                        'data-msg' => Yii::t('app', "Are you sure you want to {$action} user: {$model->getFullName()}?"),
                        'data-url' => $url,
                        'data-json-response' => 1,
                        'data-loader' => 0,
                        'data-pjax-id' => $pjaxId
                    ]);
                }],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '<div class="d-flex justify-content-end">{update}{delete}</div>',
                'buttons' => [
                    'update' => function ($url, User $model) {
                        if (!Yii::$app->user->can(RbacHelper::ROLE_SUPER_ADMIN)) {
                            return null;
                        }

                        $url = Url::to(['user/update', 'id' => $model->id]);

                        return Html::tag('span', '<i class="fa fa-wrench"></i>', [
                            'data-href' => $url,
                            'class' => 'btn btn-sm btn-round btn-white btn-just-icon btn-loading btn-modal-control mr-2',
                        ]);
                    },
                    'delete' => function ($url, User $model) use ($pjaxId) {
                        if (!Yii::$app->user->can(RbacHelper::ROLE_SUPER_ADMIN)) {
                            return null;
                        }

                        $url = Url::to(['/user/delete', 'id' => $model->id]);
                        $msg = Yii::t('app', 'Are you sure you want to delete user: ') . $model->getFullName();
                        return Html::tag('span', '<i class="fa fa-trash"></i>', [
                            'data-href' => $url,
                            'data-confirm-msg' => $msg,
                            'data-grid' => $pjaxId,
                            'data-type' => 'post',
                            'class' => 'btn btn-sm btn-round btn-white btn-just-icon btn-control-pjax-action',
                            'title' => 'Delete'
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
