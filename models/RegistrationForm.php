<?php

namespace app\models;

class RegistrationForm extends \dektrium\user\models\RegistrationForm
{
    /**
     * @var string
     */
    public $type;
    public $rate;
public $activeType;
    //public $hiddenField;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();
//        $rules['fieldRequired'] = ['field', 'required'];
        $rules['typeLength']   = ['type', 'number', 'max' => 2];
        $rules['rateLength']   = ['rate', 'number', 'max' => 3];
$rules['activeTypeLength']   = ['activeType', 'number', 'max' => 3];
        unset($rules['usernameRequired']);
        return $rules;
    }
}

?>