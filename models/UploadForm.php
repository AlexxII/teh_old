<?php

namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;


class UploadForm extends Model
{

  public $imageFiles;
  public $file_path = [];

  public function rules()
  {
    return [
        [
            ['imageFiles'], 'file',
            'skipOnEmpty' => true,
            'extensions' => 'png, jpg',
            'maxFiles' => 4
        ],
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
        $random = rand();
        $path = Yii::$app->params['uploadTehPhotoPath'] . $fName . '_' . $i . '_' . $random . '.' . $file->extension;
        $this->file_path[] = Yii::$app->params['uploadTehPhotoDb'] . $fName . '_' . $random . '.' . $file->extension;
        $file->saveAs($path, false);
        $i++;
      }
      return true;
    } else {
      return false;
    }
  }

}