<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\teh\to\To */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
  .w3-label-under {
    font-size: 10px;
    padding-left: 5px;
  }

  .red {
    color: #FF0000;
  }
</style>


<div class="row">
  <div class="col-lg-8 col-md-12">
    <div class="to-form">

      <?php $form = ActiveForm::begin(['options' => ['id' => 'to-form']]); ?>

      <?= $form->field($model, 'eq_title')->textInput()->hint('Например: Рабочая станция HP dc7700', ['class' => ' w3-label-under']); ?>

      <div class="w3-row">
        <div class="w3-half">
          <div class="w3-col l11 m11">
              <?= $form->field($model, 'eq_id')->dropDownList($model->toolList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => '0', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
        <div class="w3-half">
          <div class="w3-col l11 m11  w3-right">
            <?= $form->field($model, 'order')->textInput()->hint('Например: 3', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
      </div>

      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
      </div>

      <?php ActiveForm::end(); ?>

    </div>
  </div>
</div>
