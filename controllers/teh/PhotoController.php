<?php

namespace app\controllers\teh;

use Yii;
use app\models\teh\Photo;
use app\models\PhotoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PhotoController implements the CRUD actions for Photo model.
 */
class PhotoController extends Controller
{
  /**
   * @inheritdoc
   */
  /*    public function behaviors()
      {
          return [
              'verbs' => [
                  'class' => VerbFilter::className(),
                  'actions' => [
                      'delete' => ['POST'],
                  ],
              ],
          ];
      }*/

  /**
   * Lists all Photo models.
   * @return mixed
   */
  /*    public function actionIndex()
      {
          $searchModel = new PhotoSearch();
          $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

          return $this->render('index', [
              'searchModel' => $searchModel,
              'dataProvider' => $dataProvider,
          ]);
      }*/

  public function actionIndex()
  {
    $ibp = new Photo();
    return $this->render('index', [
        'photos' => $ibp->find()->all(),
    ]);
  }

  /**
   * Displays a single Photo model.
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
   * Creates a new Photo model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Photo();
    if ($model->load(Yii::$app->request->post())) {
      $model->imageFiles = UploadedFile::getInstances($model, "imageFiles");
      if ($id = $model->uploadImage($model->eq_id)) {
        return $this->redirect(['view', 'id' => $id]);
      }
    }
    return $this->render('create', [
        'model' => $model,
    ]);
  }

  /**
   * Updates an existing Photo model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $model = $this->findModel($id);

    if ($model->load(Yii::$app->request->post())) {
      $model->imageFiles = UploadedFile::getInstances($model, "imageFiles");
      if ($model->uploadImage($model->eq_id)) {
        return $this->redirect(['view', 'id' => $model->id]);
      }
    }
    return $this->render('update', [
        'model' => $model,
    ]);
  }

  /**
   * Deletes an existing Photo model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $photo = $this->findModel($id);
    $pp = \Yii::$app->params['uploadPath'] . $photo->photo_path;
    if (file_exists($pp)){
      if(Photo::find()->where(['photo_path' => $pp])->count() == 1) {
        unlink(\Yii::$app->params['uploadPath'] . $photo->photo_path);
      }
    }
    $photo->delete();
    Yii::$app->session->setFlash('success', 'Изображение удалено');
    return $this->redirect(['index']);
  }

  /**
   * Finds the Photo model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Photo the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Photo::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('Запрошенная Вами страница не существует.');
  }
}
