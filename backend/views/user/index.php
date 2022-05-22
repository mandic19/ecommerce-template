<?php

use common\widgets\Pjax;

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
    <?php Pjax::begin([
        'id' => $pjaxId,
        'gridId' => $gridId,
        'options' => ['data-pjax-loader-target' => $pjaxLoaderTarget]
    ]); ?>
    <?= $this->render('partials/_grid', [
        'dataProvider' => $dataProvider,
        'pjaxId' => $pjaxId,
        'gridId' => $gridId
    ]); ?>
    <?php Pjax::end(); ?>
</div>
