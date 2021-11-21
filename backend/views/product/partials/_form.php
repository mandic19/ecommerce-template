<?php

use common\helpers\BaseHelper;
use common\widgets\dropzone\Dropzone;
use common\widgets\FlashMessage;
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
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#general-info" role="tab">
                <?= Yii::t('app', 'General Info') ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#product-variants" role="tab">
                <?= Yii::t('app', 'Product Variants') ?>
            </a>
        </li>
    </ul>
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="tab-content">
                <div class="tab-pane active" id="general-info" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-6">
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
                                    ]); ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'quantity')->textInput(); ?>
                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($model, 'price')->textInput(); ?>
                                </div>
                                <div class="col-12">
                                    <?= $form->field($model, 'short_description')->textarea([
                                        'rows' => 3
                                    ]); ?>
                                </div>
                                <div class="col-12">
                                    <?= $form->field($model, 'description')->widget(TinyMce::class, [
                                        'options' => ['rows' => 6]
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-12">
                                    <?= $form->field($model, 'productImageIds')->widget(Dropzone::class, [
                                        'items' => BaseHelper::convertImagesToDropzoneFormat($model->getAllProductImages()),
                                        'enableSorting' => true
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="product-variants" role="tabpanel">
                    To be implemented...
                </div>
            </div>
            <div class="form-group d-flex justify-content-end my-3">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'Cancel'), Url::to(['index']), ['class' => 'btn btn-secondary ml-2']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?= FlashMessage::widget(); ?>
</div>
