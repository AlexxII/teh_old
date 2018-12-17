<?php

namespace app\models\teh\paks;


use app\models\teh\people\employees\Employees;
use app\models\teh\people\users\User;
use function React\Promise\all;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Paks extends ActiveRecord
{
  public static function tableName()
  {
    return 'pak_tbl';
  }

  public function attributeLabels()
  {
    return [
        'pak_title' => 'Наименование:',
        'pak_admin' => 'Ответственный:',
        'pak_ext' => 'Расширение:',
    ];
  }

  public function rules()
  {
    return [
        [['pak_title', 'pak_ext'], 'required'],
        [['pak_title'], 'trim'],
        [['pak_admin'], 'safe'],
        [['pak_title'], 'string', 'max' => 50, 'tooLong' => 'Наименование не должено превышать 50 символов'],
    ];
  }

  public function getAdminList()
  {
    return ArrayHelper::map(User::find()->where(['employer' => 1])->all(), 'id', 'name');
  }

  public function getAdmin()
  {
    return $this->hasOne(User::class, ['id' => 'pak_admin']);
  }

  public static function PakList()
  {
    $sql = 'SELECT pak_tbl.id, pak_title, name FROM pak_tbl LEFT JOIN people_user ON pak_tbl.pak_admin = people_user.id';
    return ArrayHelper::map(Paks::findBySql($sql)->asArray()->all(), 'id', 'pak_title', 'name');
  }

}