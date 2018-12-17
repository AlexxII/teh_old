<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\teh\ibp\Ibp */

$this->title = 'Добавить ИБП';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];

$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];
$this->params['breadcrumbs'][] = ['label' => 'ИБП', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ibp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelTool' => $modelTool,
        'modelIbp' => $modelIbp,
        'fupload' => $fupload
    ]) ?>

</div>
