<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$queryParam = Yii::$app->request->getQueryParam('q');

?>

<div class="shared-search">
    <?php $form = ActiveForm::begin([
        'id' => 'shared-search-filter',
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    <div class="d-flex align-items-center">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="form-group top_search m-0 mx-4 <?= !empty($queryParam) ? 'flex-grow-1' : '' ?>">
            <div class="input-group m-0">
                <?= Html::input('text', 'q', $queryParam, [
                    'class' => 'form-control',
                    'placeholder' => Yii::t('app', 'Search...'),
                    'autocomplete' => 'off'
                ]); ?>
                <span class="input-group-btn">
                    <?php if (!empty($queryParam)) : ?>
                        <?= Html::a('<i class="fa fa-close"></i>', Url::to(['', 'q' => '']), ['class' => 'btn btn-default']) ?>
                    <?php endif; ?>
                    <?= Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-default']) ?>
                </span>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
