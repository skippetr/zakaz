<?php

namespace app\models;

class Description {
    
    
    public static function getPost($id) {
        $result = array();
        $query1 = (new \yii\db\Query())->select(['id', 'name', 'description', 'city', 'address', 'file', 'tech'])->
            where(['id' => $id])->from('zkz_spares')->all();
        $query2 = (new \yii\db\Query())->select(['id', 'name', 'description', 'city', 'address', 'file', 'tech'])->
            where(['id' => $id])->from('opportunities')-> all();
        
        if ($query1)
            $result = $query1[0];
        elseif ($query2)
            $result = $query2[0];
        
        return $result;
    }
}

?>