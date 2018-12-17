<?php

namespace app\models\teh\add;

use yii\base\Model;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;
use app\base\MHelper;


class UploadForm extends Model
{

  public $imageFiles;
  public $file_path = [];

  public function rules()
  {
    return [
        [['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
    ];
  }

  public function attributeLabels()
  {
    return [
        'imageFiles' => 'Изображения:',
    ];
  }


  public function upload($fName)    // метод загружает файл по указанному пути и возвращает путь
  {

    if ($this->validate()) {
      $i = 0;
      foreach ( $this->imageFiles as $file) {
        $fN = MHelper::translit($fName);
        $path = Yii::$app->params['uploadTehPhotoPath'] . $fN . '_' . $i . '.' . $file->extension;
        $this->file_path[$i] = Yii::$app->params['uploadTehPhotoDb'] . $fN . '_' . $i . '.' . $file->extension;
        $file->saveAs($path, false);
        $i++;
      }
      return true;
    } else {
      return false;
    }
  }


}