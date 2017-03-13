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
    public $address;
    public $description;
    public $items;
    public $typeTech;
    public $imageFile;

    public static function tableName() {
        return '{{zkz_spares}}';
    }

    public function rules()
    {
        return [
            [['name', 'city', 'email'], 'required'],
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
            'address' => 'Адрес',
            'items' => '',
            'typeTech' => 'Вид техники',
            'description' => 'Подробности',
            'imageFile' => 'Загрузить изображение',
        ];
    }
    
    public function upload() {
        if ($_FILES['ZakazForm']['error']['imageFile'] == 0) {
            if (!$this->validate()) {
                $this->path = '/var/www/html/yii/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
                $this->imageFile->saveAs($this->path);
                return true;
            } else {
                return false;
            }
        }
    }

    public function saveRecord($post) {
        date_default_timezone_set('Europe/Moscow');

        $params = [
            'id' => Guid::create_guid(),
            'name' => $post['name'],
            'email' => $post['email'],
            'city' => ($post['city'] == 'none') ? '0' : $post['city'],
            'address' => $post['address'],
            'method' => implode('', array_values($post['items'])),
            'description' => $post['description'],
            'file' => $this->path,
            'tech' => $post['typeTech'],
            'currency_id' => '-99',
            'date_entered' => date("Y-m-d H:i:s"),
            'date_modified' => date("Y-m-d H:i:s"),
        ];
        try {
            Yii::$app->db->createCommand()->insert('zkz_spares', $params)->execute();
        }
        catch (\Exception $e) {
            //print_r($e);
            return false;
        }
        return true;
    }

}

?>
