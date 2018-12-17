<?php

namespace app\models\teh\people\positions;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "people_position".
 *
 * @property int $id
 * @property string $title Название должности
 * @property int $parent
 */
class Positions extends ActiveRecord
{
  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'people_position';
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
        [['title'], 'required'],
        [['parent'], 'integer'],
        [['title'], 'string', 'max' => 250],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels()
  {
    return [
        'id' => 'ID',
        'title' => 'Наименование',
        'parent' => 'Категория',
    ];
  }

  public function getPositionsList()
  {
    return ArrayHelper::map(Positions::find()->where(['=', 'parent', 0])->asArray()->all(), 'id', 'title');
  }

  public function getPositions()
  {
    return $this->hasOne(Positions::class, ['id' => 'parent']);
  }

}
