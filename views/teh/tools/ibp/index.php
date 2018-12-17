<?php

use yii\helpers\Html;

$this->title = 'ИБП';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];
$this->params['breadcrumbs'][] = $this->title;
?>

  <script>
      $(document).ready(function() {
          $('#main-table').DataTable({
              "columnDefs": [
                  { "visible": false, "targets": 0 },
                  { "visible": false, "targets": 2 }
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

if (!empty($ibp)) {

  echo '
        <table id="main-table" class="display no-wrap cell-border" style="width:100%">
          <thead>
            <tr>
              <th >id</th>
              <th data-priority="1">№ п.п.</th>
              <th data-priority="3">Производитель</th>
              <th data-priority="4">Модель</th>
              <th >s/n</th>
              <th data-priority="5" >Вxодит в состав</th>
              <th >Дата производства</th>
              <th data-priority="7" >Место расположения</th>
              <th data-priority="8" >Кол-во батарей</th>
              <th data-priority="9" >Тип батарей</th>
              <th >Кол-во потребит.</th>
              <th >Батареи внутри</th>
              <th >Исправность</th>
              <th >Фото</th>
              <th data-priority="2">Action</th>
            </tr>
          </thead>
          <tbody>';
  $j = 1;
  foreach ($ibp as $i) {

            echo '
                  <tr>
                    <td>' . $i->id .'</td>
                    <td>' . $j . '</td>
                    <td>' . $i->tool->tool_manufact . '</td>
                    <td>' . $i->tool->tool_model . '</td>
                    <td>' . $i->tool->tool_serial . '</td>
                    <td>' . $i->tool->parent_id . '</td>
                    <td>' . $i->tool->factory_date . '</td>
                    <td>' . $i->tool->place->place_title . '</td>
                    <td>' . $i['num_of_bat'] . '</td>
                    <td>';
                    if (!empty($i->battery)) {
                      echo $i->battery->bat_type;
                    } else {
                      echo "-";
                    };
                    echo '</td>
                    <td>' . $i['num_of_use'] . '</td>
                    <td>';
                        if ($i['bat_in'] == 1) {
                          echo 'Да';
                        } else {
                          echo 'Нет';
                        }
              echo '</td>';
              echo '<td>';
                        if ($i->tool->break == 0) {
                          echo 'Исправен';
                        } else {
                          echo 'Неисправен';
                        }
              echo '</td>
                    <td>';
              echo(!empty($i->tool->photos) ? count($i->tool->photos) : '-');
              echo '</td>
                    <td>';
    echo Html::a('', ["view?id=" . $i->id], ['class' => 'fa fa-eye']);
    echo Html::a('', ["update?id=" . $i['id'] ], ['class' => 'fa fa-pencil']);
    echo Html::a('', ["delete?id=" . $i['id'] ], ['class' => 'fa fa-trash']);
              echo '</td>
                  </tr>';
    $j++;
  }
  echo '
          </tbody>
        </table>';
} else {
  echo 'Таблица базы данных с записями об ИБП пуста';
}

?>