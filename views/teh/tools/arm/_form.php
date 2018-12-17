<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use \kartik\datecontrol\DateControl;
use \kartik\widgets\DatePicker;
use \kartik\widgets\FileInput;
use \yii\helpers\Url;
use yii\helpers\ArrayHelper;


$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Элемент " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("Элемент " + (index + 1))
    });
});
';

$this->registerJs($js);

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
      <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'dynamic-form' ]]); ?>
      <?= $form->field($modelComplex, 'category_id')->dropDownList($modelComplex->categoryList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
      <div class="row">
        <div class="col-sm-6">
          <?= $form->field($modelComplex, 'complex_title')->textInput()->hint('Например: PC1', ['class' => ' w3-label-under']); ?>
        </div>
        <div class="col-sm-6">
          <?= $form->field($modelComplex, 'parent_id')->dropDownList($modelComplex->pakList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <?= $form->field($modelComplex, 'user_id')->dropDownList($modelComplex->userList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
        </div>
        <div class="col-sm-6">
          <?= $form->field($modelComplex, 'soft_version')->textInput()->hint('Например: Windows XP SP3', ['class' => ' w3-label-under']); ?>
        </div>
      </div>

      <div class="padding-v-md">
        <div class="line line-dashed"></div>
      </div>

      <?php DynamicFormWidget::begin([
          'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
          'widgetBody' => '.container-items', // required: css class selector
          'widgetItem' => '.item', // required: css class
          'limit' => 6, // the maximum times, an element can be cloned (default 999)
          'min' => 0, // 0 or 1 (default 1)
          'insertButton' => '.add-item', // css class
          'deleteButton' => '.remove-item', // css class
          'model' => $modelsTool[0],
          'formId' => 'dynamic-form',
          'formFields' => [
              'category_id',
              'tool_title',
              'tool_manufact',
              'tool_model',
              'tool_serial',
              'factory_date',
              'place_id',
              'break',
              'imageFiles',
          ],
      ]); ?>

      <div class="panel panel-default">
        <div class="panel-heading">
          <i class="fa fa-random"></i>
          <button type="button" class="pull-right add-item btn btn-success btn-xs">Добавить</button>
          <div class="clearfix"></div>
        </div>

        <div class="panel-body container-items"><!-- widgetContainer -->

          <?php foreach ($modelsTool as $index => $modelTool): ?>
            <?php foreach ($fupload as $i => $file): ?>


              <div class="item panel panel-default"><!-- widgetBody -->
              <div class="panel-heading">
                <span class="panel-title-address"></span>
                <button type="button" class="pull-right remove-item btn btn-danger btn-xs">Удалить</button>
                <div class="clearfix"></div>
              </div>
              <div class="panel-body">
                <?php
                // necessary for update action.
                if (!$modelTool->isNewRecord) {
                  echo Html::activeHiddenInput($modelTool, "[{$index}]id");
                }
                ?>
                  <?= $form->field($modelTool, "[{$index}]category_id")->dropDownList($modelTool->categoryList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
                  <?= $form->field($modelTool, "[{$index}]tool_title")->textInput()->hint('Например: Коммутатор с автоопределителем', ['class' => ' w3-label-under']); ?>

                <div class="row">
                  <div class="col-sm-6">
                    <?= $form->field($modelTool, "[{$index}]tool_manufact")->textInput()->hint('Например: HP, ACER', ['class' => ' w3-label-under']); ?>
                  </div>
                  <div class="col-sm-6">
                    <?= $form->field($modelTool, "[{$index}]tool_model")->textInput()->hint('Например: LJ 1022', ['class' => ' w3-label-under']); ?>
                  </div>
                </div><!-- end:row -->
                <div class="row">
                  <div class="col-sm-6">
                    <?= $form->field($modelTool, "[{$index}]tool_serial")->textInput()->hint('Например: MTC3T32231', ['class' => ' w3-label-under']); ?>
                  </div>
                  <div class="col-sm-6">
                    <?= $form->field($modelTool, "[{$index}]factory_date")->textInput()->hint('Введите дату. Например 01.01.2003', ['class' => ' w3-label-under']); ?>
                  </div>
                </div><!-- end:row -->
                <?= $form->field($modelTool, "[{$index}]place_id")->dropDownList($modelTool->placeList, ['prompt' => ['text' => 'Выберите', 'options' => ['value' => 'none', 'disabled' => 'true', 'selected' => 'true']]])->hint('Выберите из списка', ['class' => ' w3-label-under']); ?>
                <p>
                  <?= $form->field($modelTool, "[{$index}]break")->checkbox([
                      'label' => 'Не работоспособно',
                      'labelOptions' => [
                          'style' => 'color:red;'
                      ]
                  ]); ?>
                </p>

                <?php
                if (!empty($modelTool->photos)) {
                  $allimages = null;
                  foreach ($modelTool->photos as $photo) {
                    $allimages[$index][] = "<img src='" . $photo->getImageUrl() . "' class='file-preview-image' style='max-width:100%;max-height:100%'>";
                    $previewImagesConfig[$index][] = [
                        'url' => Url::toRoute(ArrayHelper::merge(['/site/delete-image'], ['id' => $photo->id])),
                        'key' => $photo->id
                    ];
                  }
                } else {
                  $previewImagesConfig = false;
                  $allimages[$index] = false;
                }
                ?>

                <?= $form->field($file, "[{$index}]imageFiles[]")->widget(FileInput::class,[
                    'language' => 'ru',
                    'options' => ['multiple' => true],
                    'pluginOptions' => [
                      'previewFileType' => 'any',
                      'initialPreview' => $allimages[$index],
                      'initialPreviewConfig' => $previewImagesConfig[$index],
                      'overwriteInitial' => false,
                      'showUpload' => false,
                      'showRemove' => false,
                      'uploadUrl' => Url::to(['/site/file-upload/'])
                    ]
                  ]);
                ?>
              </div>
            </div>
              <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
      </div>
      <?php DynamicFormWidget::end(); ?>

      <div class="form-group">
        <?= Html::submitButton($modelTool->isNewRecord ? 'Добавить' : 'Обновить', ['class' => 'btn btn-primary']) ?>
      </div>

      <?php ActiveForm::end(); ?>

    </div>
  </div>
</div>