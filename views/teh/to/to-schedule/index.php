<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Графики ТО';
$this->params['breadcrumbs'][] = ['label' => 'ТО', 'url' => ['/teh/to/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="to-schedule-archive">

    <h1><?= Html::encode($this->title) ?></h1>

</div>

<?php

require 'to_array.php'; ?>

<style>
  td {
    text-align: center;
  }
</style>


<script>
    $(document).ready(function () {
        var table = $('#main-table').DataTable({
            "columnDefs": [
                {"visible": false, "targets": 3},
                {"visible": false, "targets": 4}
            ],
            orderFixed: [[3, 'desc']],
            order: [[1, 'asc']],
            rowGroup: {
                dataSrc: 3
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



<div class="row">
  <div class="w3-col l8">
    <div class="container-fluid" style="margin-bottom: 20px">
      <?= Html::a('Новый график', ['create'], ['class' => 'btn btn-success btn-sm', 'style' => ['margin-top' => '5px']]) ?>
    </div>
  </div>

  <div class="w3-row">
    <div class="w3-twothird" style="padding-top: 10px">
      <div class="w3-col l8 m7" id="edit-block" style="display:none">
        <button type="button" id="table-editor" class="btn btn-primary btn-sm">Редактировать</button>
        <button type="button" id="table-del" class="btn btn-danger btn-sm">Удалить</button>
        <P></P>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <?php

    echo '
        <table id="main-table" class="display no-wrap cell-border" style="width:100%">
          <thead>
            <tr>
              <th data-priority="1">№ п.п.</th>
              <th data-priority="1">Месяц</th>
              <th data-priority="7">Отметки</th>
              <th >Год</th>
              <th >Год</th>
              <th >Объем ТО</th>
              <th >Ответственный за проведение</th>
              <th >Ответственный за контроль</th>
              <th data-priority="2">DO_it</th>
              <th data-priority="3">Action</th>
            </tr>
          </thead>
          <tbody>';

    if ($tos) {
      foreach ($tos as $to) {

        echo '
                  <tr>
                    <td></td>
                    <td>' . strftime("%B", strtotime($to['plan_date'])) . '</td>
                    <td>';
        if (strlen($to['checkmark']) == 1) {
          if ($to['checkmark'] == 1) {
            echo '<span style="color:#4CAF50"><strong>ТО проведено</strong></span>';
          } else {
            if (date('Y-m-d') < $to['plan_date']) {
              echo '<span style="color:#4349cc"><strong>ТО не проведено</strong></span>';
            } else {
              echo '<span style="color:#CC0000"><strong>ТО не проведено</strong></span>';
            }
          }
        } else {
          echo '<span style="color:#4349cc"><strong>Проведено не полностью</strong></span>';
        }
        echo '</td>';
        echo '<td>' . strftime("%G", strtotime($to['plan_date'])) . ' год' .  '</td>';
        echo '<td>' . strftime("%G", strtotime($to['plan_date'])) . ' год' .  '</td>';
        echo '<td>'; // отображение видов ТО
            $ar = explode(',', $to['to_type']);
                foreach ($ar as $a) {
                  echo $to_kind[intval($a)];
                  echo '<br>';
                }
        echo '</td>';
        echo '<td>' . $to['admins'].'</td>';
        echo '<td>' . $to['auditors'] .  '</td>';
        echo '<td style="text-align: center">';
        echo Html::a('', ["perform?id=" . $to['scheld_id']], [
                'class' => 'fa fa-check-square-o',
                'title' => 'Отметить выполнение графика',
                'data-toggle' => 'tooltip',
                'data-placement' => 'top'
        ]);
        echo '</td>';
        echo '<td style="text-align: center">';
        echo Html::a('', ["view?id=" . $to['scheld_id']], [
                'class' => 'fa fa-eye',
                'title' => 'Просмотр',
                'data-toggle' => 'tooltip',
                'data-placement' => 'top'
        ]);
        echo Html::a('', ['delete', 'id' => $to['scheld_id']], [
            'class' => 'fa fa-trash',
            'title' => 'Удалить весь график',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить объект?',
                'method' => 'post',
            ],
        ]);
        echo '</td>
                </tr>';
     }
    }
    echo '
          </tbody>
        </table>';
    ?>
  </div>
</div>


<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>

