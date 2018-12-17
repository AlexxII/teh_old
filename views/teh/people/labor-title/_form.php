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
      <p>
        <?= $form->field($model, 'title')->textInput(
            [
                'class' => 'labor-date form-control',
            ])->hint('Например: Дежурство по отделению', ['class' => ' w3-label-under']) ?>
      </p>
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>

  </div>
</div>

