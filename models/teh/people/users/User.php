<?php

namespace app\models\teh\people\users;


use app\models\teh\people\positions\Positions;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class User extends ActiveRecord
{

  public static function tableName()
  {
    return '{{%people_user}}';
  }

  public function attributeLabels()
  {
    return [
        'name' => 'Имя пользователя',
        'position' => 'Должность',
        'employer' => 'Сотрудники СпецСвязи'
    ];
  }

  public function rules()
  {
    return [
        [['name', 'employer'], 'required'],
        [['name','position'], 'trim'],
    ];
  }


  public function saveEx()
  {
    if ($this->positions->parent == 3) {
      $this->employer = 0;
    } else {
      $this->employer = 1;
    }
    $this->save(false);
    return true;
  }

  public function getPositions()
  {
    return $this->hasOne(Positions::class, ['id' => 'position']);
  }

  public function getPositionsList()
  {
    $ar['Абоненты'] = ArrayHelper::map(Positions::find()->where(['parent' => 3])->asArray()->all(), 'id', 'title');
    $ar['Сотрудники'] = ArrayHelper::map(Positions::find()->where(['parent' => 1])->asArray()->all(), 'id', 'title');
    return $ar;

//    return ArrayHelper::map(Positions::find()->where(['!=', 'parent', 0])->asArray()->all(), 'id', 'title', 'parent');
  }


}