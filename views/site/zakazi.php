<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.02.17
 * Time: 22:41
 */

use yii\helpers\Html;
use \yii\widgets\Pjax;

$this->title = 'Запчасти';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row padding-bot">
    <div class="col-xs-12 col-xs-offset-0 col-sm-9 col-sm-offset-0 col-md-9 col-md-offset-0 col-lg-8 col-lg-offset-0">
        <!--<p>
           <a class="text-inline" href="need-rem.html" role="button"><span class="lead">
Оставить заявку на ремонт <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
        </span></a>&nbsp;
           <a class="text-inline" href="spares-order.html" role="button"><span class="lead">
Оставить заявку на запчасть <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
        </span></a>
        </p>-->
    </div>
</div>

<div class="row">
    <?php Pjax::begin(); ?>
    <div class="col-xs-12 col-xs-offset-0 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0 col-lg-6 col-lg-offset-0">
        <?php if (count($model['zakazi']) > 0) {
            foreach ($model['zakazi'] as $item) {
                ?>

                <div class="thumbnail">
                    <div class="caption">
                        <h4><?= $item['name'] ?></h4>
                        <p><?= $item['description'] ?></p>
                        <p class="text-right">Город: <?= \app\models\Regions::findOne($item['city'])['name'] ?></p>
                        <button type="button" class="btn btn-md btn-primary">Принять заявку</button>
                        <button type="button" class="btn btn-md btn-primary pull-right">Подробнее</button>
                    </div>
                </div>

            <?php }} else { ?>
            Запчастей нет
            <?php
        }
        echo \yii\widgets\LinkPager::widget([
            'pagination' => $model['pages'],
        ]);
        ?>
    </div>

    <div class="col-xs-12 col-xs-offset-0 col-sm-5 col-sm-offset-0 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2">
        <div class="">
            <h3 class="first">Регион</h3>
            <select class="selectpicker" title="Выберите регион" onchange="javascript:location.href = this.value;">
                <?php
                foreach ($model['reg_items'] as $item) {
                    echo '<option value="http://'.$_SERVER['SERVER_NAME'].yii\helpers\Url::current(['region'=>$item['id']]).'">'.$item['name'].'</option>';
                }
                ?>
            </select>
        </div>
    </div>

    <?php Pjax::end(); ?>
</div>
