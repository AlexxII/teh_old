<?php

//Asset for DataTables tables;

namespace app\assets;

use yii\web\AssetBundle;

class TableBaseAsset extends AssetBundle
{

  public $css = [
      'dataTable/css/datatable.all.css',
  ];

  public $js = [
      '/js/bootstrap.min.js',
//      '/dataTable/js/jquery.dataTables.min.js',
      '/dataTable/js/datatable.all.js',
  ];

}