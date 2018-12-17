<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

require "to_array.php";

/* @var $this yii\web\View */
/* @var $model app\models\teh\to\To */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ТО', 'url' => ['/teh/to/']];
$this->params['breadcrumbs'][] = ['label' => 'Перечень оборудования', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="to-view">

  <h1><?= Html::encode($this->title) ?></h1>

  <p>
    <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger btn-sm',
        'data' => [
            'confirm' => 'Вы уверены, что хотите удалить объект?',
            'method' => 'post',
        ],
    ]) ?>
  </p>
  <?= DetailView::widget([
      'model' => $model,
      'labelColOptions' => [
          'style' => 'width: 45%'
      ],
      'attributes' => [
          'id',
          [
              'label' => 'Наименование в графике',
              'value' => $model->eq_title,
          ],
          [
              'label' => 'Оборудования:',
              'value' => $model->tool ? $model->tool->tool_title . ' ' . $model->tool->fullTitle  : 'Оборудование удалено',
          ],
          [
              'label' => 'По порядку:',
              'value' => $model->order,
          ],
      ],
  ]) ?>

</div>
