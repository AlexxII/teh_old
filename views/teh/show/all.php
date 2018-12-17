<?php

use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>

<p><h2>Оборудование 4 отделения</h2></p>
<div class="w3-row">
  <div class="w3-twothird" style="padding-top: 10px">
    <div class="w3-col l8 m7" id="edit-block" style="display:none">
      <button type="button" id="table-editor" class="btn btn-primary btn-sm">Редактировать</button>
      <button type="button" id="table-del" class="btn btn-danger btn-sm">Удалить</button>
      <P></P>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $('#main-table').DataTable({
            "columnDefs": [
//                { "visible": false, "targets": 1 },
//                { "visible": false, "targets": 9 }
            ],
//            orderFixed: [[9, 'desc']],
            select: false,
//            rowGroup: {
//                dataSrc: 9
//            },
            responsive: true,
            fixedHeader: {
                header: true,
                headerOffset: $('#topnav').height()
            },
            language: {
                "processing": "Подождите...",
                "search": "Поиск:",
                "lengthMenu": "Показать _MENU_ записей",
                "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                "infoEmpty": "Записи с 0 до 0 из 0 записей",
                "infoFiltered": "(отфильтровано из _MAX_ записей)",
                "infoPostFix": "",
                "loadingRecords": "Загрузка записей...",
                "zeroRecords": "Записи отсутствуют.",
                "emptyTable": "В таблице отсутствуют данные",
                "paginate": {
                    "first": "Первая",
                    "previous": "Предыдущая",
                    "next": "Следующая",
                    "last": "Последняя"
                },
                "aria": {
                    "sortAscending": ": активировать для сортировки столбца по возрастанию",
                    "sortDescending": ": активировать для сортировки столбца по убыванию"
                }
            }
        });
    });

</script>

<?php

  $form = ActiveForm::begin([
      'id' => 'tool_title',
      'fieldConfig' => [
          'options' => [
              'tag' => false,
          ],
      ],
  ]); ?>

      <table id="main-table" class="display no-wrap cell-border" style="width:100%">
        <thead>
          <tr>
            <th >№ п.п.</th>
            <th data-priority="1">Наименование</th>
            <th data-priority="2" >Категория</th>
            <th data-priority="5" ><input id="all" class="tb-ch" type="checkbox"></th>
          </tr>
        </thead>
        <tbody>
  <?php
  $i = 1;
    foreach($equip as $e=>$eq): ?>
          <tr>
            <td><?= $i  ?></td>
            <td><?= $form->field($eq,"[$e]tool_title", ['template' => "<div style='max-width:70%'>{input}</div>"])->label(false); ?> </td>
            <td><?= $form->field($eq, "[$e]category_id", ['template' => "<div style='max-width:70%'>{input}</div>"] )->dropDownList($eq->categoryList)->label(false); ?> </td>
            <td><input class="tb-ch" type="checkbox"></td>
          </tr>
      <?php $i++?>
    <?php endforeach; $i++?>
        </tbody>
      </table>

  <?= Html::submitButton('Сохранить'); ?>
<?php ActiveForm::end(); ?>


<script>
    function copySelect(e) {
        var i = $(this).closest('td').index();
        var val = e.target.value;
        $('#main-table > tbody > tr').each(function () {
            if ($(this).find('.tb-ch').is(':checked')) {
                $(this).find('td').eq(i).find(e.target.nodeName).val(val);
            }
        });
    }

    $(document).ready(function(){
        var table = $('#main-table');
        console.log(table);
        table.on('change', '#all', function(){
            $('> tbody input:checkbox', table).prop('checked', $(this).is(':checked')).trigger('change');
        });
    });

    $(':input').on('input', copySelect);



</script>
