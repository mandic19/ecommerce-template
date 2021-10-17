<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/theme-patch.css'
    ];
    public $js = [
        'js/main.ui.js',
        'js/sweetalert2.all.js',
        'js/modal.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'yiister\gentelella\assets\ThemeAsset',
        'yiister\gentelella\assets\ExtensionAsset',
    ];
}
