<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\teh\battery\Battery */

$this->title = 'Изменить АКБ';
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];

$this->params['breadcrumbs'][] = ['label' => 'АКБ и элементы питания', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="battery-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelTool' => $modelTool,
        'modelBattery' => $model,
        'fupload' => $fupload
    ]) ?>

</div>
