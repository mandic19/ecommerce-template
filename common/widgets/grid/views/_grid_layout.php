<?php

use yii\web\View;

/**
 * @var View $this
 * Available elements: {summary} {pager} {items} {collapsable}
 */
?>

<div class="grid-layout">
    <div class="row mb-3">
        <div class="col-sm-6"></div>
        <div class="col-sm-6 text-sm-right">{collapsable}</div>
        <div class="col-sm-6">{search}</div>
        <div class="col-sm-6 d-flex">{add}</div>
    </div>
    <div class="table-responsive">
        {items}
    </div>
    <div class="d-flex justify-content-between">
        {summary}{pager}
    </div>
</div>