<?php
/**
 * @link      http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license   http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since  2.0
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css
        = [
            'css/admin.css',
            'css/bootstrap.css',
            'css/errors.css',
            'css/font-awesome.css',
            'css/main.css',
            'assets/vendor/bootstrap/css/bootstrap.min.css',
            'assets/vendor/fonts/circular-std/style.css',
            'assets/libs/css/style.css',
            'assets/vendor/fonts/fontawesome/css/fontawesome-all.css',
            'assets/vendor/charts/chartist-bundle/chartist.css',
            'assets/vendor/charts/morris-bundle/morris.css',
            'assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css',
            'assets/vendor/charts/c3charts/c3.css',
            'assets/vendor/fonts/flag-icon-css/flag-icon.min.css',

        ];
    public $js
        = [
            'assets/vendor/jquery/jquery-3.3.1.min.js',
            'assets/vendor/bootstrap/js/bootstrap.bundle.js',
            'assets/vendor/slimscroll/jquery.slimscroll.js',
            'assets/libs/js/main-js.js',
            'assets/vendor/charts/chartist-bundle/chartist.min.js',
            'assets/vendor/charts/sparkline/jquery.sparkline.js',
            'assets/vendor/charts/morris-bundle/raphael.min.js',
            'assets/vendor/charts/morris-bundle/morris.js',
            'assets/vendor/charts/c3charts/c3.min.js',
            'assets/vendor/charts/c3charts/d3-5.4.0.min.js',
            'assets/vendor/charts/c3charts/C3chartjs.js',
            'assets/libs/js/dashboard-ecommerce.js',
        ];

    public function init()
    {
        parent::init();
        // resetting BootstrapAsset to not load own css files
        \Yii::$app->assetManager->bundles['yii\\bootstrap\\BootstrapAsset'] = [
            'css' => [],
            'js'  => [],
        ];
    }
}
