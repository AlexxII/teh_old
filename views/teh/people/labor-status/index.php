<?php

use yii\helpers\Html;

$this->title = 'Расход';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/teh/admin/index']];
$this->params['breadcrumbs'][] = ['label' => 'Вспомогательные', 'url' => ['/teh/admin/assist']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
  .highlight {
    background-color: #b2dba1;
    color: #CC0000;
    font-weight: 700;
  }
  .datepicker,
  .table-condensed {
    width: 300px;
    height:400px;
    font-size: 22px;
  }
</style>


<script>
    $(document).ready(function () {
        var table = $('#main-table').DataTable({
            "columnDefs": [
                {"visible": false, "targets": 1}
            ],
            orderFixed: [[1, 'desc']],
            order: [[1, 'asc']],
            select: false,
            rowGroup: {
                dataSrc: 1
            },

            responsive: true,
            fixedHeader: {
                header: true,
                headerOffset: $('#topnav').height()
            },
            language: {
                url: "/lib/ru.json"
            }
        });
        table.on('order.dt search.dt', function () {
            table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

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

  <div class="container-fluid">
    <?php

    if ($models) {
      foreach ($models as $model) {
        echo '<div class="w3-row" style="margin-bottom:35px;float: left">
              <div class="w3-container" style="min-width:340px">
                <div class="w3-card-4 user-id" data-id="'. $model->people_id .'">
                  <a style="display:block" href="#" title="Таблица">
                    <header class="w3-container w3-center" >
                      <h2>' . $model->user->name . '</h2>
                    </header>
                    <div class="w3-row w3-center" style="padding: 0 10px">';
        for ($i = 0; $i < 4; $i++) {
          echo '<div class="calendar-row w3-quarter w3-container" style="min-width:340px"></div>';
        }
        echo '</div>
                  </a>
                  <a class="w3-button w3-block w3-teal" ' . Html::a("Добавить", '/lib/') . '</a>
                </div>
              </div>
          </div>';
      }
    }
    ?>
  </div>
</div>


<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function () {
        $.fn.datepicker.defaults.format = "dd.mm.yyyy";
        $.fn.datepicker.defaults.language = "ru";
        $.fn.datepicker.defaults.daysOfWeekDisabled = "0,6";
    });


    function renderCalendars2() {
        $('.user-id').each(function () {
            var id = $(this).data('id');
            renderCalendars($(this), id);
        })
    }


    function renderCalendars(dom, id) {
        var curDate = new Date();
        var year = curDate.getFullYear();
        var month = curDate.getMonth();
        var i = -2;
        dom.find('.calendar-row').each(function () {
            i++;
            $(this).datepicker({
                defaultViewDate: {year: year, month: month + i, day: 01},
                beforeShowDay: function (date) {
                    if (window.busyDays[id]) {
                        if (window.busyDays[id][moment(date).format('Y-MM-DD')]) {
                            return {
                                classes: 'highlight',
                                tooltip: window.busyDays[id][moment(date).format('Y-MM-DD')]
                            };
                        }
                    }
                }
            });
        });
    }

    $(document).ready(function () {
        console.log(getFreeDays());
    });

    var busyDays = new Array(); // глобальный массив хранения
    function getFreeDays(fullDate = new Date()) {
        var start_date, end_date;
        var month = fullDate.getMonth();
        var year = fullDate.getFullYear();
        var mDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        var nMonth = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        start_date = year + '-01-01';
        end_date = year + '-12-31';
        var url = "/teh/to/to-schedule/free-days?start_date=" + start_date + "&end_date=" + end_date;
        var tempArray = new Array();
        $.ajax({
            url: url,
            cache: false,
            success: function (responce) {
                tempArray = $.parseJSON(responce);
                window.busyDays[tempArray[0]['people_id']] = new Array();
                window.busyDays[tempArray[0]['people_id']][tempArray[0]['free_dates']] = tempArray[0]['labor_title'];
                for (var j = 1; j < tempArray.length; j++) {
                    if (window.busyDays[tempArray[j]['people_id']] == window.busyDays[tempArray[j - 1]['people_id']]) {
                        window.busyDays[tempArray[j]['people_id']][tempArray[j]['free_dates']] = tempArray[j]['labor_title']
                    } else {
                        window.busyDays[tempArray[j]['people_id']] = new Array();
                        window.busyDays[tempArray[j]['people_id']][tempArray[j]['free_dates']] = tempArray[j]['labor_title']
                    }
                }
                renderCalendars2();
            }
        });
        console.log(window.busyDays);
        return window.busyDays;
    }


</script>
