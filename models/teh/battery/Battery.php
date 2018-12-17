<?php

namespace app\models\teh\battery;


use app\models\teh\tool\Tool;
use yii\db\ActiveRecord;
use app\models\teh\Photo;

class Battery extends ActiveRecord
{
  public static function tableName()
  {
    return 'battery_tbl';
  }

  public function attributeLabels()
  {
    return [
        'bat_type' => 'U и A:',
        'bat_size' => 'Типоразмер:',
    ];
  }

  public function rules()
  {
    return [
        [['bat_type', 'bat_size'], 'required'],
        [['tool_id'], 'integer'],
        [['bat_type', 'bat_size'], 'string', 'max' => 100, 'tooLong' => 'Не более 30 символов'],
    ];
  }

  public function getPhotos()
  {
    return $this->hasMany(Photo::class, ['eq_id' => 'id']);
  }

  public function getTool()
  {
    return $this->hasOne(Tool::class, ['id' => 'tool_id']);
  }

}