<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Изображения';
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
    <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    <span id="edit-block" style="display:none">
+    </span>
    <p></p>
  </div>

<?php

if (!empty($photos)) {

  echo '
      <table id="main-table" class="display no-wrap cell-border" style="width:100%">
        <thead>
          <tr>
            <th id</th>
            <th data-priority="1">№ п.п.</th>
            <th data-priority="2" >Оборудование</th>
<!--
            <th data-priority="3">Производитель</th>
            <th data-priority="4">Модель</th>
-->
            <th data-priority="5" >Путь</th>
            <th data-priority="2">Action</th>
          </tr>
        </thead>
        <tbody>';
  $i = 1;
  foreach ($photos as $photo) {
    echo '
                <tr>
                  <td>' . $photo->id . '</td>
                  <td>' . $i . '</td>
                  <td>';
    echo(!empty($photo->tool) ? $photo->tool->tool_title . " - id_" . $photo->eq_id : '-');
            echo '</td>
                  <td>' . $photo['photo_path'] . '</td>';
          echo '<td>';
          echo Html::a('', ["view?id=" . $photo->id], ['class' => 'fa fa-eye']);
          echo Html::a('', ["update?id=" . $photo['id']], ['class' => 'fa fa-pencil']);
          echo Html::a('', ["delete?id=" . $photo['id']], ['class' => 'fa fa-trash']);
          echo '</td>
                </tr>';
    $i++;
  }
  echo '
        </tbody>
      </table>';
}

?>