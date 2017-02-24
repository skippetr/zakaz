<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class Regions extends ActiveRecord {

    public static function tableName()
    {
        return '{{regions}}';
    }

    public function getRegions($reg = 'none') {
        $regions = $this->find()->asArray()->all();
        return $regions;
    }

}

?>