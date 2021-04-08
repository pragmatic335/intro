<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{

//$this->registerJsFile('/js/plugins/metisMenu/jquery.metisMenu.js', ['depends' => ['yii\web\JqueryAsset']]);
//$this->registerJsFile('/js/plugins/slimscroll/jquery.slimscroll.min.js', ['depends' => ['yii\web\JqueryAsset']]);
//$this->registerJsFile('/js/plugins/toastr/toastr.min.js', ['depends' => ['yii\web\JqueryAsset']]);
//$this->registerJsFile('/js/plugins/sweetalert/sweetalert.min.js', ['depends' => ['yii\web\JqueryAsset']]);

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/inspinia.css'
    ];
    public $js = [
        '/js/inspinia.js',
        '/js/plugins/slimscroll/jquery.slimscroll.min.js',
        '/js/plugins/metisMenu/jquery.metisMenu.js',
//        'js/plugins/slimscroll/jquery.slimscroll.js',
//        '/js/plugins/metisMenu/jquery.metisMenu.js',

        '/js/plugins/toastr/toastr.min.js',
        '/js/plugins/sweetalert/sweetalert.min.js'


    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
