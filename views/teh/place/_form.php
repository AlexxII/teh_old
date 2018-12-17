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
  <div class="col-lg-8 col-md-6">
    <div class="customer-form">

      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'place-form']]); ?>
      <p>
        <?= $form->field($model, 'place_title')->textInput()->hint('Например: ПМО ул.Ленина,75 п.403', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
        <?= $form->field($model, 'comment')->textarea()->hint('Например: Студия Губернатора МО', ['class' => ' w3-label-under']); ?>
      </p>
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
      </div>
      <?php ActiveForm::end(); ?>

    </div>
  </div>
</div>

