<?php

namespace app\models\teh\people\labor;

use Yii;

/**
 * This is the model class for table "people_labor_title".
 *
 * @property int $id
 * @property string $title
 * @property int $active
 */
class PeopleLaborTitle extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'people_labor_title';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 250],
            [['active'], 'string', 'max' => 1],
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
            'active' => 'Active',
        ];
    }
}
