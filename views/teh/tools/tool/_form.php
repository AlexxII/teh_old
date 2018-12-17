<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

?>

<style>
</style>

<div class="row">
  <div class="col-lg-5 col-md-6">
    <div class="customer-form">

      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => '']]); ?>
      <p>
        <?= $form->field($model, 'category_id')->dropDownList($model->categoryList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
        <?= $form->field($model, 'tool_title')->textInput()->hint('Например: Коммутатор с автоопределителем', ['class' => ' w3-label-under']); ?>
      </p>
      <div class="w3-row">
        <div class="w3-third">
          <div class="w3-col l11 m11">
            <?= $form->field($model, 'tool_manufact')->textInput()->hint('Например: HP, ACER', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
        <div class="w3-twothird">
          <div class="w3-col l11 m11 w3-right">
            <?= $form->field($model, 'tool_model')->textInput()->hint('Например: LJ 1022', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
      </div>
      <p>
        <?= $form->field($model, 'tool_serial')->textInput()->hint('Например: MTC3T32231', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
        <?= $form->field($model, 'parent_id')->dropDownList($model->parentList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => '0', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
        <?= $form->field($model, 'pak_id')->dropDownList($model->pakList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => '0', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
      </p>
      <p>
      <div class="w3-row">
        <div class="w3-half">
          <div class="w3-col l11 m11" id="to_date">
            <?= $form->field($model, 'factory_date')->textInput()->hint('Выберите дату', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
        <div class="w3-half">
          <div class="w3-col l11 m11 w3-right">
            <?= $form->field($model, 'operation_time')->textInput()->hint('Например: 2 или 2.45', ['class' => ' w3-label-under']); ?>
          </div>
        </div>
      </div>
      <p>
        <?= $form->field($model, 'place_id')->dropDownList($model->placeList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
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
      <p>
        <?= $form->field($model, 'break')->checkbox([
            'label' => 'Не работоспособно',
            'labelOptions' => [
                'style' => 'color:red;'
            ]
        ]); ?>
      </p>

      <?php
      if (!empty($model->photos)) {
        foreach ($model->photos as $k => $photo) {
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
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
      </div>
      <?php ActiveForm::end(); ?>

    </div>
  </div>
</div>

