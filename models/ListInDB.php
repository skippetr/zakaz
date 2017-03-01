<?php

namespace app\models;

use Yii;

class ListInDB
{

    public static $count;

    public static function getListOfMasters($region = 'none', $tech = 'none')
    {
        $params = [':type' => 1];
        $query = Yii::$app->db->createCommand('SELECT id FROM user WHERE type=:type')
            ->bindValues($params)
            ->queryAll();

        //TODO: make readble city and tech names e.g. Regions::findOne()

        $ids = array_column($query, 'id');
        $query = (new \yii\db\Query())->select(['name', 'bio', 'technic', 'city'])->from('profile');
        if ($region == 'none' and $tech == 'none')
            $query = $query->where(['user_id' => $ids]);
        elseif ($region != 'none' and $tech != 'none')
            $query = $query->where(['user_id' => $ids, 'city' => $region, 'technic' => $tech]);
        elseif ($region != 'none')
            $query = $query->where(['user_id' => $ids, 'city' => $region]);
        elseif ($tech != 'none')
            $query = $query->where(['user_id' => $ids, 'technic' => $tech]);

        $countQuery = clone $query;
        self::$count = $countQuery->count();

        //$result = $query->createCommand()->queryAll();
        //return $result;
        return $query;
    }

    public static function getListOfOrders($region = 'none', $tech = 'none')
    {
        //$query = (new \yii\db\Query())->select(['id', 'title', 'description', 'address', 'city', 'tech'])->from('orders');
        $query = (new \yii\db\Query())->select(['id', 'name', 'description', 'address', 'city', 'tech', 'file'])->from('opportunities');
        if ($region != 'none' and $tech != 'none')
            $query = $query->where(['city' => $region, 'tech' => $tech, 'deleted' => '0']);
        elseif ($region != 'none')
            $query = $query->where(['city' => $region, 'deleted' => '0']);
        elseif ($tech != 'none')
            $query = $query->where(['tech' => $tech, 'deleted' => '0']);

        $countQuery = clone $query;
        self::$count = $countQuery->count();

        return $query;
    }

    public static function getListOfZakazi($region = 'none', $tech = 'none')
    {
        $query = (new \yii\db\Query())->select(['id', 'name', 'description', 'city', 'file'])->from('zkz_spares');
        if ($region != 'none' and $tech != 'none')
            $query = $query->where(['city' => $region, 'tech' => $tech, 'deleted' => '0']);
        elseif ($region != 'none')
            $query = $query->where(['city' => $region, 'deleted' => '0']);
        elseif ($tech != 'none')
            $query = $query->where(['tech' => $tech, 'deleted' => '0']);

        $countQuery = clone $query;
        self::$count = $countQuery->count();

        return $query;
    }
    
}

?>