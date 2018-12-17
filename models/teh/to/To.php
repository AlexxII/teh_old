<?php

namespace app\models\teh\to;

use app\models\teh\people\employees\Employees;
use app\models\teh\people\users\User;
use app\models\teh\tool\Tool;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "to_tbl".
 *
 * @property int $id
 * @property int $eq_id
 * @property string $to_type
 * @property string $plan_date
 * @property string $fact_date
 * @property int $checkmark
 * @property string $date_in
 */
class To extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'to_tbl';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['to_equip_id', 'to_type', 'plan_date', 'admin_id', 'auditor_id'], 'required'],
        [['to_equip_id'], 'integer'],
        [['plan_date', 'to_month', 'fact_date'], 'date', 'format' => 'yyyy-M-d'],
        [['date_in',  'scheld_id', 'checkmark' ], 'safe'],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => 'ID',
        'to_equip_id' => 'Наименование оборудования:',
        'to_type' => 'Вид ТО:',
        'plan_date' => 'Дата проведения (план.):',
        'fact_date' => 'Дата проведения (факт.):',
        'checkmark' => 'Отметка о проведении:',
        'date_in' => 'Дата добавления:',
        'month' => 'Месяц',
        'admin_id' => 'Ответственный за проведение',
        'auditor_id' => 'Ответственный за контроль'
    ];
  }

  public function getToEq()
  {
    return $this->hasOne(ToEquipm::class, ['id' => 'to_equip_id']);
  }

  public function getToolList()
  {
    return ArrayHelper::map(Tool::find()->with('complex')->all(), 'id', 'titleSerial');
  }

  public function getToEquipmentList()
  {
    return ArrayHelper::map(ToEquipm::find()->all(), 'id', 'eq_title');
  }

  public function getToList($i = null)
  {
    require "to_array.php";
    if ($i == null) {
      return $to_kind;
    }
    return $to_kind[$i];
  }

  public function getAdminList()
  {
    return ArrayHelper::map(User::find()->where(['employer' => 1])->all(), 'id', 'name');
  }

  public function getAdmin()
  {
    return $this->hasOne(User::class, ['id' => 'admin_id']);
  }

  public function getAdminCtrl()
  {
    return $this->hasOne(User::class, ['id' => 'auditor_id']);
  }

  public  function getMonth()
  {
    return 111111;
  }
}
