<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\teh\battery\Battery */

$this->title = 'Добавить АКБ или элемент питания';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];

$this->params['breadcrumbs'][] = ['label' => 'АКБ и элементы питания', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="battery-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelTool' => $modelTool,
        'modelBattery' => $modelBattery,
        'fupload' => $fupload
    ]) ?>

</div>
