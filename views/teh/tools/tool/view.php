<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use metalguardian\fotorama\Fotorama;

/* @var $this yii\web\View */
/* @var $model app\models\teh\tool\Tool */

$this->title = $model->tool_title;
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tool-view">

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
                  'value' => $model->category ? $model->category->cat_title : '-',
              ],
                'tool_title',
              'tool_manufact',
              'tool_model',
              'tool_serial',
              [
                  'label' => 'ПАК:',
                  'value' => $model->pak ? $model->pak->pak_title : '-',
              ],
              [
                  'label' => 'Входит в состав:',
                  'value' => $model->complex ? $model->complex->complex_title : '-',
              ],
              [
                  'label' => 'Изображения:',
                  'format' => 'raw',
                  'value' => $model->photos ? '<a href="#" style="color: #3f51b5">' . count($model->photos) . ' штук(и)' . '</a>' : 'отсутствуют',
              ]
          ],
      ]) ?>
    </div>

    <div class="w3-col m5 l5 container w3-center">
      <?php

        if ($photos = $model->photos) {
          foreach ($photos as $photo) {
            $ph[] = ['img' => $photo->getImageUrl()];
          }
          echo Fotorama::widget(
              [
                  'items' => $ph,
                  'options' => [
                      'nav' => 'thumbs',
                      'loop' => true,
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
