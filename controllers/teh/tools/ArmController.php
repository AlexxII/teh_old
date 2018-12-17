<?php


namespace app\controllers\teh\tools;


use app\base\MHelper;
use app\models\teh\complex\Complex;
use app\models\teh\complex\ComplexSearch;
use app\models\teh\Photo;
use app\models\teh\tool\Tool;
use app\models\UploadForm;
use Yii;
use app\base\Model;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;


/**
* DynamicformDemo1Controller implements the CRUD actions for Customer model.
*/

class ArmController extends Controller

{

  /**
  * Lists all Customer models.
  * @return mixed
  */

/*  public function actionIndex()
  {
    $searchModel = new ComplexSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    return $this->render('index', [
      'searchModel' => $searchModel,
      'dataProvider' => $dataProvider,
    ]);
  }*/

/*  public function actionIndex()
  {
    $sql = "SELECT complex_tbl.id, complex_title, pak_title,
                    cat_title, user.name, ip, complex_tbl.soft_version, 
                    group_concat(DISTINCT tool_tbl.tool_title ORDER BY tool_tbl.id SEPARATOR '<br>') as tool_title
                  FROM complex_tbl LEFT JOIN category ON complex_tbl.category_id = category.id
                    LEFT JOIN pak_tbl on parent_id = pak_tbl.id
                    LEFT JOIN tool_tbl on complex_tbl.id = tool_tbl.parent_id
                    LEFT JOIN user on user_id = user.id WHERE complex_tbl.category_id != 38 GROUP BY complex_title";
    $arms = Complex::findBySql($sql)->asArray()->all();
    return $this->render('index', [
        'arms' => $arms,
    ]);
  }*/

  public function actionIndex()
  {
    $arms = Complex::find()->where(['!=', 'category_id', 38])->all();
    return $this->render('index', [
        'arms' => $arms,
    ]);
  }

  /**
  * Displays a single Customer model.
  * @param integer $id
  * @return mixed
  */

  public function actionView($id)
  {
    $model = $this->findModel($id);
    $modelsTool = $model->tools;
//    var_dump($modelsTool);
    return $this->render('view', [
      'modelComplex' => $model,
      'modelsTool' => $modelsTool,
    ]);
  }


  /**
  * Creates a new Customer model.
  * If creation is successful, the browser will be redirected to the 'view' page.
  * @return mixed
  */

