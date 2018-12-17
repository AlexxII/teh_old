<?php

namespace app\models\teh\to;

use app\models\teh\tool\Tool;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "to_tbl".
 *
 * @property int $id
 * @property int $eq_id
 * @property string $eq_title
 * @property string $order
 */

// модель управляет таблицей БД в которой записано оборудование
// специальной связи для которого выполняется ТО.

class ToEquipm extends \yii\db\ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'to_equip_tbl';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['eq_id', 'eq_title'], 'required'],
        [['eq_id'], 'integer'],
        [['order', 'active', 'created', 'updated'], 'safe'],

    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => 'ID',
        'eq_title' => 'Наименование оборудования:',
        'eq_id' => 'Оборудование:',
        'order' => 'Порядок:',
        'active' => 'Проводится ТО',
        'created' => 'Создано',
        'updated' => 'Обновлено'
    ];
  }

  public function getTool()
  {
    return $this->hasOne(Tool::class, ['id' => 'eq_id']);
  }

  public function getToolList()
  {
    return ArrayHelper::map(Tool::find()->with('complex')->all(), 'id', 'titleSerial');
  }

}
