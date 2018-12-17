<?php

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\widgets\Alert;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= Html::csrfMetaTags() ?>
  <?php $this->head() ?>
  <script src="/assets/d91b1917/js/php-date-formatter.min.js" type="text/javascript"></script>
  <style>
    .breadcrumb {
      background-color: #fff;
      font-size: 0.8em;
      margin-bottom: 10px;
      padding: 0;
    }
    .breadcrumb a {
      color: #337ab7;
      text-decoration: none;
    }
    .alert {
      margin-bottom: 0px;
    }
    #sidenav {
      display: none;
    }
  </style>

</head>
<body style="position: relative;min-height: 100px">
<?php $this->beginBody() ?>

  <div class="w3-card-2 topnav" id="topnav" style="position:relative;top:0px;z-index: 900">
    <div style="overflow:auto">
      <div class="w3-bar w3-left w3-my" style="width:100%;overflow:hidden;height:42px">
        <a href='javascript:void(0);' class='topnav-icons fa fa-menu w3-left w3-button' onclick='open_menu()'
           title='Меню'></a>
        <a href='index.php' class='topnav-icons fa fa-home w3-left w3-bar-item w3-button' title='Home'></a>
        <a class="w3-bar-item w3-button" href="/teh/show/pak" title='Комплексы'>ПАК</a>
        <a class="w3-bar-item w3-button" href="/teh/to/" title='Комплексы'>ТО</a>
        <a class="w3-bar-item w3-button" href="/teh/show/all" title='Таблица оборудования'>Таблица</a>
        <a class="w3-bar-item w3-button" href="javascript:void(0)" title='Источники бесперебойного питания'>ИБП</a>
        <a class="w3-bar-item w3-button" href="javascript:void(0)" title='Картриджи'>Картриджи</a>
        <a class="w3-bar-item w3-button" style="text-decoration:none" href="javascript:void(0)"
           title='Принтеры'>Принтеры</a>
        <?php
        if (Yii::$app->user->isGuest) {
          echo Html::a('<span class="fa fa-sign-in" aria-hidden="true" style="font-size:20px"><span style="font-family:Verdana;font-size: 16px;"> Войти</span></span>', ['/site/login'], ['class' => 'w3-right w3-button']);
        } else {
          echo Html::a('<i class="fa fa-unlock-alt" aria-hidden="true" style="font-size:18px"></i>', ['/teh/admin/'], ['class' => 'w3-bar-item w3-button']);
          echo Html::beginForm(['/site/logout'], 'post');
          echo Html::submitButton(
              '<span style="font-family:Verdana;font-size:16px">Выход </span><span class="fa fa-sign-out" aria-hidden="true" style="font-size:20px"></span>',
              ['class' => 'my-button w3-button w3-right ']
          );
          echo Html::endForm();

        }
        ?>
      </div>
    </div>
  </div>

  <div class='w3-sidebar' id='sidenav' style="z-index:700;width:240px">
    <div id='leftmenuinner'>
      <div class='w3-light-grey' id='leftmenuinnerinner'>
        <p onclick='close_menu()' class='w3-button w3-large w3-display-topright'
           style='right:16px;padding:3px 12px;font-weight:bold;background-color:#f1f1f1!important;opacity:0.5;cursor:pointer'>
          &times;</p>
        <h2 class="left"><span class="left_h2">ЛВС</span></h2>
        <a target="_top" <?= Html::a('РИАЦ', ['teh/show/riac']) ?></a>
        <a target="_top" href="#">ГФИ по МО</a>
        <a target="_top" href="#">Премная Президента</a>
        <a target="_top" href="#">Областная Дума</a>
        <br>
        <h2 class="left"><span class="left_h2">ВКС</span></h2>
        <a target="_top" href="#">КВС ГФИ</a>
        <a target="_top" href="#">ЗВС Пр.Президента</a>
        <a target="_top" href="#">ЗВС ОГВ</a>
        <a target="_top" href="#">Мобильный комплект</a>
        <a target="_top" href="#">Мобильная приемная</a>
        <br>
        <h2 class="left"><span class="left_h2">ССТУ</span></h2>
        <a target="_top" href="#">Средства ССТУ</a>
        <a target="_top" href="#">Лицензия VipNet</a>
        <br>
        <h2 class="left"><span class="left_h2">СКЗИ</span></h2>
        <a target="_top" href="#">АПКШ Центра</a>
        <br>
        <h2 class="left"><span class="left_h2">МЭДО</span></h2>
        <a target="_top" href="#">Средства МЭДО</a>
        <br>
        <h2 class="left"><span class="left_h2">Инвентаризация</span></h2>
        <a target="_top" href="#">Правительство МО</a>
        <a target="_top" href="#">АТЗ Центра</a>
        <a target="_top" href="#">Приемная Президента</a>
        <a target="_top" href="#">Областная Дума</a>
        <a target="_top" href="#">На списание</a>
        <a target="_top" href="#">Забалансовый УЧЕТ</a>
        <br>
        <h2 class="left"><span class="left_h2">Электропитание</span></h2>
        <a target="_top" href="#">ИБП</a>
        <a target="_top" href="#">Батареи</a>
        <br>
        <h2 class="left"><span class="left_h2">Переферия</span></h2>
        <a target="_top" href="#">Принтеры и МФУ</a>
        <a target="_top" href="#">Картриджи</a>
        <br>
        <h2 class="left"><span class="left_h2">Справочно</span></h2>
        <a target="_top" href="#">Пароли</a>
        <a target="_top" href="#">Телефоны</a>
        <br>
        <h2 class="left"><span class="left_h2">Учеба</span></h2>
        <a target="_top" href="#">Электропитание</a>
        <br>
        <br>
        <br>
        <br>
        <br>
      </div>
    </div>
  </div>


  <div class='w3-main w3-light-grey' id='belowtopnav'>
    <div class="w3-row w3-white">
      <div id="main" class="w3-col l12 m12">
        <div class="container-fluid">
          <?= Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
              'options' => [
                  'class' => 'breadcrumb'
              ],
              'tag' => 'ol',
              'homeLink' => [
                  'label' => Yii::t('yii', 'Главная'),
                  'url' => ['/teh/show/index'],
                  'class' => 'home',
              ],
          ]) ?>
          <?= Alert::widget() ?>

          <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title center" id="ModalLongTitle"> Подождите...</h5>
                </div>
              </div>
            </div>
          </div>
            <?= $content ?>
        </div>
      </div>
    </div>
  </div>


<script>
    $(document).ready(function () {
        var allL = $(".w3-bar-item");
        var allSidebar = $("#leftmenuinner a");
        allL.click(function () {
            allL.css("background-color", "#4CAF50");
            allL.not(this).css("background-color", "#5f5f5f");
            allSidebar.css("background-color", "#f1f1f1");
        });
        allSidebar.click(function () {
            allSidebar.css("background-color", "#4CAF50");
            allL.not(this).css("background-color", "#5f5f5f");
            allSidebar.not(this).css("background-color", "#f1f1f1");
        })
    });
</script>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
