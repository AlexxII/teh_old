<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Порядок отображения оборудования в графике';
$this->params['breadcrumbs'][] = ['label' => 'ТО', 'url' => ['/teh/to/']];
$this->params['breadcrumbs'][] = ['label' => 'Перечень оборудования', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  .red {
    background-color: #CC0000;
  }
</style>


<script>
    $(document).ready(function () {
        var table = $('#equipTable').DataTable({
            "columnDefs": [
                {"visible": false, "targets": 0},
            ],
            ajax: 'equipment-order',
            rowReorder: {
                dataSrc: 'order'
            },
            orderFixed: [[4, 'asc']],
            responsive: true,
            fixedHeader: {
                header: true,
                headerOffset: $('#topnav').height()
            },
            searching: false,
            paging: false,
            columns: [
                {data: 'id'},
                {data: 'eq_id'},
                {data: 'tool.tool_title'},
                {data: 'eq_title'},
                {data: 'order'}
            ]
        });

        table.on('preXhr.dt', function (e, settings, json, xhr) {
            $('#ModalCenter').modal('show');
        });

        table.on('xhr.dt', function (e, settings, json, xhr) {
            $('#ModalCenter').modal('hide');
        });

        table.on('row-reordered', function (e, diff, edit) {
            var order = {};
            for (var i = 0, ien = diff.length; i < ien; i++) {
                var index = table.row(diff[i].node).index();
                var id = table.cell(index, 1).data();
                ord = table.cell(index, 4).data();
                order[i] = {id: id, order: ord};
            }
            order = JSON.stringify(order);
            table.rowReorder.disable();
            $.ajax({
                url: "equipment-order-ajax",
                type: "post",
                data: "jsonData=" + order,
                success: function (result) {
                    table.rowReorder.enable();
                },
                error: function () {
                    alert('Ошибка! Обратитесь к разработчику.');
                    table.ajax.reload();
                }
            })
        });

        $('#pak').change(function (e) {
            var id = $(this).val();
            table.ajax.url('equipment-order?pakid=' + id).load();
        });
    });
</script>


<div class="to-create">
  <h1><?= Html::encode($this->title) ?></h1>


  <div class="row">
    <div class="col-lg-6 col-md-10">
      <div class="alert alert-warning alert-dismissible show" role="alert" style="margin-bottom: 10px">
        <strong>Внимание!</strong> Для
        <strong>
          <?= Html::a('формой', 'create', ['style' => ['border-bottom' => '1px dashed #9e6d3b']]); ?>
        </strong>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4 col-md-8">
      <div class="form-group">
        <label for="pak">Выберите ПАК</label>
        <select class="form-control pak-order" id="pak">
          <?php foreach ($model as $m) : ?>
            <option class="active" value="<?= $m->tool->pak_id ?>"><?= $m->tool->pak->pak_title ?></option>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  </div>
  <br>

  <table id="equipTable" class="display" style="width:100%">
    <thead>
    <tr>
      <th>ID</th>
      <th>ID оборудования</th>
      <th>Оборудование</th>
      <th>Наименование оборудования в графике</th>
      <th>Порядок отображения</th>
    </tr>
    </thead>
  </table>


</div>
