<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\web\UploadedFile;

class OrderForm2 extends ActiveRecord {
    private $path = null;
    public $title;
    public $address;
    public $typeTech;
    public $date;
    public $time;
    public $clarify;
    public $description;
    public $imageFile;

    public static function tableName() {
        return '{{orders}}';
    }

    public function rules()
    {
        return [
            [['title', 'address', 'description'], 'required'],
            //[['email'], 'email'],
            ['imageFile', 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 1],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'address' => 'Адрес',
            'typeTech' => 'Вид техники',
            //'date' => 'Дата',
            //'time' => 'Время',
            //'clarify' => 'Уточнить',
            'description' => 'Подробности',
            'imageFile' => 'Загрузить изображение',
        ];
    }

    public function upload() {
        if ($_FILES['OrderForm']['error']['imageFile'] == 0) {
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
            'title' => $post['title'],
            'address' => $post['address'],
            'tech' => $post['typeTech'],
            'date' => $post['date'],
            'time' => $post['time'],
            'clarify' => (!empty($post['clarify'])) ? true : false,
            'description' => $post['description'],
            'file' => $this->path,
            'timestamp' => time()
        ];
        try {
            Yii::$app->db->createCommand()->insert('orders', $params)->execute();
        }
        catch (\Exception $e) {
            return false;
        }
        return true;
    }

}

?>
