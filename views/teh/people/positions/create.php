<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\teh\people\positions\Positions */

$this->title = 'Добавить должность';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вспомогательные', 'url' => ['/teh/admin/assist']];
$this->params['breadcrumbs'][] = ['label' => 'Список должностей', 'url' => ['index']];

?>
<div class="positions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
