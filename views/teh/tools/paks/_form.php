<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<style>
  .w3-label-under {
    font-size: 10px;
    padding-left: 5px;
  }
</style>


  <?php if (Yii::$app->session->hasFlash('seccess')): ?>
    <div class="alert alert-success">
      <strong>Прекрасно!</strong> ПАК добавлен.
    </div>
  <?php endif; ?>


  <?php if (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-warning">
      <strong>Ошибка!</strong> ПАК не добавлен.
    </div>
  <?php endif; ?>

<div class="row">
  <div class="col-lg-5 col-md-6">


    <div class="customer-form">


      <?php $form = ActiveForm::begin(['options' => ['class' => '']]); ?>
      <p>
        <?= $form->field($model, 'pak_title')->textInput()->hint('Например: ТИАЦ-ОМ', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
        <?= $form->field($model, 'pak_admin')->dropDownList($model->adminList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите ответственного', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
        <?= $form->field($model, 'pak_ext')->textInput()->hint('Например: ПАКи', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
      </div>
      </p>
      <?php ActiveForm::end(); ?>

    </div>
  </div>
</div>
