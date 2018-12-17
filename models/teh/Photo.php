<?php


namespace app\models\teh;

use app\models\teh\tool\Tool;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

class Photo extends ActiveRecord        // модель для добавления загрузки изображений
  // и добавления путей в БД с привязкой к id оборудования
{
  public $imageFiles;

  public static function tableName()
  {
    return 'eq_photo';
  }

  public function attributeLabels()
  {
    return [
        'imageFiles' => 'Изображения:',
        'eq_id' => 'Оборудование:',
        'photo_path' => 'Фотографии:',
    ];
  }

  public function rules()
  {
    return [
        [['photo_path', 'eq_id'], 'safe'],
        [['imageFiles'], 'file',
            'extensions' => 'jpg, gif, png',
            'maxFiles' => 10,
        ]
    ];
  }

  public function uploadImage($id)
  {
    if (empty($this->imageFiles)) {
      return false;
    }
    $flag = false;
    // store the source file name
    foreach ($this->imageFiles as $image) {
      $ext = $image->extension;
      $photo_path = \Yii::$app->security->generateRandomString() . ".{$ext}";   // для сохранения в БД
      $path = \Yii::$app->params['uploadPath'] . $photo_path;
      if ($image->saveAs($path, false)) {
        $model = new Photo();
        $model->eq_id = $id;
        $model->photo_path = $photo_path;
        $model->save();
        $flag = true;
      }
    }
    return $model->id;
  }


  public function uploadImageEx()
  {
    if (empty($this->imageFiles)) {
      return false;
    }
    $flag = false;
    // store the source file name
    foreach ($this->imageFiles as $image) {
      $ext = $image->extension;
      $photo_path = \Yii::$app->security->generateRandomString() . ".{$ext}";   // для сохранения в БД
      $path = \Yii::$app->params['uploadPath'] . $photo_path;
      if ($image->saveAs($path, false)) {
        $flag = true;
      }
    }
    return $flag;
  }


  public function getImageFile()
  {
    return isset($this->photo_path) ? \Yii::$app->params['uploadPath'] . $this->photo_path : null;
  }

  public function getImageUrlEx()
  {
// return a default image placeholder if your source img is not found
    $filePath = \Yii::$app->params['uploadPath'] . $this->photo_path;
    if(file_exists($filePath)) {
      $photo_path = isset($this->photo_path) ? $this->photo_path : 'image_not_found.jpg';
    } else {
      $photo_path = 'image_not_found.jpg';
    }
    return \Yii::$app->params['uploadUrl'] . $photo_path;
  }

  public function getImageUrl()
  {
    $photo_path = isset($this->photo_path) ? $this->photo_path : 'default_photo.jpg';
    return \Yii::$app->params['uploadUrl'] . $photo_path;
  }


  public static function getDefaultPhotoUrl()
  {
//  return a default image placeholder if your source avatar is not found
    return \Yii::$app->params['uploadUrl']. '/' . 'image_not_found.jpg';
  }

  public function getTool()
  {
    return $this->hasOne(Tool::class, ['id' => 'eq_id']);
  }

  public function getToolList()
  {
    return ArrayHelper::map(Tool::find()->all(), 'id', 'titleSerial');
  }

}