<?php

namespace app\assets;

use yii\web\AssetBundle;


class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    public $css = [
          'css/fonts.css',
          'lib/awesome/css/font-awesome.min.css',
          'css/w3.css',
          'css/w3_my.css',
          'css/bootstrap-datepicker.min.css',
    ];
    public $js = [
        '/js/activ.js',
        '/js/tether.min.js',
        '/js/jquery.mCostomScrollbar.min.js',
        '/js/bootstrap-datepicker.min.js',
        '/js/bootstrap-datepicker.ru.min.js',
        '/js/moment-with-locales.min.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\TableBaseAsset',
    ];
}
