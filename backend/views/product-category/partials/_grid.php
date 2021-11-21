<?php

use common\components\image\ImageSpecification;
use common\models\ProductCategory;
use common\widgets\grid\TreeGrid;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $gridId string */
/* @var $pjaxId string */
/* @var $dataProvider ActiveDataProvider */

?>

<?= TreeGrid::widget([
    'id' => $gridId,
    'pjaxId' => $pjaxId,
    'dataProvider' => $dataProvider,
    'keyColumnName' => 'id',
    'parentColumnName' => 'parent_category_id',
    'parentColumnWithAlias' => 'product_category.parent_category_id',
    'collapsable' => true,
    'enableAdd' => true,
    'addButtonOption' => [
        'content' => '<i class="fa fa-list fa-lg mr-3"></i>' . Yii::t('app', 'Add New Category')
    ],
    'columns' => [
        [
            'label' => Yii::t("app", "Category"),
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function (ProductCategory $model) {
                if(!$model->cover_image_id) {
                    return $model->name;
                }

                $src = Url::to(['/image/view', 'id' => $model->cover_image_id, 'spec' => ImageSpecification::THUMB_EXTRA_SMALL_SQUARED]);
                $img = Html::img($src, [
                    'class' => 'thumb thumb-xs mr-4',
                    'alt' => $model->name
                ]);

                return "{$img} {$model->name}";
            },
            'contentOptions' => ['class' => 'text-nowrap']
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '<div class="d-flex justify-content-end">{update}{delete}</div>',
            'buttons' => [
                'update' => function ($url, ProductCategory $model) {
                    $url = Url::to(['/product-category/update', 'id' => $model->id]);

                    return Html::tag('span', '<i class="fa fa-wrench"></i>', [
                        'data-href' => $url,
                        'class' => 'btn btn-sm btn-round btn-white btn-just-icon btn-loading btn-modal-control mr-2',
                        'title' => Yii::t('app', 'Update')
                    ]);
                },
                'delete' => function ($url, ProductCategory $model) use ($pjaxId) {
                    $url = Url::to(['/product-category/delete', 'id' => $model->id]);
                    $msg = Yii::t('app', 'Are you sure you want to delete category: {:name}', [':name' => $model->name]);

                    return Html::tag('span', '<i class="fa fa-trash"></i>', [
                        'data-href' => $url,
                        'data-confirm-msg' => $msg,
                        'data-grid' => $pjaxId,
                        'data-type' => 'post',
                        'class' => 'btn btn-sm btn-round btn-white btn-just-icon btn-control-pjax-action',
                        'title' => Yii::t('app', 'Delete')
                    ]);
                },
            ],
        ],
    ]
]); ?>