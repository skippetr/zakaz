<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.02.17
 * Time: 22:41
 */

use yii\helpers\Html;
use \yii\widgets\Pjax;

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("http://rm.0x5.ru/css/bootstrap-select.min.css");
$this->registerJsFile('http://rm.0x5.ru/js/bootstrap-select.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$script = <<< JS
    $(function () {
        $("[data-fancybox]").fancybox({
	loop:false,
	infobar:false,
	buttons:true,
	slideShow:false,
	fullScreen:false,
	touch:false,
	thumbs:false,
	focus:false,
        });  
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);

$this->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css");
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
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
        <?php if (count($model['orders']) > 0) {
            foreach ($model['orders'] as $item) {
        ?>

        <div class="thumbnail">
            <div class="caption">
                <h4><?= $item['name'] ?></h4>
                <p><?= $item['description'] ?></p>
                <p><span class="glyphicon glyphicon-map-marker"></span> <a class="open-map" href="#"><?= $item['address'] ?></a></p>
                <p class="p-for-map" style="display:none;">
                    <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=Ho60XGB-iaVDjFYF7aNtky1k6EjRxL0x&amp;width=100%&amp;height=240&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script>
                </p>
                <p class="text-right">Техника: <?= \app\models\Technics::findOne($item['tech'])['name'] ?></p>
                <!-- <button type="button" class="btn btn-md btn-primary">Принять заявку</button> -->
                <?php
                    $url = explode('/', $item['file']);
                    if (count($url) > 2) {
                    $url_result = 'http://176.112.218.83/yii/' . $url[5] . '/' . $url[6];
                ?>
<div style="height: 70px; position: relative;">
<a data-fancybox="inline" href="<?= $url_result ?>" style="height"><img src="<?= $url_result ?>" style="position: absolute; max-width:100% !important; max-height:100% !important; display: block;"></a>
</div>
                                <!--<ul id="pg" style="height: 80px;">
                                    <li>
                                        <img src="<?= $url_result ?>">
                                    </li>
                                </ul>
-->
                <?php } ?>
                <a href="<?= Yii::getAlias('@web') ?>/site/description?id=<?= $item['id'] ?>" role="button" class="pull-right btn btn-primary btn-large">Подробнее</a>
            </div>
        </div>

        <?php }} else { ?>
            Заказов нет
        <?php 
            }
            echo \yii\widgets\LinkPager::widget([
                'pagination' => $model['pages'],
            ]);
        ?>
    </div>

    <?php Pjax::end(); ?>
    <div class="col-xs-12 col-xs-offset-0 col-sm-5 col-sm-offset-0 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2">
        <div class="">
            <h3 class="first">Регион</h3>
            <?php
            $selectTitle = 'Выберите регион';
            if (isset($_GET['region']))
                $selectTitle = \app\models\Regions::findOne($_GET['region'])['name'];
            ?>
            <select class="selectpicker" title="<?= $selectTitle ?>" data-live-search="true" onchange="javascript:location.href = this.value;">
                <?php
                foreach ($model['reg_items'] as $item) {
                    echo '<option value="http://'.$_SERVER['SERVER_NAME'].yii\helpers\Url::current(['region'=>$item['id']]).'">'.$item['name'].'</option>';
                }
                ?>
            </select>
            <?php //Pjax::begin(); ?>
            <h3>Вид техники</h3>
            <div class="list-group">
                <?php
                echo Html::a('Сбросить фильтр', 'http://'.$_SERVER['SERVER_NAME'].yii\helpers\Url::current(['tech'=>'none', 'region' => 'none']), ['class' => 'list-group-item']);
                foreach ($model['tec_items'] as $item)  {
                    $params = ['class' => 'list-group-item'];
                    if (isset($_GET['tech']) && $_GET['tech'] == $item['id'])
                        $params = ['class' => 'list-group-item active'];
                    echo Html::a($item['name'], 'http://'.$_SERVER['SERVER_NAME'].yii\helpers\Url::current(['tech'=>$item['id']]), $params);
                }
                ?>
            </div>
            <?php //Pjax::end(); ?>
        </div>
    </div>
</div>
