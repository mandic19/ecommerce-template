<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

$this->title = $name;
$response = Yii::$app->response;
?>
<div class="col-md-12">
    <div class="col-middle">
        <div class="text-center text-center">
            <h1 class="error-number"><?= $response->statusCode ?></h1>
            <?php if($response->statusCode == 404) : ?>
                <h2>Sorry but we couldn't find this page</h2>
                <p>This page you are looking for does not exist
                    <a href="#">Report this?</a>
                </p>
            <?php elseif($response->statusCode == 403) : ?>
                <h2>Access denied</h2>
                <p>Full authentication is required to access this resource.
                    <a href="#">Report this?</a>
                </p>
            <?php elseif($response->statusCode == 500) : ?>
                <h2>Internal Server Error</h2>
                <p>We track these errors automatically, but if the problem persists feel free to contact us. In the meantime, try refreshing.
                    <a href="#">Report this?</a>
                </p>
            <?php else : ?>
                <h2><?= $message ?></h2>
                <p></p>
            <?php endif; ?>
            <div class="mid_center">
                <h3>Search</h3>
                <form>
                    <div class="form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <a href="index">
                                    <button class="btn btn-secondary" type="button">Go!</button>
                                </a>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
