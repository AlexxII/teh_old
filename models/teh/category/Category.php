<?php

namespace app\models\teh\category;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $cat_title
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_title', 'parent', 'custom_order'], 'required'],
            [['parent'], 'trim'],
            [['cat_title'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_title' => 'Категория',
            'parent' => 'Родитель',
            'custom_order' => 'Порядок',
        ];
    }

    public function getParentList()
    {
      $sql = 'SELECT id, cat_title from category WHERE parent = 0 ORDER BY custom_order;';
      return ArrayHelper::map($this->findBySql($sql)->asArray()->all(), 'id', 'cat_title');
    }

    public static function CategoryList()
    {
      $sql = 'SELECT C1.id, C1.cat_title, C2.cat_title as ca from category C1 LEFT JOIN category C2
               on C1.parent = C2.id WHERE C2.id!=0 ORDER BY C2.custom_order, c1.custom_order;';
      return ArrayHelper::map(Category::findBySql($sql)->asArray()->all(), 'id', 'cat_title', 'ca');
    }




}
