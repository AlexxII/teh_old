<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <?php

  use app\assets\AppAsset;
  use yii\helpers\Html;

  AppAsset::register($this);

  ?>

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
      font-size: 20px;
      letter-spacing: 2px;
    }
    .logo-ex a:hover, a:focus{
      text-decoration: none;
    }

    @media (max-width:1000px) {.my-hide li:nth-of-type(3){display:none;}}
    @media (max-width:670px) {#topnav .w3-my:nth-of-type(1) a:nth-of-type(6){display:none;}}
    @media (max-width:540px) {#topnav .w3-my:nth-of-type(1) a:nth-of-type(5){display:none;}}
    @media (max-width:460px) {#topnav .w3-my:nth-of-type(1) a:nth-of-type(4){display:none;}}
    @media (max-width:310px) {#topnav .w3-my:nth-of-type(1) a:nth-of-type(3){display:none;}}

  </style>


</head>
<body style="position: relative;min-height: 100px">
<?php $this->beginBody() ?>



  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="hidden-sm-down navbar-brand logo-ex hidden-xs" href="#">Документация <span style="color: #4CAF50">2.0</span></a>
      <a class="navbar-brand logo-ex hidden-sm hidden-md hidden-lg" href="#">Д<span style="color: #4CAF50">2.0</span></a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="true">
        <span class="sr-only"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav my-hide">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Меню<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Все оборудование</a></li>
            <li><a href="#">Средства ВКС</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Акты передачи</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Учеба</a></li>
          </ul>
        </li>
        <li><a href="#">ПАК<span class="sr-only"></span></a></li>
        <li><a href="#">ПАК1<span class="sr-only"></span></a></li>
        <li><a href="#">ПАК2<span class="sr-only"></span></a></li>
        <li><a href="#">ПАК3<span class="sr-only"></span></a></li>
        <li><a href="#">ПАК4<span class="sr-only"></span></a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><i class="fa fa-user"></i> Войти</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<div class="tab-content">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">...</div>
  <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">...</div>
</div>
<div class="container-fluid">
  <div class="col-md-12 col-lg-12">
      <?= $content  ?>
  </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
