<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\teh\to\To */

$this->title = 'Обновить';
$this->params['breadcrumbs'][] = ['label' => 'ТО', 'url' => ['/teh/to/']];
$this->params['breadcrumbs'][] = ['label' => 'Перечень оборудования', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="to-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
