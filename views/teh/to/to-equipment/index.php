<?php

use yii\helpers\Html;

$this->title = 'Перечень оборудования';
$this->params['breadcrumbs'][] = ['label' => 'ТО', 'url' => ['/teh/to/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<script>
    $(document).ready(function () {
        var table = $('#main-table').DataTable({
            "columnDefs": [
                {"visible": false, "targets": 0},
                {"visible": false, "targets": 4},
            ],
            orderFixed: [[4, 'desc'], [6, 'asc']],
            rowGroup: {
                dataSrc: 4
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
            table.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
    });

</script>

<div class="w3-col l8 m7">
  <h1><?= Html::encode($this->title) ?></h1>

  <div class="alert alert-info alert-dismissible show" role="alert" style="margin-bottom: 10px">
    В таблице перечислено оборудование специальной связи, которое включено в график ТО.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

  <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
  <?= Html::a('Изменить порядок отображения', ['order'], ['class' => 'btn btn-success btn-sm']) ?>
  <span id="edit-block" style="display:none">
    </span>
  <p></p>
</div>

<?php

if (!empty($tos)) {

  echo '
        <table id="main-table" class="display no-wrap cell-border" style="width:100%">
          <thead>
            <tr>
              <th >id</th>
              <th data-priority="1">№ п.п.</th>
              <th data-priority="3">Наименование в графике</th>
              <th data-priority="4">Оборудование</th>
              <th >ПАК</th>
              <th >Состав</th>
              <th >Порядок отоб-ния</th>
              <th data-priority="2">Action</th>
            </tr>
          </thead>
          <tbody>';
  $j = 1;
  foreach ($tos as $to) {

            echo '
                  <tr>
                    <td>' . $to->id . '</td>
                    <td>' . $j . '</td>
                    <td>' . $to->eq_title . '</td>';
              echo '<td>';
              if (!empty($to->tool)) {
                echo $to->tool->fullTitle;
              } else {
                echo '<span style="color:#CC0000">Вероятно оборудование удалено</span>';
              };
              echo '</td>';
              echo '<td>';
                        if (!empty($to->tool)) {
                          echo $to->tool->pak->pak_title;
                        } else {
                          echo '<span style="color:#CC0000">Вероятно оборудование удалено</span>';
                        };
              echo '</td>
                    <td>' . 'Добавить состав, если есть' . '</td>
                    <td>' . $to->order . '</td>';
              echo '<td>';
                        echo Html::a('', ["view?id=" . $to->id], ['class' => 'fa fa-eye']);
                        echo Html::a('', ["update?id=" . $to->id], ['class' => 'fa fa-pencil']);
                        echo Html::a('', ['delete', 'id' => $to->id], [
                            'class' => 'fa fa-trash',
                            'data' => [
                                'confirm' => 'Вы уверены, что хотите удалить объект?',
                                'method' => 'post',
                            ],
                        ]);
              echo '</td>
                  </tr>';
    $j++;
  }
  echo '
          </tbody>
        </table>';
} else {
  echo 'Таблица базы данных с записями о ТО пуста';
}


?>


<script>
</script>