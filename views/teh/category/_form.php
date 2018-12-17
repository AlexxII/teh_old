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


      <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success">
          <strong>Прекрасно!</strong>
          <?php echo Yii::$app->session->getFlash('success'); ?>
        </div>
      <?php endif; ?>


      <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-warning">
          <strong>Ошибка!</strong>
          <?php echo Yii::$app->session->getFlash('error'); ?>
        </div>
      <?php endif; ?>



      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'category-form']]); ?>
      <p>
        <?= $form->field($model, 'cat_title')->textInput()->hint('Например: Удлинители', ['class' => ' w3-label-under']); ?>
      </p>
      <div class="w3-row">
        <div class="w3-half">
          <div class="w3-col l11 m11" id="to_date">
            <?= $form->field($model, 'parent')->dropDownList($model->parentList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
        <div class="w3-half">
          <div class="w3-col l11 m11 w3-right">
            <?= $form->field($model, 'custom_order')->textInput()->hint('Например: 3 или 5', ['class' => ' w3-label-under']); ?>
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


