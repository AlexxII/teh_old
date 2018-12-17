<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Оборудование';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];
$this->params['breadcrumbs'][] = $this->title;
?>

  <script>
      $(document).ready(function () {
          $('#main-table').DataTable({
              "columnDefs": [
                  {"visible": false, "targets": 0},
//                  { "visible": false, "targets": 8 }
              ],
//              orderFixed: [[8, 'desc']],
              select: false,
//              rowGroup: {
//                  dataSrc: 8
//              },
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
    <span> </span>
    <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    <span id="edit-block" style="display:none">
+    </span>
    <p></p>
  </div>

<?php

if (!empty($tool)) {

  echo '
      <table id="main-table" class="display no-wrap cell-border" style="width:100%">
        <thead>
          <tr>
            <th id</th>
            <th data-priority="1">№ п.п.</th>
            <th >Наименование</th>
            <th data-priority="2" >Категория</th>
            <th data-priority="3">Производитель</th>
            <th data-priority="4">Модель</th>
            <th data-priority="5" >Входит в состав</th>
            <th >s/n</th>
            <th >Дата производства</th>
            <th data-priority="6" >Место размещения</th>
            <th >Исправность</th>
            <th >Фото</th>
            <th data-priority="2">Action</th>
          </tr>
        </thead>
        <tbody>';
  $i = 1;
  foreach ($tool as $t) {
    echo '
                <tr>
                  <td>' . $t->id . '</td>
                  <td>' . $i . '</td>
                  <td>' . $t['tool_title'] . '</td>
                  <td>' . $t->category->cat_title . '</td>
                  <td>' . $t['tool_manufact'] . '</td>
                  <td>' . $t['fullModelTitle'] . '</td>
                  <td>';
            echo(!empty($t->complex) ? $t->complex->complex_title : '-');
            echo '</td>
                  <td>' . $t['tool_serial'] . '</td>
                  <td>' . $t['factory_date'] . '</td>
                  <td>';
            echo(!empty($t->place) ? $t->place->place_title : '-');
            echo '</td>
                  <td>';
    if ($t['break'] == 0) {
      echo 'Исправен';
    } else {
      echo 'Неисправен';
    }
    echo '</td>
          <td>';
    echo(!empty($t->photos) ? count($t->photos) : '-');
    echo '</td>
          <td>';
    echo Html::a('', ["view?id=" . $t->id], ['class' => 'fa fa-eye']);
    echo Html::a('', ["update?id=" . $t['id']], ['class' => 'fa fa-pencil']);
    echo Html::a('', ["delete?id=" . $t['id']], ['class' => 'fa fa-trash']);
    echo '</td>
                </tr>';
    $i++;
  }
  echo '
        </tbody>
      </table>';
}

?>