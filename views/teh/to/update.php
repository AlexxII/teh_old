<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\teh\to\To */

$this->title = 'Обновить';
$this->params['breadcrumbs'][] = ['label' => 'ТО', 'url' => ['/teh/to/index']];
$this->params['breadcrumbs'][] = ['label' => 'Графики ТО', 'url' => ['/teh/to/to-schedule/index']];
$this->params['breadcrumbs'][] = ['label' => 'Назад', 'url' => ['/teh/to/to-schedule/view','id' => $model->scheld_id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="to-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
