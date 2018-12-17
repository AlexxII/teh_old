<?php

namespace app\models\teh\complex;


use app\models\teh\category\Category;
use app\models\teh\paks\Paks;
use app\models\teh\people\employees\Employees;
use app\models\teh\place\Place;
use app\models\teh\tool\Tool;
use app\models\teh\people\users\User;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Complex extends ActiveRecord
{

  public static function tableName()
  {
    return 'complex_tbl';
  }

  public function attributeLabels()
  {
    return [
        'complex_title' => 'Наименование:',
        'parent_id' => 'Входит в состав:',
        'exploitation_date' => 'Дата ввода:',
        'operation_time' => 'Наработка:',
        'place_id' => 'Место нахождения оборудования:',
        'category_id' => 'Категория оборудования:',
        'user_id' => 'Пользователь:',
        'ip' => 'IP адрес:',
        'soft_version' => 'Версия ПО:',
        'break' => "Не исправен",
    ];
  }

  public function rules()
  {
    return [
        [['complex_title', 'parent_id', 'category_id'], 'required'],
        [['soft_version', 'complex_title', 'operation_time'], 'trim'],
        ['factory_date', 'safe'],
        [['user_id', 'break'], 'safe'],
        [['complex_title'], 'string', 'max' => 100, 'tooLong' => 'Не более 100 символов'],
    ];
  }

  public function getPakList()
  {
    return ArrayHelper::map(Paks::find()->asArray()->all(), 'id', 'pak_title', 'pak_ext');
  }

  public function getPlaceList()
  {
    return ArrayHelper::map(Place::find()->asArray()->all(), 'id', 'place_title');
  }

  //===============

  public function getUserList()
  {
    $ar['Абоненты'] = ArrayHelper::map(User::find()->asArray()->all(), 'id', 'name');
    $ar['Сотрудники'] = ArrayHelper::map(Employees::find()->asArray()->all(), 'id', 'name');
    return $ar;
  }

  public static function ParentList()
  {
    $sql = 'SELECT complex_tbl.id, complex_title, place_title from complex_tbl LEFT JOIN place_tbl on complex_tbl.place_id = place_tbl.id';
    return ArrayHelper::map(Complex::findBySql($sql)->asArray()->all(), 'id', 'complex_title', 'place_title');
  }

  public function getCategoryList()
  {
    $sql = 'SELECT id, cat_title from category WHERE parent = 0 AND id != 38 ORDER BY custom_order;';
    return ArrayHelper::map(Category::findBySql($sql)->asArray()->all(), 'id', 'cat_title');
  }

  public function getCategoryListEx()
  {
    $sql = 'SELECT id, cat_title from category WHERE id = 38;';
    return ArrayHelper::map(Category::findBySql($sql)->asArray()->all(), 'id', 'cat_title');
  }


/*  public function getAllComplex()
  {
    $sql = 'SELECT tool_tbl.id, tool_title, tool_manufact, tool_model, tool_serial, tool_tbl.factory_date,tool_tbl.operation_time, tool_tbl.break,
                cat_title, place_title, pak_title, complex_title
              FROM tool_tbl LEFT JOIN category ON tool_tbl.category_id = category.id
                LEFT JOIN place_tbl on place_id = place_tbl.id
                LEFT JOIN pak_tbl on pak_id = pak_tbl.id
                LEFT JOIN complex_tbl on tool_tbl.parent_id = complex_tbl.id;';
    return \Yii::$app->db->createCommand($sql)->queryAll();
  }*/

// связанные данные

  public function getTools()
  {
    return $this->hasMany(Tool::class, ['parent_id' => 'id']);
  }

  public function getCategory()
  {
    return $this->hasOne(Category::class, ['id' => 'category_id']);
  }

  public function getPak()
  {
    return $this->hasOne(Paks::class, ['id' => 'parent_id']);
  }

  public function getUser()
  {
    return $this->hasOne(User::class, ['id' => 'user_id']);
  }

}