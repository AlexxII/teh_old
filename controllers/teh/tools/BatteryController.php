<?php

namespace app\controllers\teh\tools;

use app\models\teh\Photo;
use app\models\teh\tool\Tool;
use app\models\UploadForm;
use Yii;
use app\models\teh\battery\Battery;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BatteryController implements the CRUD actions for Battery model.
 */
class BatteryController extends Controller
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
   * Lists all Battery models.
   * @return mixed
   */
  public function actionIndex()
  {
    $battery = Battery::find()->all();
    return $this->render('index', [
        'battery' => $battery,
    ]);
  }

  /**
   * Displays a single Battery model.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionView($id)
  {
    $fupload = Photo::find()->where(['id' => $id])->asarray()->all();
    return $this->render('view', [
        'model' => $this->findModel($id),
    ]);
  }

  /**
   * Creates a new Battery model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $modelBattery = new Battery();
    $modelTool = new Tool();
    $fUpLoad = new Photo();

    if ($modelTool->load(Yii::$app->request->post()) && $modelBattery->load(Yii::$app->request->post())) {
      $modelTool->category_id = 130;                   // Категория - АКБ и элементы питания
      $modelTool->tool_title = 'Элемент питания';      //необходимо задать или АКБ или элемент питания
      $modelTool->tool_model = $modelBattery->bat_type;
      $modelTool->tool_model_ex = $modelBattery->bat_size;

      if ($modelTool->validate() && $modelBattery->validate()) {
        $transaction = Yii::$app->db->beginTransaction();
        try {
          if (!($flag = $modelTool->save(false))) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', 'Оборудование не добавлено');
          }
          $modelBattery->tool_id = $modelTool->id;
          if (!($flag = $modelBattery->save(false))) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', 'Оборудование не добавлено');
          }
          if ($fUpLoad->load(Yii::$app->request->post())) {
            $fUpLoad->imageFiles = UploadedFile::getInstances($fUpLoad, 'imageFiles');
            if ($fUpLoad->uploadImage($modelTool->id)) {
              Yii::$app->session->setFlash('success', 'Оборудование добавлено');
            } else {
              Yii::$app->session->setFlash('error', 'Оборудование добавлено, но не загружены изображения');
            }
          } else {
            Yii::$app->session->setFlash('success', 'Оборудование добавлено');
          }
          if ($flag) {
            $transaction->commit();
            return $this->redirect(['view', 'id' => $modelBattery->id]);
          }
        } catch (Exception $e) {
          Yii::$app->session->setFlash('error', 'Оборудование не добавлено');
          $transaction->rollBack();
        }
      } else {
        Yii::$app->session->setFlash('error', 'Оборудование НЕ добавлено');
      }
    }
    return $this->render('create', [
        'modelTool' => $modelTool,
        'modelBattery' => $modelBattery,
        'fupload' => $fUpLoad
    ]);
  }

  /**
   * Updates an existing Battery model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionUpdate($id)
  {
    $modelBattery = $this->findModel($id);
    $modelTool = $modelBattery->tool;
    $fUpLoad = new Photo();

    if ($modelTool->load(Yii::$app->request->post()) && $modelBattery->load(Yii::$app->request->post())) {
      if ($modelTool->validate() && $modelBattery->validate()) {
        $transaction = Yii::$app->db->beginTransaction();
        try {
          if (!($flag = $modelTool->save(false))) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', 'Изменения не внесены');
          }
          $modelBattery->tool_id = $modelTool->id;
          if (!($flag = $modelBattery->save(false))) {
            $transaction->rollBack();
            Yii::$app->session->setFlash('error', 'Изменения не внесены');
          }
          if ($fUpLoad->load(Yii::$app->request->post())) {
            $fUpLoad->imageFiles = UploadedFile::getInstances($fUpLoad, 'imageFiles');
            if ($fUpLoad->uploadImage($modelTool->id)) {
              Yii::$app->session->setFlash('success', 'Изменения внесены');
            } else {
              Yii::$app->session->setFlash('error', 'Изменения внесены, но не загружены изображения');
            }
          } else {
            Yii::$app->session->setFlash('success', 'Изменения внесены');
          }
          if ($flag) {
            $transaction->commit();
            return $this->redirect(['view', 'id' => $modelBattery->id]);
          }
        } catch (Exception $e) {
          Yii::$app->session->setFlash('error', 'Изменения не внесены');
          $transaction->rollBack();
        }
      } else {
        Yii::$app->session->setFlash('error', 'Изменения НЕ внесены');
      }
    }
    return $this->render('update', [
        'model' => $modelBattery,
        'modelTool' => $modelTool,
        'fupload' => $fUpLoad,
    ]);
  }

  /**
   * Deletes an existing Battery model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */
  public function actionDelete($id)
  {
    $model = $this->findModel($id);
    $tool = $model->tool;
    $photos = $tool->photos;
    foreach ($photos as $photo) {
      $pp = $photo->photo_path;
      if (Photo::find()->where(['photo_path' => $pp])->count() == 1) {
        unlink(\Yii::$app->params['uploadPath'] . $photo->photo_path);
      }
      $photo->delete();
    }
    $tool->delete();
    $model->delete();
    Yii::$app->session->setFlash('success', 'Оборудование удалено');
    return $this->redirect(['index']);
  }


  /**
   * Finds the Battery model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Battery the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Battery::findOne($id)) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('The requested page does not exist.');
  }
}
