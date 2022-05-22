<?php

use common\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Home');
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbsHomeLink'] = false;


$gridId = 'dashboard-grid';
$pjaxId = 'dashboard-index-pjax';
$pjaxLoaderTarget = "#{$gridId} tbody";

?>

<div class="daily-board-index">
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
