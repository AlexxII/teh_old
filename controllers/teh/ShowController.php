<?php

namespace app\controllers\teh;

use app\models\teh\complex\Complex;
use app\models\teh\place\Place;
use app\models\teh\tool\Tool;
use app\models\teh\Photo;
use app\models\UploadForm;
use Yii;
use yii\web\Controller;
use app\models\teh\tool\ToolSearch;


class ShowController extends Controller
{
  public function actionAll()
  {
    $ph = Photo::find()->all();
    $equip = Tool::find()->all();

    if (Tool::loadMultiple($equip, Yii::$app->request->post()) &&
        Tool::validateMultiple($equip)) {
      $count = 0;
      foreach ($equip as $e) {
        if ($e->save()) {
          $count++;
        }
      }
      Yii::$app->session->setFlash('success', "Обработано {$count} records successfully.");
      return $this->render('all', ['equip' => $equip]); // redirect to your next desired page
    } else {
      return $this->render('all', ['equip' => $equip]);
    }

  }

  public function actionRiac()
  {
    $complex = new Tool() ;
    return $this->render('riac', ['tools' => $complex->showTools()]);
  }

  public function actionPak()
  {
    $searchModel = new ToolSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    return $this->render('pak', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
  }

  public function actionToolarmgroup()
  {
    $searchModel = new ToolSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    return $this->render('toolarmgr', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
    ]);
  }

  public function actionEdit($id = null)
  {
    if ($id == null) {
      $id = 17;
    }
    $tools = Tool::findOne($id);
    $fUpLoad = new UploadForm();
    return $this->render('../add/tool', ['tools' => $tools, 'fupload' => $fUpLoad]);
  }


  public function actionIndex()
  {
    return $this->render('index');
  }

}
