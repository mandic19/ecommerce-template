<?php

use yii\web\View;

/**
 * @var View $this
 * Available elements: {summary} {pager} {items} {collapsable}
 */
?>

<div class="grid-layout">
    <div class="row mb-2 flex-column-reverse flex-md-row">
        <div class="col-md-6">{search}</div>
        <div class="col-md-6 m-auto">
            <div class="d-flex align-items-center justify-content-md-end flex-wrap flex-md-nowrap">
                {collapsable}{add}
            </div>
        </div>
    </div>
    <div class="table-responsive">
        {items}
    </div>
    <div class="d-flex justify-content-between">
        {summary}{pager}
    </div>
</div>