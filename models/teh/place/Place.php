<?php

namespace app\models\teh\place;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%place_tbl}}".
 *
 * @property int $id
 * @property string $place_title
 * @property string $comment
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%place_tbl}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['place_title'], 'required'],
            [['place_title', 'comment'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'place_title' => 'Место расположения:',
            'comment' => 'Заметки:',
        ];
    }

    public static function PlaceList()
    {
      $sql = 'SELECT * FROM place_tbl';
      return ArrayHelper::map(Place::findBySql($sql)->asArray()->all(), 'id', 'place_title');
    }
}
