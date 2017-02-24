<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class Technics extends ActiveRecord {

    public static function tableName()
    {
        return '{{category}}';
    }

    // returns array of tech's title
    public function getTechnics($tech = 'none') {
        $technics = $this->find()->where(['active' => '1'])->asArray()->all();
        return $technics;
    }

}

?>