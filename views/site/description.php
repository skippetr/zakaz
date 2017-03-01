<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.02.17
 * Time: 22:35
 */

use yii\helpers\Html;

$this->title = 'Подробнее о заказе';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-xs-12 col-xs-offset-0 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-5 col-lg-offset-3">
        <h4>Название</h4>
        <?= $model['name'] ?>

        <h4>Город</h4>
        <?= \app\models\Regions::findOne($model['city'])['name'] ?>

        <h4>Адрес</h4>
        <?= $model['address'] ?>

        <h4>Вид техники</h4>
        <?= \app\models\Technics::findOne($model['tech'])['name'] ?>

        <h4>Описание</h4>
        <?= $model['description'] ?>

        <h4>Фотография</h4>
        <img src="<?= $model['file'] ?>">
    </div>
</div>
