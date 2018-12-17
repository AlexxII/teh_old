<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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
  <div class="col-lg-5 col-md-6">
    <div class="customer-form">

      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'user-form']]); ?>
      <p>
        <?= $form->field($model, 'name')->textInput()->hint('Например: Сидоров Х.Д.', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
        <?= $form->field($model, 'position')->dropDownList($model->positionsList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
      <div class="w3-row">
        <div class="w3-half">
          <div class="w3-col l11 m11" id="to_date">
          </div>
        </div>
        <div class="w3-half">
          <div class="w3-col l11 m11 w3-right">
          </div>
        </div>
      </div>
      </p>

      <div class="form-group">
        <div class="group" style="float:left; padding-right: 20px">
          <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php if ($model->isNewRecord) : ?>
          <div class="form-check" style="padding-top: 8px">
            <input type="checkbox" class="form-check-input" id="check" name="ch-stay"
              <?php
                if (Yii::$app->request->cookies['ch-stay'] == '1') {
                  echo 'checked';
                }
              ?>
            >
            <label class="form-check-label" for="check"> Остаться в форме</label>
          </div>
          <br>
        <?php endif; ?>

      </div>

      <?php ActiveForm::end(); ?>

    </div>
  </div>
</div>

