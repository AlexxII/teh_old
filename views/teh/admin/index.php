<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Администрирование';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

  <div class="w3-col l5 m6 left">
    <div class="jumbotron">
      <h1>Оборудование</h1>
      <p class="lead">Средства управления оборудованием (добавление, просмотр, обновление, удаление)</p>
      <p><a class="btn btn-lg btn-success" href="/teh/admin/equipment">Подробнее</a></p>
    </div>
  </div>

  <div class="w3-col l6 m6 right">
    <div class="jumbotron">
      <h1>Дополнительно</h1>
      <p class="lead">Средства управления дополнительной информацией (добавление, просмотр, обновление, удаление)</p>
      <p><a class="btn btn-lg btn-success" href="/teh/admin/assist">Подробнее</a></p>
    </div>
  </div>


</div>
