<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\teh\ibp\Ibp */

$this->title = $model->tool->tool_model;
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];
$this->params['breadcrumbs'][] = ['label' => 'ИБП', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ibp-view">

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

  <div class="w3-row">
    <div class="w3-col l7 m7 container">

      <?= DetailView::widget([
          'model' => $model,
          'labelColOptions' => [
                  'style' => 'width: 45%'
          ],
          'attributes' => [
              'id',
              [
                  'label' => 'Категория:',
                  'value' => $model->tool->category ? $model->tool->category->cat_title : '-',
              ],
              [
                  'label' => 'Наименование:',
                  'value' => $model->tool->tool_title,
              ],
              [
                  'label' => 'Производитель:',
                  'value' => $model->tool->tool_manufact,
              ],
              [
                  'label' => 'Модель:',
                  'value' => $model->tool->tool_model,
              ],
              [
                  'label' => 's/n:',
                  'value' => $model->tool->tool_serial,
              ],
              [
                  'label' => 'Дата производства:',
                  'value' => $model->tool->factory_date,
              ],
              [
                  'label' => 'Место расположения:',
                  'value' => $model->tool->place ? $model->tool->place->place_title : '-',
              ],
              'num_of_bat',
              [
                  'label' => 'Тип АКБ:',
                  'value' => $model->battery ? $model->battery->bat_type . " " .  $model->battery->bat_size : '-',
              ],
              'num_of_use',
              [
                  'label' => 'Батарея внутри:',
                  'value' => $model->bat_in ? 'ДА' : 'НЕТ',
              ],
              [
                  'label' => 'Изображения:',
                  'format' => 'raw',
                  'value' => $model->tool->photos ? '<a href="#" style="color: #3f51b5">' . count($model->tool->photos) . ' штук(и)' . '</a>' : 'отсутствуют',
              ]
          ],
      ]) ?>
    </div>

    <div class="w3-col m5 l5 container w3-center">
      <?php
      if ($photos = $model->tool->photos) {
        foreach ($photos as $photo) {
          $ph[] = ['img' => $photo->getImageUrl()];
        }
        echo \metalguardian\fotorama\Fotorama::widget(
            [
                'items' => $ph,
                'options' => [
                    'nav' => 'thumbs',
                    'allowfullscreen' => true,
                    'maxwidth' => '100%',
                    'maxheight' => '750px',

                ]
            ]
        );
      }
      ?>
    </div>
  </div>
</div>
