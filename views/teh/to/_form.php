<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\teh\to\To */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
  <div class="col-lg-8 col-md-12">
    <div class="to-form">

      <div class="alert alert-warning alert-dismissible show" role="alert" style="margin-bottom: 10px">
        <strong>Внимание!</strong> В первом поле формы перечислено оборудование специальной связи, для которого выполняется ТО.
        Для добавления оборудования в этот перечень, воспользуйтесь
        <strong>
          <?= Html::a('формой', '/teh/to/to-equipment/create', ['style' => ['border-bottom' => '1px dashed #9e6d3b']]);?>
        </strong>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php $form = ActiveForm::begin(); ?>

      <?= $form->field($model, 'to_equip_id')->dropDownList($model->toEquipmentList)->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>

      <div class="w3-row">
        <div class="w3-half">
          <div class="w3-col l11 m11" id="to_date">
            <?= $form->field($model, "to_type")->dropDownList($model->toList)->hint('Выберите из списка', ['class' => ' w3-label-under']);; ?>
          </div>
        </div>
        <div class="w3-half">
          <div class="w3-col l11 m11 w3-right">
            <?= $form->field($model, "plan_date")->widget(\kartik\widgets\DatePicker::class, [
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ])->hint('Выберите дату', ['class' => ' w3-label-under']); ?>
          </div>
        </div>

        <div class="form-group">
          <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

      </div>
    </div>
  </div>

