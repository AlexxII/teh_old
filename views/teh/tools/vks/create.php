<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\teh\tool\Tool */

$this->title = 'Добавить ВКС';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];
$this->params['breadcrumbs'][] = ['label' => 'Комплексы ВКС', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tool-create">


    <?= $this->render('_form', [
        'modelComplex' => $modelComplex,
        'modelsTool' => $modelsTool,
        'fupload' => $fUpload,
    ]) ?>

</div>
