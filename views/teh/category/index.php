<?php

use yii\helpers\Html;

$this->title = 'Категории оборудования';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вспомогательные', 'url' => ['/teh/admin/assist']];
$this->params['breadcrumbs'][] = $this->title;
?>

  <script>
      $(document).ready(function() {
          var table = $('#main-table').DataTable({
              "columnDefs": [
                  { "visible": false, "targets": 4 },
                  { "visible": false, "targets": 0 }
              ],
              orderFixed: [[4, 'asc'], [5, 'asc']],
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
    <?= Html::a('Изменить порядок', ['category-order'], ['class' => 'btn btn-success btn-sm']) ?>
    <span id="edit-block" style="display:none">
    </span>
    <p></p>
  </div>

<?php

if (!empty($category)) {

  echo '
        <table id="main-table" class="display no-wrap cell-border" style="width:100%">
          <thead>
            <tr>
              <th data-priority="1">ID</th>
              <th data-priority="2">Категория</th>
              <th >Родитель</th>
              <th >Порядок отображения</th>
              <th ></th>
              <th ></th>
            </tr>
          </thead>
          <tbody>';
  $i = 1;
  foreach ($category as $c) {
    echo '
                  <tr>
                    <td>'. $c['id'] .'</td>
                    <td>' . $c['cat_title'] . '</td>
                    <td>' . $c['parent'] . '</td>
                    <td>' . $c['custom_order'] . '</td>
                    <td>' . $c['scategory_order'] . '</td>
                    <td>';
    echo Html::a('', ["update?id=" . $c['id'] ], ['class' => 'fa fa-pencil']);
    echo Html::a('', ["delete?id=" . $c['id'] ], ['class' => 'fa fa-trash']);
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