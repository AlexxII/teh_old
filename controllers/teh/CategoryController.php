<?php

namespace app\controllers\teh;

use Yii;
use app\models\teh\category\Category;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends Controller
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
   * Lists all Category models.
   * @return mixed
   */
  public function actionIndex()
  {
    $sql = 'SELECT C1.id, C1.cat_title, C2.cat_title as parent, C1.custom_order, C2.custom_order as scategory_order from category C1 LEFT JOIN category C2
                  on C1.parent = C2.id WHERE C2.id!=0';
    $category = Category::findBySql($sql)->asarray()->all();
    return $this->render('index', [
        'category' => $category,
    ]);
  }

  /**
   * Displays a single Category model.
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
   * Creates a new Category model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate()
  {
    $model = new Category();

    if ($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['view', 'id' => $model->id]);
    }

    return $this->render('create', [
        'model' => $model,
    ]);
  }

  /**
   * Updates an existing Category model.
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
   * Deletes an existing Category model.
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
   * Finds the Category model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param integer $id
   * @return Category the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
    if (($model = Category::findOne($id)) !== null) {
      return $model;
    }

    throw new NotFoundHttpException('The requested page does not exist.');
  }

//===================== AJAX reodering ========================

  public function actionCategoryOrder()
  {
    $model = new Category();
    $cat = $model->find()->where(['{{category}}.parent' => 0])->all();
    return $this->render('category_order', [
        'model' => $cat,
    ]);
  }

  public function actionCategoryReorder($parent = 38)
  {
    $model = new Category();
    $cat = $model->find()->where(['{{category}}.parent' => $parent])->asArray()->all();
    return json_encode(array('data' => $cat));
  }

  public function actionCategoryOrderAjax()
  {
    if (!empty($_POST['jsonData'])) {
      $postArray = json_decode($_POST['jsonData'], true);
      foreach ($postArray as $ar) {
        $model = Category::find()->where(['id' => $ar['id']])->one();
        $model->custom_order = $ar['order'];
        $model->save();
      }
//      return json_encode($model->custom_order);
      return 'success';
    }
    return false;
  }


}