  public function actionCreate()
  {
    $modelComplex = new Complex;
    $modelsTool = [new Tool];
    $fUpLoad = [new Photo];

    if ($modelComplex->load(Yii::$app->request->post())) {
      $modelsTool = Model::createMultiple(Tool::class);
      Model::loadMultiple($modelsTool, Yii::$app->request->post());

      // validate all models
      $valid = $modelComplex->validate();
      $valid = Model::validateMultiple($modelsTool) && $valid;

      if ($valid) {
        $transaction = Yii::$app->db->beginTransaction();
        try {
          if ($flag = $modelComplex->save(false)) {
            foreach ($modelsTool as $index => $modelTool) {
              $modelTool->parent_id = $modelComplex->id;          //  наследует от родителя
              $modelTool->pak_id = $modelComplex->parent_id;      //  наследует от родителя
              if (!($flag = $modelTool->save(false))) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Оборудование не добавлено');
                break;
              }
              if (!empty(Yii::$app->request->post('Photo', []))) {
                $fUpLoad = new Photo();
                $fUpLoad->imageFiles = UploadedFile::getInstances($fUpLoad, "[{$index}]imageFiles");
                if ($fUpLoad->uploadImage($modelTool->id)) {
                  Yii::$app->session->setFlash('succes', 'Оборудование добавлено!');
                } else {
                  Yii::$app->session->setFlash('error', 'Оборудование добавлено, но не загружены изображения');
                }
              } else {
                Yii::$app->session->setFlash('success', 'Оборудование добавлеНООООО');
              }
            }
          }
          if ($flag) {
            $transaction->commit();
            return $this->redirect(['view', 'id' => $modelComplex->id]);
          }
        } catch (Exception $e) {
          Yii::$app->session->setFlash('error', 'Оборудование не добавлено');
          $transaction->rollBack();
        }
      } else {
        Yii::$app->session->setFlash('error', 'Что-то с валидностью данных');
      }
    }
    return $this->render('create', [
        'modelComplex' => $modelComplex,
        'modelsTool' => (empty($modelsTool)) ? [new Tool] : $modelsTool,
        'fUpload' => (empty($fUpLoad)) ? [new Photo] : $fUpLoad,
    ]);
  }


  /**
  * Updates an existing Customer model.
  * If update is successful, the browser will be redirected to the 'view' page.
  * @param integer $id
  * @return mixed
  */

  public function actionUpdate($id)
  {
    $modelComplex = $this->findModel($id);
    $modelsTool = $modelComplex->tools;
    $fupload = [new Photo()];

    if ($modelComplex->load(Yii::$app->request->post())) {
      $oldIDs = ArrayHelper::map($modelsTool, 'id', 'id');
      $modelsTool = Model::createMultiple(Tool::class, $modelsTool);
      Model::loadMultiple($modelsTool, Yii::$app->request->post());
      $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsTool, 'id', 'id')));

      // validate all models

      $valid = $modelComplex->validate();
      $valid = Model::validateMultiple($modelsTool) && $valid;

      if ($valid) {
        $transaction = Yii::$app->db->beginTransaction();
        try {
          if ($flag = $modelComplex->save(false)) {
            if (!empty($deletedIDs)) {
              Tool::deleteAll(['id' => $deletedIDs]);
            }
            foreach ($modelsTool as $index => $modelTool) {
              $modelTool->parent_id = $modelComplex->id;
              if (!($flag = $modelTool->save(false))) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Оборудование не добавлено');
                break;
              }
              if (!empty(Yii::$app->request->post('Photo', []))) {
                $fUpLoad = new Photo();
                $fUpLoad->imageFiles = UploadedFile::getInstances($fUpLoad, "[{$index}]imageFiles");
                if ($fUpLoad->uploadImage($modelTool->id)) {
                  Yii::$app->session->setFlash('succes', 'Оборудование добавлено');
                } else {
                  Yii::$app->session->setFlash('error', 'Оборудование добавлено, но не загружены изображения');
                }
              } else {
                Yii::$app->session->setFlash('success', 'Оборудование добавлено');
              }
            }
          }
          if ($flag) {
            $transaction->commit();
            return $this->redirect(['view', 'id' => $modelComplex->id]);
          }
        } catch (Exception $e) {
          $transaction->rollBack();
          Yii::$app->session->setFlash('error', 'Оборудование не добавлено');
        }
      }
    }
    return $this->render('update', [
        'modelComplex' => $modelComplex,
        'modelsTool' => (empty($modelsTool)) ? [new Tool()] : $modelsTool,
        'fUpload' => (empty($fUpLoad)) ? [new Photo] : $fUpLoad,
    ]);
  }

  /**

  * Deletes an existing Customer model.
  * If deletion is successful, the browser will be redirected to the 'index' page.
  * @param integer $id
  * @return mixed
  */

  public function actionDelete($id, $all = 0)
  {
    $model = $this->findModel($id);

    if ($model->delete()) {
      if ($all == 1) {
        foreach ($model->tools as $tool) {
          $photos = $tool->photos;
          foreach ($photos as $photo) {
            unlink(\Yii::$app->params['uploadPath'] . $photo->photo_path);
            $photo->delete();
          }
//          Photo::deleteAll(['eq_id' => $tool->id]);
          $tool->delete();
        }
        Yii::$app->session->setFlash('success', 'Запись успешно удалена с компонентами');
      } else {
        Yii::$app->session->setFlash('success', 'Запись успешно удалена, без компонентов');
      }
    }
    return $this->redirect(['index']);
  }


  /**
  * Finds the Customer model based on its primary key value.
  * If the model is not found, a 404 HTTP exception will be thrown.
  * @param integer $id
  * @return Complex the loaded model
  * @throws NotFoundHttpException if the model cannot be found
  */

  protected function findModel($id)
  {
    if (($model = Complex::findOne($id)) !== null) {
      return $model;
    } else {
      throw new NotFoundHttpException('Запрошенная страница не существует.');
    }
  }

}