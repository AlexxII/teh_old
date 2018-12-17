<?php

namespace app\controllers\teh\tools;

use app\models\teh\Photo;
use app\models\UploadForm;
use Yii;
use app\models\teh\tool\Tool;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ToolController implements the CRUD actions for Tool model.
 */
class ToolController extends Controller
{
  /**
   * @inheritdoc
   */
  /*    public function behaviors()
      {
          return [
              'verbs' => [
                  'class' => VerbFilter::class,
                  'actions' => [
                      'delete' => ['POST'],
                  ],
              ],
          ];
      }*/

  /**
   * Lists all Tool models.
   * @return mixed
   */
  /*    public function actionIndex()
      {
          $tools = new Tool();
          return $this->render('index', [
              'tool' => $tools->showTools(),
          ]);
      }*/

  public function actionIndex()
  {
    $tools = Tool::find()->all();
    return $this->render('index', [
        'tool' => $tools,
    ]);
  }

  /**
   * Displays a single Tool model.
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
   * Creates a new Tool model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Tool();
    $fUpLoad = new Photo();

    if ($model->load(Yii::$app->request->post())) {

      if ($model->save()) {
        if ($fUpLoad->load(Yii::$app->request->post())) {
          $fUpLoad->imageFiles = UploadedFile::getInstances($fUpLoad, 'imageFiles');
          if ($fUpLoad->uploadImage($model->id)) {
            Yii::$app->session->setFlash('success', 'Оборудование добавлено');
          } else {
            Yii::$app->session->setFlash('error', 'Оборудование добавлено, но не загружены изображения');
          }
        } else {
          Yii::$app->session->setFlash('success', 'Оборудование добавлено');
        }
        return $this->redirect(['view', 'id' => $model->id]);
      } else {
        Yii::$app->session->setFlash('error', 'Оборудование НЕ добавлено');
      }
    }
    return $this->render('create', ['model' => $model, 'fupload' => $fUpLoad]);
  }

  /**
   * Updates an existing Tool model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    $fUpLoad = new Photo();

    if ($model->load(Yii::$app->request->post())) {

      if ($model->save()) {
        if ($fUpLoad->load(Yii::$app->request->post())) {
          $fUpLoad->imageFiles = UploadedFile::getInstances($fUpLoad, 'imageFiles');
          if ($fUpLoad->uploadImage($model->id)) {
            Yii::$app->session->setFlash('success', 'Изменения внесены');
          }
        } else {
          Yii::$app->session->setFlash('success', 'Изменения внесены!!');
        }
        return $this->redirect(['view', 'id' => $model->id]);
      } else {
        Yii::$app->session->setFlash('error', 'Изменения НЕ внесены');
      }
    }
    return $this->render('update', [
        'model' => $model,
        'fupload' => $fUpLoad
    ]);
  }

  /**
   * Deletes an existing Tool model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $tool = $this->findModel($id);
    $photos = $tool->photos;
    foreach ($photos as $photo) {
      $pp = $photo->photo_path;
      if(Photo::find()->where(['photo_path' => $pp])->count() == 1) {
        unlink(\Yii::$app->params['uploadPath'] . $photo->photo_path);
      }
      $photo->delete();
    }
    $tool->delete();

    Yii::$app->session->setFlash('success', 'Оборудование удалено');
    return $this->redirect(['index']);
  }

  /**
   * Finds the Tool model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Tool the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Tool::findOne($id)) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }


  public function actionMultiple()
  {
    $equip = Tool::find()->all();

    if (Tool::loadMultiple($equip, Yii::$app->request->post()) &&
        Tool::validateMultiple($equip)) {
      $count = 0;
      foreach ($equip as $e) {
        if ($e->save()) {
          $count++;
        }
      }
      Yii::$app->session->setFlash('success', "Удачно обработано {$count} записей.");
      return $this->render('multiple', ['equip' => $equip]); // redirect to your next desired page
    } else {
      return $this->render('multiple', ['equip' => $equip]);
    }
  }

}
