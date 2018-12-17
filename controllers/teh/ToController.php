<?php
/**
 * Created by PhpStorm.
 * User: Inter
 * Date: 08.06.2018
 * Time: 12:12
 */

namespace app\controllers\teh;

use yii\web\Controller;
use app\models\teh\to\ToEquipm;
use Yii;
use app\models\teh\to\To;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class ToController extends Controller
{

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['POST'],
            ],
        ],
    ];
  }

  public function actionIndex()
  {
    $model = new ToEquipm();
    return $this->render('index', [
        'tos' => $model->find()->all(),
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
      if ($model->save(false)) {
        return $this->redirect(['/teh/to/to-schedule/view', 'id' => $model->scheld_id]);
      } else {
        Yii::$app->session->setFlash('error', 'Изменения не внесены');
      }
    }

    return $this->render('update', [
        'model' => $model,
    ]);
  }


  public function actionDelete($id)
  {
    $this->findModel($id)->delete();

    return $this->redirect(['index']);
  }


  protected function findModel($id)
  {
    if (($model = To::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }


  /**
   * Creates a new To model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new To();
    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }
    return $this->render('create', [
        'model' => $model,
    ]);
  }

}