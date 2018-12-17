<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

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
  <div class="col-lg-5 col-md-12">
    <div class="customer-form">
      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'ibp-form']]); ?>
      <div class="w3-row">
        <div class="w3-third">
          <div class="w3-col l11 m11">
            <?= $form->field($modelTool, 'tool_manufact')->textInput()->hint('Например: APC', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
        <div class="w3-twothird">
          <div class="w3-col l11 m11 w3-right">
            <?= $form->field($modelTool, 'tool_model')->textInput()->hint('Например: Smart-UPS 700', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
      </div>
      <p>
        <?= $form->field($modelTool, 'tool_serial')->textInput()->hint('Например: MTC3T32231', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
        <?= $form->field($modelTool, 'parent_id')->dropDownList($modelTool->parentList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => '0', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
        <?= $form->field($modelTool, 'pak_id')->dropDownList($modelTool->pakList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => '0', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
      <div class="w3-row">
        <div class="w3-half">
          <div class="w3-col l11 m11" id="to_date">
            <?= $form->field($modelTool, 'factory_date')->textInput()->hint('Выберите дату', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
        <div class="w3-half">
          <div class="w3-col l11 m11 w3-right">
            <?= $form->field($modelTool, 'place_id')->dropDownList($modelTool->placeList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
      </div>
      <p>
      <div class="w3-row">
        <div class="w3-half">
          <div class="w3-col l11 m11 ">
            <?= $form->field($modelIbp, 'bat_id')->dropDownList($modelIbp->batteryList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
        <div class="w3-half">
          <div class="w3-col l11 m11 w3-right">
            <?= $form->field($modelIbp, 'num_of_bat')->textInput()->hint('Например: 2 или 2.45', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
      </div>
      <p>
      <div class="w3-row">
        <div class="w3-half">
          <div class="w3-col l11 m11">
            <?= $form->field($modelIbp, 'num_of_use')->textInput()->hint('Например: 2 или 2.45', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
      </div>

      <div class="w3-row">
        <div class="w3-half">
          <div class="w3-col l11 m11" id="to_date">
            <?= $form->field($modelTool, 'break')->checkbox([
                'label' => 'Не работоспособно',
                'labelOptions' => [
                    'style' => 'color:red;'
                ]
            ]); ?>
          </div>
        </div>
        <div class="w3-half">
          <div class="w3-col l11 m11 w3-right">
            <?= $form->field($modelIbp, 'bat_in')->checkbox([
                'label' => 'АКБ внутри',
                'labelOptions' => [
                    'style' => 'color:red;'
                ]
            ]); ?>
          </div>
        </div>
      </div>
      <?php
      if (!empty($modelTool->photos)) {
        foreach ($modelTool->photos as $k => $photo) {
          $allimages[] = "<img src='" . $photo->getImageUrl() . "' class='file-preview-image' style='max-width:100%;max-height:100%'>";
          $previewImagesConfig[] = [
              'url' => Url::toRoute(ArrayHelper::merge(['/site/delete-image'], ['id' => $photo->id])),
              'key' => $photo->id
          ];
        }
      } else {
        $previewImagesConfig = false;
        $allimages = false;
      }
      ?>

      <?= $form->field($fupload, "imageFiles[]")->widget(FileInput::class, [
          'language' => 'ru',
          'options' => ['multiple' => true],
          'pluginOptions' => [
              'previewFileType' => 'any',
              'initialPreview' => $allimages,
              'initialPreviewConfig' => $previewImagesConfig,
              'overwriteInitial' => false,
              'showUpload' => false,
              'showRemove' => false,
              'uploadUrl' => Url::to(['/site/file-upload/'])
          ],
      ]); ?>
      <div class="form-group">
        <?= Html::submitButton($modelIbp->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>

