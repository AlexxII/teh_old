<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\teh\people\users\User */

$this->title = 'Добавить пользователя';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вспомогательные', 'url' => ['/teh/admin/assist']];
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
