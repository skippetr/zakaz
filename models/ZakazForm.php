<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Null_;
use Yii;
use \yii\db\ActiveRecord;
use yii\web\UploadedFile;

class ZakazForm extends ActiveRecord {
    private $path = null;
    public $name;
    public $email;
    public $city;
    public $description;
    public $items;
    public $imageFile;

    public static function tableName() {
        return '{{zakaz}}';
    }

    public function rules()
    {
        return [
            [['name', 'city'], 'required'],
            [['email'], 'email'],
            ['imageFile', 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'Email',
            'city' => 'Город',
            'items' => '',
            'description' => 'Подробности',
            'imageFile' => 'Загрузить изображение',
        ];
    }
    
    public function upload() {
        if ($_FILES['ZakazForm']['error']['imageFile'] == 0) {
            if (!$this->validate()) {
                $this->path = '/var/www/html/yii-test/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
                $this->imageFile->saveAs($this->path);
                return true;
            } else {
                return false;
            }
        }
    }

    public function saveRecord($post) {
        $params = [
            'name' => $post['name'],
            'email' => $post['email'],
            'city' => $post['city'],
            'method' => $post['items'][0] . $post['items'][1],
            'description' => $post['description'],
            'file' => $this->path,
            'timestamp' => time(),
        ];
        try {
            Yii::$app->db->createCommand()->insert('zakaz', $params)->execute();
        }
        catch (\Exception $e) {
            return false;
        }
        return true;
    }

}

?>
