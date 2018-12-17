<?php

use yii\helpers\Html;
include "data_array.php";

$this->title = 'Оборудование';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

  foreach ($eq_clas as $eq) {
  echo '
      <div class="w3-col m6 l4" style="margin-bottom:35px">
        <div class="w3-row-padding">
          <div class="w3-container">
            <div class="w3-card-4">
              <a style="display:block" href="' . $eq["index"] . '" title="Таблица">
                <header class="w3-container w3-center">
                  <h3>' . $eq["name"] . '</h3>
                </header>
                <div class="w3-container w3-center">
                  <i class="fa ' . $eq["icon"] . '" aria-hidden="true" style="font-size:30px"></i>
                  <p style="font-size:12px">' . $eq["about"] . '</p>
                </div>
              </a>
              <a class="w3-button w3-block w3-teal" ' . Html::a("Добавить", [$eq["url"]]) . '</a>
            </div>
          </div>
        </div>
      </div>';
};

