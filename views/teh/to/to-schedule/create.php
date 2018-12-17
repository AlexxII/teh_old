<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\teh\to\To */

require "to_array.php";

$this->title = 'Добавить график TО';
$this->params['breadcrumbs'][] = ['label' => 'ТО', 'url' => ['/teh/to/']];
$this->params['breadcrumbs'][] = ['label' => 'Графики ТО', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="to-create">

  <?= $this->render('_form', [
      'tos' => $tos,
      'header' => 'Составление графика ТО на'
  ]) ?>

</div>
