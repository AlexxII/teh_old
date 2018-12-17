<?php

namespace app\controllers\teh\to;

use app\models\teh\to\ToEquipm;
use Yii;
use app\models\teh\to\To;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ToController implements the CRUD actions for To model.
 */
class ToEquipmentController extends Controller
{
  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
        'verbs' => [
            'class' => VerbFilter::class,
            'actions' => [
                'delete' => ['POST'],
            ],
        ],
    ];
  }

  public function actionOperationTime()              //  наработка
  {
    $model = new ToEquipm();
    return $this->render('operation_time', [
        'tos' => $model->find()->all(),
    ]);
  }


//================================================ Порядок отображения оборудования в графике ТО ========================
  //  порядок отображения оборудования в графике ТО
  public function actionOrder()
  {
    $model = new ToEquipm();
    $paks = $model->find()->joinWith('tool')->groupBy('{{tool_tbl}}.pak_id')->all();
    return $this->render('order', [
        'model' => $paks,
    ]);
  }

// =AJAX=
  // порядок отображения - к данному экшену обращается таблица по ajax
  public function actionEquipmentOrder($pakid = 3)
  {
    $model = new ToEquipm();
    $to = $model->find()->joinWith('tool')->where(['{{tool_tbl}}.pak_id' => $pakid])->asArray()->all();
    return json_encode(array('data' => $to));
  }

  // к данному экшену обращается таблица при срабатывании события - перемещение строк
  public function actionEquipmentOrderAjax()                      //  потенциальная уязвимость
  {
    if (!empty($_POST['jsonData'])) {
      $postArray = json_decode($_POST['jsonData'], true);
      foreach ($postArray as $ar) {
        $model = ToEquipm::find()->where(['eq_id' => $ar['id']])->one();
        $model->order = $ar['order'];
        $model->save();
      }
      return 'success';
    }
    return false;
  }


//====================== Работа с таблицей to_equip_tbl ==============================

  public function actionIndex()
  {
    $model = new ToEquipm();
    return $this->render('index', [
        'tos' => $model->find()->all(),
    ]);
  }

  /**
   * Displays a single To model.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id)
  {
    return $this->render('view', [
        'model' => $this->findModel($id),
    ]);
  }

  /**
   * Creates a new To model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new ToEquipm();
    if ($model->load(Yii::$app->request->post())) {
      $model->created = date("Y-m-d H:i:s");
      if ($model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
      } else {
        Yii::$app->session->setFlash('error', "Не удалось добавить оборудование в график");
      }
    };
    return $this->render('create', [
        'model' => $model,
    ]);
  }

  /**
   * Updates an existing To model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    if ($model->load(Yii::$app->request->post())) {
      $model->updated = date("Y-m-d H:i:s");
      if ($model->save()) {
        return $this->redirect(['view', 'id' => $model->id]);
      } else {
        Yii::$app->session->setFlash('error', "Не удалось обновить информацию об оборудовании");
      }

      return $this->redirect(['view', 'id' => $model->id]);
    }
    return $this->render('update', [
        'model' => $model,
    ]);
  }

  /**
   * Deletes an existing To model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }

  /**
   * Finds the To model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return To the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = ToEquipm::findOne($id)) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }


}
