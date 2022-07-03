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
      'css/site.css?246',
      'admin-lte/dist/css/AdminLTE.css'
  ];
  public $js = [
    'admin-lte/dist/js/AdminLTE/app.js'
  ];
  public $depends = [
      'yii\web\YiiAsset',
      'yii\bootstrap4\BootstrapAsset',
  ];
}
