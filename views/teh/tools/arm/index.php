<?php

use yii\helpers\Html;

$this->title = 'АРМ';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Оборудование', 'url' => ['/teh/admin/equipment']];
$this->params['breadcrumbs'][] = $this->title;
?>

<script>
    $(document).ready(function() {
        $('#main-table').DataTable({
            "columnDefs": [
                { "visible": false, "targets": 0 },
                { "visible": false, "targets": 4 }
            ],
//            orderFixed: [[4, 'desc']],
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



if (!empty($arms)) {
    echo '
      <table id="main-table" class="display no-wrap cell-border" style="width:100%">
        <thead>
          <tr>
            <th style="max-width: 10px">id</th>
            <th data-priority="1">№ п.п.</th>
            <th data-priority="2">Наименование</th>
            <th data-priority="3" >Категория</th>
            <th >ПАК</th>
            <th data-priority="5" >Состав</th>
            <th >Пользователь</th>
            <th >Версия ОС</th>
            <th data-priority="8">Action</th>
          </tr>
        </thead>
        <tbody>';
    $i = 1;
  foreach ($arms as $arm) {
    echo '
                <tr>
                  <td>' . $arm->id . '</td>
                  <td>'. $i .'</td>
                  <td>' . $arm->complex_title . '</td>
                  <td>';
                    if (!empty($arm->category)) {
                      echo $arm->category->cat_title;
                    } else {
                      echo "-";
                    };
            echo '</td>
                  <td>';
                    if (!empty($arm->pak)) {
                      echo $arm->pak->pak_title;
                    } else {
                      echo "-";
                    }
            echo '</td>
                  <td>';
                    if (!empty($arm->tools)) {
                      foreach ($arm->tools as $t)
                        echo ''. $t->tool_title . '<br>';
                    } else {
                      echo "-";
                    }
            echo '</td>
                  <td>';
                    if (!empty($arm->user)) {
                      echo $arm->user->name;
                    } else {
                      echo "-";
                    }
            echo '</td>
                  <td>' . $arm->soft_version . '</td>';
            echo '<td>';
            echo Html::a('', ["view?id=" . $arm->id], ['class' => 'fa fa-eye']);
            echo Html::a('', ["update?id=" . $arm->id], ['class' => 'fa fa-pencil']);
            echo Html::a('', ["delete?id=" . $arm->id], ['class' => 'fa fa-trash real', 'data-id' => $arm->id]);
            echo '</td>
                </tr>';
    $i++;
  }
  echo '
        </tbody>
      </table>';
} else {
  echo 'Пусто';
}

?>

<script>
  $(".real").on("click", function(e) {
    if (confirm("Удалить компоненты, входящие в состав АРМ?")) {
      e.preventDefault();
      var id = $(this).attr('data-id');
      var url = "/teh/arm/delete?id="+id+"&all=1";
      location.href = url;
    } else {3
      var url = "/teh/arm/delete?id="+id;
      location.href = url;
    }
  });
</script>
