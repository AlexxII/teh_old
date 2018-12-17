<?php

namespace app\controllers\teh\people;

use Yii;
use app\models\teh\people\users\User;
use yii\web\Controller;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UsersController extends Controller
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
   * Lists all User models.
   * @return mixed
   */
  public function actionIndex()
  {
    $user = User::find()->all();
    return $this->render('index', [
        'user' => $user,
    ]);
  }

  /**
   * Creates a new User model.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new User();
    if ($model->load(Yii::$app->request->post())) {
      if ($model->saveEx()) {
        if (Yii::$app->request->post('ch-stay')) {
          if (!isset(Yii::$app->request->cookies['ch-stay'])) {
            Yii::$app->response->cookies->add(new Cookie([
                'name' => 'ch-stay',
                'value' => '1'
            ]));
          }
          return $this->redirect(['create']);
        } else {
          Yii::$app->response->cookies->remove('ch-stay');
          return $this->redirect(['index']);
        }
      } else {
        Yii::$app->session->setFlash('error', '<strong>Ошибка! </strong>Пользователь не добавлен');
      }
    }
    return $this->render('create', [
        'model' => $model,
    ]);
  }

  /**
   * Updates an existing User model.
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
   * Deletes an existing User model.
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
   * Finds the User model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return User the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = User::findOne($id)) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
