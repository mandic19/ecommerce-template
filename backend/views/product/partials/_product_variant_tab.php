<?php
/**
 * Created by Marko Mandić on Nov, 2021
 * Email: marko.mandic.engr@gmail.com
 */

use common\models\ProductVariant;
use common\widgets\DynamicForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $form ActiveForm */
/* @var $formId string */
/* @var $productVariants ProductVariant[] */

?>

<?php DynamicForm::begin([
    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
    'widgetBody' => '.container-items', // required: css class selector
    'widgetItem' => '.item', // required: css class
    'min' => 0, // 0 or 1 (default 1)
    'insertButton' => '.add-item', // css class
    'deleteButton' => '.remove-item', // css class
    'model' => $productVariants[0],
    'formId' => $formId,
    'formFields' => [
        'name',
        'sku',
        'quantity',
        'price',
    ],
]); ?>

<?= Html::button('<i class="fa fa-plus"></i> ' . Yii::t('app', 'Add Product Variant'), [
    'class' => 'btn btn-success add-item d-block'
]); ?>
<div class="container-items row mt-3">
    <?php foreach ($productVariants as $index => $productVariant) : ?>
        <div class="item col-lg-6 col-xl-4 mb-3">
            <div class="card">
                <div class="card-header py-1">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0"><?= Yii::t('app', 'Product Variant'); ?></h6>
                        <span class="btn btn-white btn-just-icon remove-item">
                            <i class="fa fa-trash"></i>
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <?= !$productVariant->isNewRecord ? Html::activeHiddenInput($productVariant, "[{$index}]id") : null ?>
                    <div class="row">
                        <div class="col-sm-8">
                            <?= $form->field($productVariant, "[{$index}]name")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($productVariant, "[{$index}]quantity")->textInput(['type' => 'number', 'min' => 0]) ?>
                        </div>
                        <div class="col-sm-8">
                            <?= $form->field($productVariant, "[{$index}]sku")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-4">
                            <?= $form->field($productVariant, "[{$index}]price")->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php DynamicForm::end(); ?>
