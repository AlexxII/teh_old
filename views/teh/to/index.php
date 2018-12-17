<?php

use yii\helpers\Html;

/* @var $this yii\web\Index*/
/* @var $model app\models\teh\to\To */

$this->title = 'Техническое обслуживание';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="to-create">

  <h1><?= Html::encode($this->title) ?></h1>

  <?= Html::a('Графики ТО', '/teh/to/to-schedule/index'); ?>
  <br>
<!--  <?/*= Html::a('График ТО', '/teh/to/to-schedule/view'); */?>
  <br>
-->  <?= Html::a('Добавить график ТО', '/teh/to/to-schedule/create'); ?>
  <br>
  <hr>
  <?= Html::a('Перечень оборудования в графике ТО', '/teh/to/to-equipment/index'); ?>
  <br>
  <?= Html::a('Добавить оборудование в график ТО', '/teh/to/to-equipment/create'); ?>
  <br>
  <?= Html::a('Порядок отображения оборудования в графике ТО', '/teh/to/to-equipment/order'); ?>
  <br>
  <hr>
  <?= Html::a('Наработка оборудования', '/teh/to/to-equipment/operation-time'); ?>

</div>
