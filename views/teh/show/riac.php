<?php


  echo '<div class="w3-row">';
    echo '<div class="w3-col l4 m6">';

    if (!empty($ph)) {
      echo '<div class="w3-row">';
      echo '<div class="w3-col m12 l12">';
      foreach ($ph as $p) {
        echo '<img src="' . $p['photo_path'] . '" alt="" width="250" height="300">';
      }
      echo '</div>';
      echo '</div>';
    }

    $q = 1;

    if (!empty($tools)) {
      foreach ($tools as $tool) {
        echo '<ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">'
                    . $tool['cat_title'] .
                  '<span class="badge badge-primary badge-pill">' . $tool['pak_title'] . '</span>
                  </li>';
      }
        echo '</ul>';

    }
//        echo '<div class="alert alert-success" role="alert">
//                <h4 class="alert-heading">'. $tool->tool_title .'</h4>
//                <p>'.$tool->tool_manufact . ' ' .$tool->tool_model.'</p>
//                <hr>
//                <p class="mb-0">'.$tool->place->place_title.'</p>
//                <hr>
//                <p class="mb-0">'.$tool->pak->pak_title.'</p>
//                <p class="mb-0">'.$tool->pak->pak_admin.'</p>
//              </div>';
//      }

    echo '</div>';
  echo '</div>';

