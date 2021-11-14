<?php

use common\helpers\BaseHelper;
use common\widgets\dropzone\Dropzone;
use common\widgets\TinyMce;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="product-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'category_id')->widget(Select2::class, [
                'data' => !empty($model->category) ? [$model->category_id => $model->category->name] : [],
                'options' => [
                    'placeholder' => Yii::t('app', 'Select a category...')
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                    'ajax' => [
                        'url' => Url::to(['product-category/suggest']),
                        'dataType' => 'json',
                        'delay' => 250,
                        'cache' => true
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'description')->widget(TinyMce::class, [
                'options' => ['rows' => 6]
            ]); ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'productImageIds')->widget(Dropzone::class, [
                'items' => BaseHelper::convertImagesToDropzoneFormat($model->getAllProductImages()),
                'enableSorting' => true
            ]) ?>
        </div>
    </div>
    <div class="form-group d-flex justify-content-end my-3">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-modal-control-submit btn-loading']) ?>
        <?= Html::button(Yii::t('app', 'Cancel'), ['class' => 'btn btn-secondary ml-2', 'data-dismiss' => 'modal']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
