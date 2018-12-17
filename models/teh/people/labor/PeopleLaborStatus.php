<?php

namespace app\models\teh\people\labor;

use app\models\teh\people\users\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "people_labor_status".
 *
 * @property int $id
 * @property int $people_id
 * @property string $free_date
 * @property string $comment
 */
class PeopleLaborStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'people_labor_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['people_id', 'free_date', 'labor_title'], 'required'],
            [['people_id'], 'integer'],
            [['free_date'], 'safe'],
            [['comment'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'people_id' => 'Сотрудник:',
            'free_date' => 'Даты:',
            'labor_title' => 'Трудовой статус',
            'comment' => 'Примечание:',
        ];
    }

  public function getUser()
  {
    return $this->hasOne(User::class, ['id' => 'people_id']);
  }

  public function getUsersList()
  {
    return ArrayHelper::map(User::find()
        ->where(['employer' => 1])
        ->asArray()
        ->all(), 'id', 'name');
  }

  public function getLaborTitle()
  {
    return $this->hasOne(PeopleLaborTitle::class, ['id' => 'labor_title']);
  }

  public function getLaborList()
  {
    return ArrayHelper::map(PeopleLaborTitle::find()
        ->asArray()
        ->all(), 'id', 'title');
  }



}
