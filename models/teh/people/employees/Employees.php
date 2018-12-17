<?php

namespace app\models\teh\people\employees;

use app\models\teh\people\positions\Positions;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $name
 * @property int $position
 * @property int $laborstatus
 * @property int $laborstatusex
 * @property int $active Удален или нет
 */
class Employees extends ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'people_employees';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['name', 'position'], 'required'],
        [['position', 'laborstatus', 'laborstatusex', 'active'], 'integer'],
        [['name'], 'string', 'max' => 250],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => 'ID',
        'name' => 'Имя',
        'position' => 'Должность',
        'laborstatus' => 'Трудовой статус',
        'laborstatusex' => 'Временный трудовой статус',
        'active' => 'Active',
    ];
  }

  public function getPositions()
  {
    return $this->hasOne(Positions::class, ['id' => 'position']);
  }

  public function getPositionsList()
  {
    return ArrayHelper::map(Positions::find()->where(['!=', 'parent', 0])->andWhere(['=', 'parent', 1])->asArray()->all(), 'id', 'title');
  }
}
