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
	$arr = [['id' => 'none', 'name' => 'Любой город']];
        $regions = $this->find()->orderBy(['name' => SORT_ASC])->asArray()->all();
	$regions = $arr + $regions;
//print_r($regions);
        return $regions;
    }

}

?>