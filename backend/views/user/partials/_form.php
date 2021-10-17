<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'zip')->textInput() ?>
        </div>
    </div>
    <div class="form-group d-flex justify-content-end my-3">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-modal-control-submit']) ?>
        <?= Html::button(Yii::t('app', 'Cancel'), ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
