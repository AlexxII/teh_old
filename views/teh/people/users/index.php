<?php

use yii\helpers\Html;

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вспомогательные', 'url' => ['/teh/admin/assist']];
$this->params['breadcrumbs'][] = $this->title;
?>

  <script>
      $(document).ready(function() {
          var table = $('#main-table').DataTable({
              "columnDefs": [
                  { "visible": false, "targets": 0 },
                  { "visible": false, "targets": 2 }
              ],
              order: [[1, 'asc']],
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
          table.on( 'order.dt search.dt', function () {
              table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                  cell.innerHTML = i+1;
              } );
          } ).draw();
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

/*var_dump($user);

return;*/



if (!empty($user)) {

  echo '
        <table id="main-table" class="display no-wrap cell-border" style="width:100%">
          <thead>
            <tr>
              <th data-priority="1">№ п.п.</th>
              <th data-priority="2">Пользователь</th>
              <th data-priority="5"></th>
              <th data-priority="4">Должность</th>
              <th data-priority="3"></th>
            </tr>
          </thead>
          <tbody>';
  foreach ($user as $u) {
    echo '
                  <tr>
                    <td></td>
                    <td>' . $u->name . '</td>
                    <td>' . $u->positions->parent . '</td>
                    <td>' . $u->positions->title . '</td>';
              echo '<td>';
                  echo Html::a('', ["update?id=" . $u['id'] ], ['class' => 'fa fa-pencil']);
                  echo Html::a('', ['delete', 'id' => $u->id], [
                      'class' => 'fa fa-trash',
                      'data' => [
                          'confirm' => 'Вы уверены, что хотите удалить объект?',
                          'method' => 'post',
                      ],
                  ]);

echo '</td>
                  </tr>';
  }
  echo '
          </tbody>
        </table>';
} else {
  echo 'Пусто';
}

?>