<?php

namespace app\models\teh;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $name
 * @property string $login
 * @property string $password
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'login', 'password'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя пользователя',
            'login' => 'Login',
            'password' => 'Пароль',
        ];
    }


}
