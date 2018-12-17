<?php
/**
 * Created by PhpStorm.
 * User: Inter
 * Date: 07.05.2018
 * Time: 13:18
 */

namespace app\controllers\teh;

use yii\web\Controller;

class AdminController extends Controller
{
  public function actionIndex()
  {
    return $this->render('index');
  }

  public function actionEquipment()
  {
    return $this->render('equipment');
  }

  public function actionAssist()
  {
    return $this->render('assist');
  }

}