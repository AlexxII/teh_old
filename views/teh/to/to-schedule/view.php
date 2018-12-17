<?php

use yii\helpers\Html;

$this->title = 'График TО';
$this->params['breadcrumbs'][] = ['label' => 'ТО', 'url' => ['/teh/to/index']];
$this->params['breadcrumbs'][] = ['label' => 'Графики ТО', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
require "to_array.php";

?>

<script>
    $(document).ready(function () {
        var table = $('#main-table').DataTable({
            "columnDefs": [
                {"visible": false, "targets": 0},
                {"visible": false, "targets": 4},
                {"visible": false, "targets": 5}
            ],
            orderFixed: [[4, 'desc']],
            rowGroup: {
                startRender: function (rows, group) {
                    var test = rows.data().pluck(5).reduce( function (a, b) {
                        return a, b;
                    }, 0);
                    return $('<tr/>')
                        .append( '<td colspan="10" style="text-align: left">'+group+' '+test+'</td>' );
                },
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



<div class="row">
  <div class="w3-col l8">
    <div class="container-fluid" style="margin-bottom: 20px">

      <h1>
        <?php
        if ($month) {
          echo Html::encode($this->title) . ' на ' . $month;
        } else {
          echo Html::encode($this->title);
        }
        ?>
      </h1>
      <?= Html::a(' Отметить', ["perform?id=".$id], [
          'class' => 'btn btn-success btn-sm fa fa-check-square-o ',
          'style' => [
                  'margin-top' => '5px',
                  'font-size' => '18px'
          ],
          'title' => 'Отметить выполнение графика',
          'data-toggle' => 'tooltip',
          'data-placement' => 'top'
      ]);
      ?>

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
              <th >id</th>
              <th data-priority="1">№ п.п.</th>
              <th data-priority="2">Наименование оборудования</th>
              <th data-priority="7">s/n</th>
              <th >ПАК</th>
              <th >Check</th>
              <th data-priority="4">Вид ТО</th>
              <th >Дата проведения (план.)</th>
              <th data-priority="5" >Дата проведения (факт.)</th>
              <th >Ответственный за проведение</th>
              <th >Ответственный за контроль</th>
              <th >Отметка о проведении</th>
              <th data-priority="3">Action</th>
            </tr>
          </thead>
          <tbody>';
    if ($tos) {
      foreach ($tos as $to) {

        echo '
                  <tr>
                    <td>' . $to->id . '</td>
                    <td></td>';
        echo '<td>';
        if (!empty($to->toEq)) {
          echo $to->toEq->eq_title;
        } else {
          echo '<span style="color:#CC0000">Вероятно оборудование удалено</span>';
        };
        echo '</td>';
        echo '<td>';
        if (!empty($to->toEq)) {
          echo $to->toEq->tool->tool_serial;
        } else {
          echo '<span style="color:#CC0000">Вероятно оборудование удалено</span>';
        };
        echo '</td>';

        echo '<td>';
        if (!empty($to->toEq->tool)) {
          echo $to->toEq->tool->pak->pak_title;
        } else {
          echo '<span style="color:#CC0000">Вероятно оборудование удалено</span>';
        };
        echo '<td>';
          echo $to->checkmark;
        echo '</td>';

        echo '</td>
                    <td>' . $to_kind[$to->to_type] . '</td>
                    <td>' . date("d.m.Y г.", strtotime($to->plan_date)) . '</td>
                    <td>';
                          if ($to->fact_date != null) {
                            echo date("d.m.Y г.", strtotime($to->fact_date));
                          } else {
                            echo '-';
                          }
             echo '</td>
                    <td>' . $to->admin->name . '</td>
                    <td>' . $to->adminCtrl->name . '</td>
                    <td>';
        if ($to->checkmark == 1) {
          echo '<span style="color:#4CAF50"><strong>ТО проведено</strong></span>';
        } else {
          if (date('Y-m-d') < $to->plan_date) {
            echo '<span style="color:#4349cc"><strong>ТО не проведено</strong></span>';
          } else {
            echo '<span style="color:#CC0000"><strong>ТО не проведено</strong></span>';
          }
        }
        echo '</td>';
        echo '<td>';
//        echo Html::a('', ["/teh/to/view?id=" . $to->id], ['class' => 'fa fa-eye']);
        echo Html::a('', ["/teh/to/update?id=" . $to['id']], ['class' => 'fa fa-pencil']);
        echo Html::a('', ["/teh/to/delete?id=" . $to['id']], ['class' => 'fa fa-trash']);
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

