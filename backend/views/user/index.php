<?php

use common\helpers\RbacHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;

$gridId = 'user-grid';
$pjaxId = 'user-index-pjax';
$pjaxLoaderTarget = "#{$gridId} tbody";

?>

<div class="user-index">
    <?php Pjax::begin(['id' => $pjaxId, 'timeout' => 5000, 'options' => ['data-pjax-loader-target' => $pjaxLoaderTarget]]); ?>
    <div class="row mb-2">
        <div class="col-sm-6">
            <?= $this->render('/shared/partials/_search') ?>
        </div>
        <div class="col-sm-6 d-flex">
            <?php if(Yii::$app->user->can(RbacHelper::ROLE_SUPER_ADMIN)) : ?>
                <?= Html::tag('span', '<i class="fa fa-user fa-lg mr-3"></i>' . Yii::t('app', 'Add New User'), [
                    'data-href' => Url::to(['user/create']),
                    'class' => 'btn btn-success btn-modal-control btn-loading my-auto ml-sm-auto',
                ]); ?>
            <?php endif; ?>
        </div>
    </div>
    <?= $this->render('partials/_grid', [
        'dataProvider' => $dataProvider,
        'pjaxId' => $pjaxId,
        'gridId' => $gridId
    ]); ?>
    <?php Pjax::end(); ?>
</div>
