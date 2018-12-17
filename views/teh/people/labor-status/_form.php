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
      <div class="w3-row">
        <div class="w3-half">
          <div class="w3-col l11 m11" id="to_date">
            <?= $form->field($model, 'people_id')->dropDownList($model->usersList, [
                'prompt' => [
                    'text' => 'Выберите',
                    'options' => [
                        'value' => 'none',
                        'disabled' => 'true',
                        'selected' => 'true'
                    ]
                ]
            ])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
        <div class="w3-half">
          <div class="w3-col l11 m11 w3-right">
            <?= $form->field($model, 'free_date')->textInput(
                [
                    'class' => 'labor-date form-control',
                ])->hint('Выберите несколько дат', ['class' => ' w3-label-under']) ?>
          </div>
        </div>
      </div>
      <p>
        <?= $form->field($model, 'labor_title')->dropDownList($model->laborList, [
            'prompt' => [
                'text' => 'Выберите',
                'options' => [
                    'value' => 'none',
                    'disabled' => 'true',
                    'selected' => 'true'
                ]
            ]
        ])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
        <?= $form->field($model, 'comment')->textarea()->hint('Например: Часть основного отпуска', ['class' => ' w3-label-under']); ?>
      </p>

      </p>
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
      </div>
    </div>
    <?php ActiveForm::end(); ?>

  </div>
</div>

<script>
    $(document).ready(function () {
        $('.labor-date').datepicker({
            format: 'dd.mm.yyyy',
            language: "ru",
            forceParse: false,
            clearBtn: true,
            dateRange: true,
            multidate: true
        });
    });

    $(document).ready(function() {
        $('.input-daterange').datepicker({
            format: 'dd.mm.yyyy г.',
            language: "ru",
            clearBtn: true
        });
    })
</script>

