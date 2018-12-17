<?php

use yii\helpers\Html;

$this->title = 'ПАК';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];
$this->params['breadcrumbs'][] = $this->title;
?>

  <script>
      $(document).ready(function() {
          $('#main-table').DataTable({
              "columnDefs": [
                  { "visible": false, "targets": 0 },
//                  { "visible": false, "targets": 2 }
              ],
              orderFixed: [[0, 'asc']],
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

if (!empty($pak)) {

  echo '
        <table id="main-table" class="display no-wrap cell-border" style="width:100%">
          <thead>
            <tr>
              <th >id</th>
              <th data-priority="1">№ п.п.</th>
              <th data-priority="3">ПАК</th>
              <th data-priority="4">Ответственный</th>
              <th >Расширение</th>
              <th data-priority="2">Action</th>
            </tr>
          </thead>
          <tbody>';
  $i = 1;
  foreach ($pak as $p) {
    echo '
                  <tr>
                    <td>'. $p['id'] .'</td>
                    <td>' . $i . '</td>
                    <td>' . $p['pak_title'] . '</td>';
              echo '<td>';
              if (!empty($p->admin)) {
                echo $p->admin->name;
              } else {
                echo "-";
              };
              echo '</td>
                    <td>' . $p['pak_ext'] . '</td>';
              echo '<td>';
                echo Html::a('', ["view?id=" . $p['id'] ], ['class' => 'fa fa-eye']);
                echo Html::a('', ["update?id=" . $p['id'] ], ['class' => 'fa fa-pencil']);
                echo Html::a('', ["delete?id=" . $p['id'] ], ['class' => 'fa fa-trash']);
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