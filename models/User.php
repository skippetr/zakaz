<?php

namespace app\models;

class User extends \dektrium\user\models\User
{
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // add field to scenarios
        $scenarios['create'][]   = 'type';
        $scenarios['update'][]   = 'type';
        $scenarios['register'][] = 'type';

        $scenarios['create'][]   = 'rate';
        $scenarios['update'][]   = 'rate';
        $scenarios['register'][] = 'rate';
        return $scenarios;
    }

    public function rules()
    {
        $rules = parent::rules();
        // add some rules
//        $rules['fieldRequired'] = ['field', 'required'];
//        $rules['fieldLength']   = ['field', 'string', 'max' => 10];

        return $rules;
    }
    
    public static function tableName()
    {
        return '{{%user}}';
        //return parent::tableName();
    }
}

?>