<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
?>


<style>
  .w3-label-under {
    font-size: 10px;
    padding-left: 5px;
  }
  .red {
    color: #FF0000;
  }
</style>

<div class="w3-col l7 m8">

  <?php
  Modal::begin([
      'header' => '<h2>Hello world</h2>',
      'toggleButton' => [
          'label' => 'click me',
          'tag' => 'button',
          'class' => 'btn btn-success',
      ],
  ]);
  ?>

<?php Modal::end(); ?>