<?php

namespace app\controllers\teh\to;

use app\models\teh\people\labor\PeopleLaborStatus;
use app\models\teh\to\ToEquipm;
use Yii;
use app\models\teh\to\To;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\base\Model;

/**
 * ToqController implements the CRUD actions for To model.
 */
class ToScheduleController extends Controller
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
   * Displays a single To model.
   * @param integer $id
   * @return mixed
   * @throws NotFoundHttpException if the model cannot be found
   */

  public function actionView($id)
  {
    $model = To::find()->where(['scheld_id' => $id]);
    $month = $model->max('plan_date');
    setlocale(LC_ALL, 'ru_RU');
    $month = strftime("%B %Y", strtotime($month));
    $tos = $model->all();
    return $this->render('view', [
        'tos' => $tos,
        'month' => $month,
        'id' => $id
    ]);
  }

  public function actionUpdate($id)
  {
    $models = $this->findModel($id)->all();

    if (Model::loadMultiple($models, Yii::$app->request->post())) {
      if (\yii\base\Model::validateMultiple($models)) {
        $count = 0;
        foreach ($models as $model) {
          if ($model->save()) {
            $count++;
          }
        }
        Yii::$app->session->setFlash('success', "Обновлено {$count} записей.");
        return $this->redirect(['index']);
      } else {
        Yii::$app->session->setFlash('error', "Данные не прошли валидацию");
        return $this->render('update', [
            'tos' => $models,
        ]);
      }
    } else {
      return $this->render('update', [
          'tos' => $models,
      ]);
    }
  }

  /**
   * Lists all To models.
   * @return mixed
   */
  public function actionIndex()
  {
    $sql = "SELECT to_tbl.id, to_tbl.plan_date, to_tbl.scheld_id,
              GROUP_CONCAT(DISTINCT to_tbl.checkmark ORDER BY to_tbl.checkmark ASC SEPARATOR ', ') as checkmark,
              GROUP_CONCAT(DISTINCT t1.name ORDER BY t1.name ASC SEPARATOR ', ') as admins,
              GROUP_CONCAT(DISTINCT t2.name ORDER BY t2.name ASC SEPARATOR ', ') as auditors,
              GROUP_CONCAT(DISTINCT to_tbl.to_type ORDER BY to_tbl.to_type ASC SEPARATOR ', ') as to_type
            from to_tbl
              LEFT JOIN people_user t1 on to_tbl.admin_id = t1.id
              LEFT JOIN people_user t2 on to_tbl.auditor_id = t2.id
            GROUP BY scheld_id";
    return $this->render('index', [
        'tos' => To::findBySql($sql)->asArray()->all(),
        'month' => 1
    ]);
  }

//=====================================================================

// создание нового графика ТО на основе оборудования в таблице toequip_tbl;
  public function actionCreate()
  {
    $tos = ToEquipm::find()->where(['active' => 1])->all();
    if (empty($tos)) {
      Yii::$app->session->setFlash('error', "Не добавлено ни одного оборудования в график ТО. Воспользуйтесь формой добавления.");
      return $this->render('create', [
          'tos' => $tos,
      ]); // redirect to your next desired page
    }
    $scheduleRand = rand();
    foreach ($tos as $i => $to) {
      $toss[] = new To();
      $toss[$i]->to_equip_id = $to->id;
      $toss[$i]->scheld_id = $scheduleRand;
    }
    if (To::loadMultiple($toss, Yii::$app->request->post())) {
      if (!$to_month = Yii::$app->request->post('month')) {
        Yii::$app->session->setFlash('error', "Введите месяц проведения ТО");
        return $this->render('create', ['tos' => $toss]);
      }
      if (To::validateMultiple($toss)) {
        foreach ($toss as $t) {
          $t->to_month = $to_month;
          $t->save();
        }
      } else {
        Yii::$app->session->setFlash('error', "Ошибка валидации данных");
        return $this->render('create', ['tos' => $toss]);
      }
      Yii::$app->session->setFlash('success', "Новый график ТО создан успешно");
      return $this->redirect('index'); // redirect to your next desired page
    } else {
      return $this->render('create', [
          'tos' => $toss,
      ]);
    }
  }

// Отметка о выполнении графика ТО на выбранный месяц
  public function actionPerform($id)
  {
    $models = $this->findModel($id)->all();
    $month = $models[0]->to_month;

    if (To::loadMultiple($models, Yii::$app->request->post())) {
      if (To::validateMultiple($models)) {
        foreach ($models as $t) {
          if ($t->fact_date != null) {
            $t->checkmark = '1';
          } else {
            $t->checkmark = '0';
          }
          $t->save();
        }
      } else {
        Yii::$app->session->setFlash('error', "Ошибка валидации данных");
        return $this->render('perform', [
            'tos' => $models,
            'month' => $month,
        ]);
      }
      Yii::$app->session->setFlash('success', "Отметки о проведении ТО проставлены");
      return $this->redirect('index');
    }
    return $this->render('perform', [
        'tos' => $models,
        'month' => $month,
    ]);
  }




  //ответ на ajax запрос о выходных и праздничных днях
  public function actionFreeDays($start_date, $end_date)
  {
    $sql = 'SELECT people_labor_status.people_id, people_labor_status.free_date as free_dates,
              people_labor_status.comment,
              people_labor_title.title as labor_title
            from people_labor_status
              LEFT JOIN people_labor_title on people_labor_status.labor_title = people_labor_title.id
            WHERE free_date >= :start_date
            and free_date <=:end_date ORDER BY people_id, free_date';
    $ar = Yii::$app->db->createCommand($sql)
      ->bindValue(':start_date', $start_date)
      ->bindValue('end_date', $end_date)
      ->queryAll();
    return json_encode($ar);
  }

  //отпуска и отгулы сотрудников
  public function actionPeopleFreedays()
  {
    $ar = PeopleLaborStatus::find()->select('free_date')->asArray()->all();
    return json_encode($ar);
  }

  //отпуска и отгулы сотрудников
  public function actionPeopleFreed()
  {
    $ar = PeopleLaborStatus::find()->select('free_date')->asArray()->all();
    return json_encode($ar);
  }




  protected function findModel($id)
  {
    if (($model = To::find()->where(['scheld_id' => $id])) !== null) {
      return $model;
    }
    throw new NotFoundHttpException('Запрошенная страница не существует.');
  }

  public function actionDelete($id)
  {
    $models = To::find()->where(['scheld_id' => $id])->all();
    foreach ($models as $m) {
      $m->delete();
    }
    Yii::$app->session->setFlash('success', 'График успешно удален');
    return $this->redirect(['index']);
  }

}
