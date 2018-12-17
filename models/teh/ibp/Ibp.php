<?php

namespace app\models\teh\ibp;


use app\models\teh\battery\Battery;
use app\models\teh\paks\Paks;
use app\models\teh\place\Place;
use app\models\teh\tool\Tool;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Ibp extends ActiveRecord
{
  public static function tableName()
  {
    return 'ibp_tbl';
  }

  public function attributeLabels()
  {
    return [
        'parent_id' => 'Входит в состав:',
        'bat_id' => 'Тип АКБ',
        'num_of_bat' => 'Кол-во АКБ:',
        'num_of_use' => 'Кол-во потребителей:',
        'bat_in' => 'Батарея внутри',
    ];
  }

  public function rules()
  {
    return [
        [['bat_id', 'bat_in', 'break', 'tool_id', 'parent_id'], 'safe'],
        [['num_of_bat'], 'integer', 'max' => 10],
        [['num_of_use'], 'integer', 'max' => 10]
    ];
  }

  public function getPakList()
  {
    return ArrayHelper::map(Paks::find()->all(), 'id', 'pak_title');
  }

  public function getPlaceList()
  {
    return ArrayHelper::map(Place::find()->all(), 'id', 'place_title');
  }

  public function getBatteryList()
  {
    return ArrayHelper::map(Battery::find()->with('tool')->all(), 'id', 'bat_type', 'tool.tool_manufact');
  }

  public function getTool()
  {
    return $this->hasOne(Tool::class, ['id' => 'tool_id']);
  }

  public function getBattery()
  {
    return $this->hasOne(Battery::class, ['id' => 'bat_id']);
  }

}