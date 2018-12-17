<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\teh\people\labor\PeopleLaborTitle */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вспомогательные', 'url' => ['/teh/admin/assist']];
$this->params['breadcrumbs'][] = ['label' => 'Трудовой статус', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="people-labor-title-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
