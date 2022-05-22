<?php

/**
 * @var string $content
 * @var View $this
 */

use backend\assets\AppAsset;
use common\helpers\BaseHelper;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Menu;

$webUser = Yii::$app->user->identity;
$breadcrumbParams = $this->params['breadcrumbs'] ?? [];
$hasHomeLink = $this->params['breadcrumbsHomeLink'] ?? true;

AppAsset::register($this);

?>
<?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="<?= !empty($_COOKIE['sidebarCollapsed']) && $_COOKIE['sidebarCollapsed'] == 'true' ? 'sidebar-collapsed' : '' ?>">
    <?php $this->beginBody(); ?>
    <!-- left sidebar -->
    <section class="left-sidebar">
        <!-- Site Logo -->
        <div class="navbar nav_title">
            <a href="/" class="site_title">
                <i class="fa fa-paw"></i>
                <span>Gentellela Alela!</span>
            </a>
        </div>
        <!-- Site Logo -->
        <!-- User profile info -->
        <div class="user-profile">
            <div class="avatar">
                <img src="/img/dummy_avatar.jpg" alt="...">
            </div>
            <div class="info">
                <span class="text-agate-gray">Welcome,</span>
                <span><?= $webUser->getFullName() ?></span>
            </div>
        </div>
        <!-- User profile info -->
        <br/>
        <!-- sidebar menu -->
        <div class="sidebar-menu">
            <?= Menu::widget(
                [
                    'encodeLabels' => false,
                    'options' => ['class' => 'list-group'],
                    'itemOptions' => ['class' => 'list-group-item'],
                    'items' => [
                        ["label" => "<i class='fa fa-home fa-lg'></i><span>Home</span>", "url" => ['site/index']],
                        ["label" => "<i class='fa fa-shopping-cart fa-lg'></i><span>Orders</span>", "url" => ["/order/index"]],
                        ["label" => "<i class='fa fa-list fa-lg'></i><span>Categories</span>", "url" => ["/product-category/index"]],
                        ["label" => "<i class='fa fa-cubes fa-lg'></i><span>Products</span>", "url" => ["/product/index"]],
                        ["label" => "<i class='fa fa-users fa-lg'></i><span>Users</span>", "url" => ["/user/index"]],
                    ],
                ]
            ); ?>
        </div>
        <!-- /sidebar menu -->
    </section>
    <!-- /left sidebar -->
    <!-- content container -->
    <section class="content-container">
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light mb-4">
            <span class="btn btn-secondary btn-toggle-sidebar">
            </span>
            <?= BaseHelper::renderBreadcrumbs($breadcrumbParams, $hasHomeLink); ?>
            <ul class="list-unstyled my-auto ml-auto">
                <li class="nav-item dropdown">
                    <span class="nav-link dropdown-toggle nav-avatar px-2 py-0"
                          id="navbarDropdownMenuLink"
                          role="button"
                          data-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                    >
                        <img src="/img/dummy_avatar.jpg" alt="..." class="mr-2">
                        <?= Yii::t('app', 'Hi, {:user}', [':user' => Yii::$app->user->getIdentity()->getFullName()]); ?>
                    </span>
                    <div class="dropdown-menu dropdown-menu-right right mt-2 p-0"
                         aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item d-flex justify-content-between align-items-center py-2 btn-modal-control btn-loading btn-loading-right"
                           data-href="<?= Url::to(['user/edit-profile']) ?>"
                        >
                            <?= Yii::t('app', 'Edit Profile') ?>
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="dropdown-item d-flex justify-content-between align-items-center py-2 btn-modal-control btn-loading btn-loading-right"
                           data-href="<?= Url::to(['user/change-password']) ?>"
                           data-size="modal-md"
                        >
                            <?= Yii::t('app', 'Change Password') ?>
                            <i class="fas fa-lock"></i>
                        </a>
                        <a class="dropdown-item d-flex justify-content-between align-items-center py-2"
                           data-method="post"
                           href="<?= Url::to(['site/logout']) ?>"
                        >
                            <?= Yii::t('app', 'Log Out') ?>
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /navbar -->
        <div class="content-body px-3">
            <?= $content ?>
        </div>
        <!-- footer container -->
        <footer>
            <div class="d-flex justify-content-center justify-content-sm-end">
                <span>Ecommerce sample application made with <i class="fa fa-heart"></i> !</span>
            </div>
        </footer>
        <!-- /footer container -->
        <div class="backdrop-box btn-toggle-sidebar"></div>
    </section>
    <!-- /content container -->

    <!-- main modal -->
    <?= Modal::widget(['id' => 'main-modal', 'size' => Modal::SIZE_LARGE, 'options' => [
        'data-backdrop' => 'static',
        'class' => 'p-0',
        'tabindex' => null
    ]]); ?>
    <!-- /main modal -->
    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>