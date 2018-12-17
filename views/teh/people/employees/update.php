<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\teh\people\employees\Employees */

$this->title = 'Изменить';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вспомогательные', 'url' => ['/teh/admin/assist']];
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники Спецсвязи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
?>
<div class="employees-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
