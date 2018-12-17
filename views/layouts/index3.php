<?php

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= Html::encode($this->title) ?></title>


      <?php $this->head() ?>
      <script>
          jQuery(function($){
              $('.table').footable();
              close_menu();
          });

      </script>

      <style>
        .logo-ex {
          font-family: alian_ex;
          font-size: 18px;
          letter-spacing: 0px;
          color: #555555;
        }
        .logo-ex a:hover, a:focus{
          text-decoration: none;
        }
      </style>

    </head>
    <body>
    <?php $this->beginBody() ?>

        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div id="dismiss">
                    <i style="font-size: 20px" class="fa fa-times"></i>
                </div>

                <div class="sidebar-header">
                  <p class="logo-ex" style="font-size: 20px">Документация <span style="color: #4CAF50">2.0</span></p>
                </div>

                <ul class="list-unstyled components" style="background-color: #f1f1f1 ">
                  <li>
                    <a href="#">ПАКи</a>
                  </li>
                  <li>
                    <a href="#lvsSubmenu" data-toggle="collapse" aria-expanded="false">ЛВС</a>
                    <ul class="collapse list-unstyled" id="lvsSubmenu">
                      <li><a href="#">Все оборудование</a></li>
                      <li><a href="#">Категории</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="#vksSubmenu" data-toggle="collapse" aria-expanded="false">ВКС</a>
                    <ul class="collapse list-unstyled" id="vksSubmenu">
                      <li><a href="#">АП ЗВС ОГВ</a></li>
                      <li><a href="#">КВС ГФИ</a></li>
                      <li><a href="#">ЗВС Пр.Президента</a></li>
                      <li><a href="#">Вывозимый АП ВКС</a></li>
                      <li><a href="#">АП ВКС ПТС-МК</a></li>
                    </ul>
                  </li>
                    <li>
                        <?= Html::a('Добавить оборудование', ['teh/add/equipment'])?>
                    </li>
                    <li>
                        <a href="#">Техническое обслуживание</a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content">

              <div class="topnav" id="topnav" style="background-color: #5f5f5f">
                  <div class="w3-bar w3-left w3-my" style="width:100%;overflow:hidden;height:42px">
                    <a href='javascript:void(0);' class='topnav-icons w3-left w3-button' id="sidebarCollapse"><i class="fa fa-align-left"></i></a>
                    <a href='index.php' class='topnav-icons fa fa-home w3-left w3-bar-item w3-button' title='Home'></a>
                    <a class="w3-bar-item w3-button" href="/teh/show/all" title='Комплексы'>ПАК</a>
                    <a class="w3-bar-item w3-button" href="javascript:void(0)" title='Пароли'>Пароли</a>
                    <a class="w3-bar-item w3-button" href="javascript:void(0)" title='Источники бесперебойного питания'>ИБП</a>
                    <a class="w3-bar-item w3-button" href="javascript:void(0)" title='Картриджи'>Картриджи</a>
                    <a class="w3-bar-item w3-button" style="text-decoration:none" href="javascript:void(0)" title='Принтеры'>Принтеры</a>
                    <?= Html::a('+', ['teh/add/equipment'])?></a>
                    <a class="topnav-icons fa w3-right w3-button" href="javascript:void(0)" title='Поиск оборудования'><i class='fa fa-search'></i></a>
                  </div>
              </div>

              <?= $content ?>


            </div>
        </div>

        <div class="overlay"></div>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#dismiss, .overlay').on('click', function () {
                    $('#sidebar').removeClass('active');
                    $('.overlay').fadeOut();
                });

                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').addClass('active');
                    $('.overlay').fadeIn();
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
