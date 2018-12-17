<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\teh\Photo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
  <div class="col-lg-8 col-md-12">

    <?php $form = ActiveForm::begin(['id' => 'photo-form']); ?>

    <?= $form->field($model, 'eq_id')->dropDownList($model->toolList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => '0', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>

    <?php
    if (!$model->isNewRecord) {
        $image = "<img src='" . $model->getImageUrl() . "' class='file-preview-image' style='max-width:100%;max-height:100%'>";
        $previewImagesConfig[] = [
            'url' => Url::toRoute(ArrayHelper::merge(['/site/delete-image'], ['id' => $model->id])),
            'key' => $model->id
        ];
    } else {
      $previewImagesConfig = false;
      $image = false;
    }
    ?>

    <?= $form->field($model, "imageFiles")->widget(FileInput::class, [
        'language' => 'ru',
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'previewFileType' => 'any',
            'initialPreview' => $image,
            'initialPreviewConfig' => $previewImagesConfig,
            'overwriteInitial' => true,
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
