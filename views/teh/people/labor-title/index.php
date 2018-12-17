<?php

use yii\helpers\Html;

$this->title = 'Трудовой статус';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вспомогательные', 'url' => ['/teh/admin/assist']];
$this->params['breadcrumbs'][] = $this->title;;
?>

<script>
    $(document).ready(function () {
        var table = $('#main-table').DataTable({
            "columnDefs": [
//                {"visible": false, "targets": 3},
            ],
//            orderFixed: [[1, 'desc']],
//            order: [[1, 'asc']],
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


<div class="row">

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
              <th data-priority="2">Наименование</th>
              <th data-priority="3">Action</th>
            </tr>
          </thead>
          <tbody>';

    if ($models) {
      foreach ($models as $model) {

        echo '
                  <tr>
                    <td></td>
                    <td>'. $model->title.'</td>';
        echo '<td style="text-align: center">';
        echo Html::a('', ["update?id=". $model->id ], [
            'class' => 'fa fa-pencil',
            'title' => 'Обновить запись',
            'data-toggle' => 'tooltip',
            'data-placement' => 'top'
        ]);
        echo Html::a('', ['delete', 'id' => $model->id], [
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
