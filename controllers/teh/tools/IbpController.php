<?php

namespace app\controllers\teh\tools;

use app\models\teh\Photo;
use app\models\teh\tool\Tool;
use app\models\UploadForm;
use Yii;
use app\models\teh\ibp\Ibp;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * IbpController implements the CRUD actions for Ibp model.
 */
class IbpController extends Controller
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
     * Lists all Ibp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $ibp = new Ibp();
        return $this->render('index', [
            'ibp' => $ibp->find()->all(),
        ]);
    }

    /**
     * Displays a single Ibp model.
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
     * Creates a new Ibp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $modelIbp = new Ibp();
      $modelTool = new Tool();
      $fUpLoad = new Photo();

      if ($modelTool->load(Yii::$app->request->post()) && $modelIbp->load(Yii::$app->request->post())) {
        $modelTool->category_id = 129;                   // Категория - Источники бесперебойного питания
        $modelTool->tool_title = 'ИБП';
        $modelIbp->parent_id = $modelTool->parent_id;

        if ($modelTool->validate() && $modelIbp->validate()){
          $transaction = Yii::$app->db->beginTransaction();
          try {
            if (!($flag = $modelTool->save(false))) {
              $transaction->rollBack();
              Yii::$app->session->setFlash('error', 'Оборудование не добавлено');
            }
            $modelIbp->tool_id = $modelTool->id;
            if (!($flag = $modelIbp->save(false))) {
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
              return $this->redirect(['view', 'id' => $modelIbp->id]);
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
          'modelIbp' => $modelIbp,
          'fupload' => $fUpLoad
      ]);
    }

    /**
     * Updates an existing Ibp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
      $modelIbp = $this->findModel($id);
      $modelTool = $modelIbp->tool;
      $fUpLoad = new Photo;

      if ($modelTool->load(Yii::$app->request->post()) && $modelIbp->load(Yii::$app->request->post())) {
        $modelTool->category_id = 129;                   // Категория - Источники бесперебойного питания
        $modelTool->tool_title = 'ИБП';
        $modelIbp->parent_id = $modelTool->parent_id;

        if ($modelTool->validate() && $modelIbp->validate()){
          $transaction = Yii::$app->db->beginTransaction();
          try {
            if (!($flag = $modelTool->save(false))) {
              $transaction->rollBack();
              Yii::$app->session->setFlash('error', 'Изменения внесены');
            }
            $modelIbp->tool_id = $modelTool->id;
            if (!($flag = $modelIbp->save(false))) {
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
              return $this->redirect(['view', 'id' => $modelIbp->id]);
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
          'modelTool' => $modelTool,
          'modelIbp' => $modelIbp,
          'fupload' => $fUpLoad
      ]);
    }

    /**
     * Deletes an existing Ibp model.
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
        if(Photo::find()->where(['photo_path' => $pp])->count() == 1) {
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
     * Finds the Ibp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ibp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ibp::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
