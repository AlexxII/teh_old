<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\teh\tool\Tool */

$this->title = 'Добавить оборудование';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];
$this->params['breadcrumbs'][] = ['label' => 'Основное оборудование', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tool-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'fupload' => $fupload
    ]) ?>

</div>
