<?php

/**
 * @var string $content
 * @var View $this
 */


use backend\assets\AppAsset;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\web\View;
use yiister\gentelella\widgets\Menu;

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
    <body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>">
    <?php $this->beginBody(); ?>
    <div class="container body">

        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="/" class="site_title"><i class="fa fa-paw"></i> <span>Gentellela Alela!</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="/img/dummy_avatar.jpg" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>John Doe</h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br/>

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <?=
                            Menu::widget(
                                [
                                    "items" => [
                                        ["label" => "Home", "url" => "/", "icon" => "home"],
                                        ["label" => "Users", "url" => ["/user"], "icon" => "users"],
                                        ["label" => "Error page", "url" => ["site/error-page"], "icon" => "close"],
                                        [
                                            "label" => "Widgets",
                                            "icon" => "th",
                                            "url" => "#",
                                            "items" => [
                                                ["label" => "Menu", "url" => ["site/menu"]],
                                                ["label" => "Panel", "url" => ["site/panel"]],
                                            ],
                                        ],
                                        [
                                            "label" => "Badges",
                                            "url" => "#",
                                            "icon" => "table",
                                            "items" => [
                                                [
                                                    "label" => "Default",
                                                    "url" => "#",
                                                    "badge" => "123",
                                                ],
                                                [
                                                    "label" => "Success",
                                                    "url" => "#",
                                                    "badge" => "new",
                                                    "badgeOptions" => ["class" => "label-success"],
                                                ],
                                                [
                                                    "label" => "Danger",
                                                    "url" => "#",
                                                    "badge" => "!",
                                                    "badgeOptions" => ["class" => "label-danger"],
                                                ],
                                            ],
                                        ],
                                        [
                                            "label" => "Multilevel",
                                            "url" => "#",
                                            "icon" => "table",
                                            "items" => [
                                                [
                                                    "label" => "Second level 1",
                                                    "url" => "#",
                                                ],
                                                [
                                                    "label" => "Second level 2",
                                                    "url" => "#",
                                                    "items" => [
                                                        [
                                                            "label" => "Third level 1",
                                                            "url" => "#",
                                                        ],
                                                        [
                                                            "label" => "Third level 2",
                                                            "url" => "#",
                                                        ],
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ]
                            )
                            ?>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:void(0);" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false">
                                    <img src="/img/dummy_avatar.jpg" alt="">John Doe
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="javascript:void(0);"> Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Help</a>
                                    </li>
                                    <li>
                                        <?= Html::a('<i class="fa fa-sign-out pull-right"></i>Log Out</a>', ['/site/logout'], [
                                            'class' => 'dropdown-item',
                                            'data-method' => 'post'
                                        ]) ?>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle info-number" data-toggle="dropdown"
                                   aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                    <li>
                                        <a>
                                    <span class="image">
                                        <img src="/img/dummy_avatar.jpg" alt="Profile Image"/>
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                      <span class="image">
                                        <img src="/img/dummy_avatar.jpg" alt="Profile Image"/>
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                      <span class="image">
                                        <img src="/img/dummy_avatar.jpg" alt="Profile Image"/>
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                      <span class="image">
                                        <img src="/img/dummy_avatar.jpg" alt="Profile Image"/>
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a href="/">
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <?php if (isset($this->params['h1'])): ?>
                    <div class="page-title">
                        <div class="title_left">
                            <h1><?= $this->params['h1'] ?></h1>
                        </div>
                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="clearfix"></div>

                <?= $content ?>
            </div>
            <!-- /page content -->
            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Ecommerce sample application made with <i class="fa fa-heart"></i> !
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <?= Modal::widget(['id' => 'main-modal', 'size' => Modal::SIZE_LARGE, 'options' => ['data-backdrop' => 'static']]); ?>
    <!-- /footer content -->
    <?php $this->endBody(); ?>
    </body>
    </html>
<?php $this->endPage(); ?>