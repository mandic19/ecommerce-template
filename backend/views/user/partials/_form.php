<?php

use common\helpers\CountryHelper;
use common\helpers\RbacHelper;
use kartik\select2\Select2;
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
            <?= $form->field($model, 'role')->widget(Select2::class, [
                'data' => RbacHelper::ROLES,
                'options' => ['value' => !$model->isNewRecord ? $model->getRole() : null]
            ]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'country')->widget(Select2::class, [
                'data' => CountryHelper::getList()
            ]) ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'zip')->textInput() ?>
        </div>
        <?php if($model->isNewRecord): ?>
            <div class="col-md-6 col-sm-12">
                <?= $form->field($model, 'password')->passwordInput() ?>
            </div>
            <div class="col-md-6 col-sm-12">
                <?= $form->field($model, 'password_repeat')->passwordInput() ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="form-group d-flex justify-content-end my-3">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-modal-control-submit btn-loading']) ?>
        <?= Html::button(Yii::t('app', 'Cancel'), ['class' => 'btn btn-secondary ml-2', 'data-dismiss' => 'modal']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
