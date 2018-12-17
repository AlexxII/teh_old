<?php

namespace app\models\teh\tool;


use app\models\teh\category\Category;
use app\models\teh\complex\Complex;
use app\models\teh\paks\Paks;
use app\models\teh\Photo;
use app\models\teh\place\Place;
use app\models\teh\User;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class Tool extends ActiveRecord
{
  public static function tableName()
  {
    return 'tool_tbl';
  }

  public function attributeLabels()
  {
    return [
        'tool_title' => 'Наименование:',
        'tool_manufact' => 'Производитель:',
        'tool_model' => 'Модель:',
        'tool_model_ex' => 'Модель_ex',
        'tool_serial' => 'Серийный номер:',
        'factory_date' => 'Дата производства:',
        'parent_id' => 'Входит в состав:',
        'pak_id' => 'ПАК:',
        'category_id' => 'Категория оборудования:',
        'operation_time' => 'Наработка:',
        'place_id' => 'Место нахождения оборудования:',
        'break' => "Не исправен",

        'fullTitle' => 'Наименование:', // комплексное имя для вывода на экран
        'titleSerial' => 'Наименование:', // комплексное имя для вывода на экран
        'fullModelTitle' => 'Модель',
    ];
  }

  public function rules()
  {
    return [
        [['tool_title', 'category_id'], 'required'],
        ['tool_title', 'match', 'pattern' => '/^\w*[^*"?<>|]*$/i', 'message' => 'Не должно содержать символы \/:*"?<>|'],
        [['tool_title', 'tool_manufact', 'tool_model', 'tool_model_ex', 'operation_time', 'factory_date'], 'trim'],
        [['user_id', 'parent_id', 'break', 'place_id'], 'safe'],
        [['tool_title', 'tool_model', 'tool_model_ex', 'tool_serial'], 'string', 'max' => 100, 'tooLong' => 'Не более 100 символов'],
    ];
  }
//  геттеры

  public function getPakList()
  {
    return ArrayHelper::map(Paks::find()->asArray()->all(), 'id', 'pak_title', 'pak_ext');
  }

  public function getPlaceList()
  {
    return ArrayHelper::map(Place::find()->asArray()->all(), 'id', 'place_title');
  }

  public function getCategoryList()
  {
    $sql = 'SELECT C1.id, C1.cat_title, C2.cat_title as ca from category C1 LEFT JOIN category C2
             on C1.parent = C2.id WHERE C2.id!=0 ORDER BY C2.custom_order, c1.custom_order;';
    return ArrayHelper::map(Category::findBySql($sql)->asArray()->all(), 'id', 'cat_title', 'ca');
  }

  public function getUserList()
  {
    return ArrayHelper::map(User::find()->all(), 'id', 'name');
  }

  public function getFullTitle()
  {
    return $this->tool_manufact . ' ' . $this->tool_model . ' ' . $this->tool_model_ex;
  }

  public function getFullModelTitle()
  {
    return $this->tool_model . ' ' . $this->tool_model_ex;
  }

  public function getTitleSerial()
  {
    $p = !empty($this->tool_serial) ?  's/n ...' . substr($this->tool_serial, -4) : 'id_' . $this->id;
    return $this->tool_title . ' ' . $p;
  }

  public function getParentList()
  {
    $sql = 'SELECT complex_tbl.id, complex_title, place_title from complex_tbl LEFT JOIN place_tbl on complex_tbl.place_id = place_tbl.id';
    return ArrayHelper::map(Complex::findBySql($sql)->asArray()->all(), 'id', 'complex_title', 'place_title');
  }


//  вспомогательные методы

  public static function showRiacEq()
  {
    $sql = 'SELECT count(*) as number, category_id, cat_title FROM tool_tbl LEFT JOIN category
on tool_tbl.category_id = category.id GROUP BY category_id';
    return Tool::findBySql($sql)->asArray()->all();
  }

  public function showTools()
  {
    $sql = 'SELECT tool_tbl.id, tool_title, tool_manufact, tool_model, tool_serial, tool_tbl.factory_date,tool_tbl.operation_time, tool_tbl.break,
                cat_title, place_title, pak_title, complex_title
              FROM tool_tbl LEFT JOIN category ON tool_tbl.category_id = category.id
                LEFT JOIN place_tbl on place_id = place_tbl.id
                LEFT JOIN pak_tbl on pak_id = pak_tbl.id
                LEFT JOIN complex_tbl on tool_tbl.parent_id = complex_tbl.id;';
    return \Yii::$app->db->createCommand($sql)->queryAll();
  }

//  Связанные данные

  public function getComplex()
  {
    return $this->hasOne(Complex::class, ['id' => 'parent_id']);
  }

  public function getCategory()
  {
    return $this->hasOne(Category::class, ['id' => 'category_id']);
  }

  public function getPak()
  {
    return $this->hasOne(Paks::class, ['id' => 'pak_id']);
  }

  public function getPlace()
  {
    return $this->hasOne(Place::class, ['id' => 'place_id']);
  }

  public function getPhotos()
  {
    return $this->hasMany(Photo::class, ['eq_id' => 'id']);
  }

}