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
        <?php
            $url = explode('/', $model['file']);
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
        <?php } else { ?>
            Изображение отсутствует
        <?php } ?>
    </div>
</div>
