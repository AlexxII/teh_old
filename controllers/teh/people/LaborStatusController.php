<?php

namespace app\controllers\teh\people;

use Yii;
use app\models\teh\people\labor\PeopleLaborStatus;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LaborController implements the CRUD actions for PeopleLaborStatus model.
 */
class LaborStatusController extends Controller
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

  /**
   * Lists all PeopleLaborStatus models.
   * @return mixed
   */
  public function actionIndex()
  {
    $models = PeopleLaborStatus::find()->groupBy('people_id')->all();
    return $this->render('index', [
        'models' => $models,
    ]);
  }

  /**
   * Displays a single PeopleLaborStatus model.
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
   * Creates a new PeopleLaborStatus model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new PeopleLaborStatus();

    if ($model->load(Yii::$app->request->post())) {
      $dates = explode(",", $model['free_date']);
      foreach ($dates as $date) {
        $nModel = new PeopleLaborStatus();
        $nModel->people_id = $model->people_id;
        $nModel->labor_title = $model->labor_title;
        $nModel->comment = $model->comment;
        $nModel->free_date = date('y-m-d', strtotime($date));
        $nModel->save();
      }
      return $this->redirect(['index']);
    }

    return $this->render('create', [
        'model' => $model,
    ]);
  }

  /**
   * Updates an existing PeopleLaborStatus model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('update', [
        'model' => $model,
    ]);
  }

  /**
   * Deletes an existing PeopleLaborStatus model.
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
   * Finds the PeopleLaborStatus model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return PeopleLaborStatus the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = PeopleLaborStatus::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
