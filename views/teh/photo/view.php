<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\teh\Photo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Изображения', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
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
                  'label' => 'Оборудование:',
                  'value' => $model->tool ? $model->tool->tool_title . " " . $model->eq_id : '-',
              ],
              [
                  'label' => 'Имя в БД:',
                  'value' => $model->photo_path,
              ],
          ],
      ]) ?>
    </div>

    <div class="w3-col m5 l5 container w3-center">
      <?php
        $ph[] = ['img' => $model->getImageUrlEx()];
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
      ?>
    </div>
  </div>
</div>
