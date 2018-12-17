<?php

use yii\helpers\Html;

$this->title = 'Порядок отображения подкатегорий';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вспомогательные', 'url' => ['/teh/admin/assist']];
$this->params['breadcrumbs'][] = ['label' => 'Категории оборудования', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  .red {
    background-color: #CC0000;
  }
</style>


<script>
    $(document).ready(function() {
        var table = $('#equipTable').DataTable( {
            "columnDefs": [
                { "visible": false, "targets": 0},
                { orderable: true, className: 'reorder', targets: 1 } // перемещение
            ],
            ajax: 'category-reorder',
            rowReorder: {
                dataSrc: 'custom_order'
            },
            orderFixed: [[3, 'asc']],
            responsive: true,
            fixedHeader: {
                header: true,
                headerOffset: $('#topnav').height()
            },
            searching:false,
            paging: false,
            columns: [
                { data: 'id' },
                { data: 'id' },
                { data: 'cat_title' },
                { data: 'custom_order' }
            ]
        } );
        table.on('row-reordered', function (e, diff, edit) {
            var order = {};
            for (var i = 0, ien = diff.length; i < ien; i++) {
                var index = table.row(diff[i].node).index();
                var id = table.cell(index, 1).data();
                ord = table.cell(index, 3).data();
                order[i] = {id: id, order: ord};
            }
            order = JSON.stringify(order);
            table.rowReorder.disable();
            $.ajax({
                url: "category-order-ajax",
                type: "post",
                data: "jsonData="+order,
                success: function(result){
                    table.rowReorder.enable();
                },
                error: function () {


                }
            })
        } );
        $('#myTabs').click(function (e) {
            e.preventDefault();
            $(this).tab('show');
            var id = e.target.dataset.id;
            table.ajax.url('category-reorder?parent=' + id).load();
        })
    } );

</script>


<div class="to-create">
  <h1><?= Html::encode($this->title) ?></h1>

  <ul class="nav nav-tabs" id="myTabs">
    <?php foreach ($model as $m) : ?>
      <li role="presentation" class="active" ><a
                href="#" data-id="<?= $m->id ?>"><?= $m->cat_title ?></a></li>
    <?php endforeach; ?>
  </ul>
  <br>

  <table id="equipTable" class="display" style="width:100%">
    <thead>
    <tr>
      <th>ID</th>
      <th>ID</th>
      <th>Подкатегория</th>
      <th>Порядок отображения</th>
    </tr>
    </thead>
  </table>



</div>
