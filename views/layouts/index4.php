<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Collapsible sidebar using Bootstrap 3</title>
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

    </head>
    <body >
    <?php $this->beginBody() ?>



        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>Bootstrap Sidebar</h3>
                    <strong>BS</strong>
                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-home"></i>
                            Home
                        </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="#">Home 1</a></li>
                            <li><a href="#">Home 2</a></li>
                            <li><a href="#">Home 3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-briefcase"></i>
                            About
                        </a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false">
                            <i class="glyphicon glyphicon-duplicate"></i>
                            Pages
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li><a href="#">Кронштейны и стойки для телевизоров</a></li>
                            <li><a href="#">Page 2</a></li>
                            <li><a href="#">Page 3</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-link"></i>
                            Portfolio
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-paperclip"></i>
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="glyphicon glyphicon-send"></i>
                            Contact
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Page Content Holder -->
            <div id="content" style="width: 100%">

                <nav class="navbar navbar-default">
                    <div class="container-fluid">

                        <div class="navbar-header">
                            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                                <i class="glyphicon glyphicon-align-left"></i>
                                <span>Toggle Sidebar</span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#">Page333</a></li>
                                <li><a href="#">Page444</a></li>
                                <li><a href="#">Page555</a></li>
                                <li><a href="#">Page666</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>


              <?= $content ?>;
            </div>
        </div>
        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

         <script type="text/javascript">
             $(document).ready(function () {
                 $('#sidebarCollapse').on('click', function () {
                     $('#sidebar').toggleClass('active');
                 });
             });
         </script>
    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
