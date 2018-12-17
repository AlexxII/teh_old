<?php

use yii\helpers\Html;

$this->title = 'АКБ и элементы питания';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];

$this->params['breadcrumbs'][] = $this->title;
?>

  <script>
      $(document).ready(function () {
          $('#main-table').DataTable({
              "columnDefs": [
                  {"visible": false, "targets": 0},
                  {"visible": false, "targets": 2}
              ],
              orderFixed: [[2, 'desc']],
              rowGroup: {
                  dataSrc: 2
              },
              select: false,
              responsive: true,
              fixedHeader: {
                  header: true,
                  headerOffset: $('#topnav').height()
              },
              language: {
                  url : "/lib/ru.json"
              }
          });
      });

  </script>

  <div class="w3-col l8 m7">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    <span id="edit-block" style="display:none">
    </span>
    <p></p>
  </div>

<?php


if (!empty($battery)) {

  echo '
        <table id="main-table" class="display no-wrap cell-border" style="width:100%">
          <thead>
            <tr>
              <th >id</th>
              <th data-priority="1">№ п.п.</th>
              <th data-priority="3">Производитель</th>
              <th >s/n</th>
              <th >Дата производства</th>
              <th data-priority="5" >U и А</th>
              <th data-priority="6" >Габариты</th>
              <th >Место расположения</th>
              <th >Фото</th>
              <th >Action</th>
            </tr>
          </thead>
          <tbody>';
  $i = 1;
  foreach ($battery as $b) {
    echo '
                  <tr>
                    <td>' . $b->id . '</td>
                    <td>' . $i . '</td>
                    <td>' . $b->tool->tool_manufact . '</td>
                    <td>' . $b->tool->tool_serial . '</td>
                    <td>' . $b->tool->factory_date . '</td>
                    <td>' . $b->bat_type . '</td>
                    <td>' . $b->bat_size . '</td>';
              echo '<td>';
              echo(!empty($b->tool->place) ? $b->tool->place->place_title : '-');
              echo '</td>';
              echo '<td>';
              echo(!empty($b->photos) ? count($b->photos) : '-');
              echo '</td>
                    <td>';
    echo Html::a('', ["view?id=" . $b['id']], ['class' => 'fa fa-eye']);
    echo Html::a('', ["update?id=" . $b['id']], ['class' => 'fa fa-pencil']);
    echo Html::a('', ["delete?id=" . $b['id']], ['class' => 'fa fa-trash']);
    echo '</td>
                  </tr>';
    $i++;
  }
  echo '
          </tbody>
        </table>';
} else {
  echo 'Пусто';
}

?>