<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

require "to_array.php";

/* @var $this yii\web\View */
/* @var $model app\models\teh\to\To */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'ТО', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Перечень оборудования', 'url' => ['schedule-equipment']];
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
              'label' => 'Наименование оборудования:',
              'value' => $model->toEq->tool ? $model->toEq->tool->tool_title . ' ' . $model->toEq->tool->fullTitle  : 'Оборудование удалено',
          ],
          [
              'label' => 'Вид ТО:',
              'value' => $to_kind[$model->to_type],
          ],
          [
              'label' => 'Дата проведения (план.):',
              'value' => $model->plan_date,
          ],
          [
              'label' => 'Дата проведения (факт.):',
              'value' => $model->fact_date,
          ],
          [
              'label' => 'Отметка о проведении:',
              'format'=>'raw',
              'value' => $model->checkmark ? '<span style="color:#4CAF50"><strong>ТО проведено</strong></span>' : '<span style="color:#CC0000"><strong>ТО не проведено</strong></span>',
          ],
          [
              'label' => 'Дата добавления:',
              'value' => $model->date_in,
          ],
      ],
  ]) ?>

</div>
