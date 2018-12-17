<?php

namespace app\controllers\teh\people;

use Yii;
use app\models\teh\people\labor\PeopleLaborTitle;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LaborTitleController implements the CRUD actions for PeopleLaborTitle model.
 */
class LaborTitleController extends Controller
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
     * Lists all PeopleLaborTitle models.
     * @return mixed
     */
    public function actionIndex()
    {
      $models = PeopleLaborTitle::find()->all();
      return $this->render('index', [
          'models' => $models,
      ]);
    }

    /**
     * Creates a new PeopleLaborTitle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PeopleLaborTitle();

        if ($model->load(Yii::$app->request->post())) {
          if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно добавлена');
            return $this->redirect(['index']);
          } else {
            Yii::$app->session->setFlash('error', '<strong>Ошибка! </strong>Запись не добавлена. Ошибка валидации.');
          }
        } Yii::$app->session->setFlash('error', '<strong>Ошибка! </strong>Запись не добавлена. Ошибка валидации.');
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PeopleLaborTitle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PeopleLaborTitle model.
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
     * Finds the PeopleLaborTitle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PeopleLaborTitle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PeopleLaborTitle::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
