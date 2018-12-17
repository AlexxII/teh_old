<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\teh\to\To */

require "to_array.php";

$this->title = 'Добавить график TО';
$this->params['breadcrumbs'][] = ['label' => 'ТО', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'График ТО', 'url' => ['show-schedule']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="to-create">

  <?= $this->render('_form', [
      'tos' => $tos,
      'header' => 'Обновить график ТО на'
  ]) ?>



</div>
