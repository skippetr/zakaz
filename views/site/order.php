<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.02.17
 * Time: 22:35
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Мне нужен ремонт';
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
    $(function () {
        $('#datetimepicker2').datetimepicker({
            locale: 'ru',
            format: 'YYYY-MM-DD',
        });
        $('#datetimepicker3').datetimepicker({
            locale: 'ru',
            format: 'LT'
        });

        // Create the preview image
        $(".field-orderform-imagefile input:file").change(function (){     
            var img = $('<img/>', {
                id: 'dynamic',
                width:250,
                height:200
            });      
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                $("label[for='orderform-imagefile']").text("Изображение загружено");
                //$(".image-preview-clear").show();
                img.attr('src', e.target.result);
                $("#thumb").html($(img)[0].outerHTML);
            }        
            reader.readAsDataURL(file);
        });  
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);

$this->registerCssFile("http://rm.0x5.ru/css/bootstrap-datetimepicker.min.css");
$this->registerCssFile("http://rm.0x5.ru/css/bootstrap-select.min.css");

$this->registerJsFile('http://rm.0x5.ru/js/moment-with-locales.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('http://rm.0x5.ru/js/bootstrap-datetimepicker.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('http://rm.0x5.ru/js/bootstrap-select.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="row">
    <div class="col-xs-12 col-xs-offset-0 col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">

        <?php
        if ($success)
            echo '<div class="alert alert-success" role="alert">Заказ оформлен</div>';
        ?>

        <h2 class="header-h2">Оставить заявку на ремонт</h2>
        <?php
        $form = ActiveForm::begin([
            'id' => 'orderform',
            'options' => ['class' => 'form-horizontal' ,'enctype' => 'multipart/form-data', 'method'=>'post'],
        ]);
        $params = [
            //'prompt' => 'Vid techniki'
        ];
        ?>
        <?= $form->field($model, 'title')->textInput() ?>
        <?= $form->field($model, 'address')->textInput() ?>
        <?= $form->field($model, 'typeTech')->dropDownList($tech,$params); ?>

        <div class="row">
            <div class="col-sm-1">
                <label class="control-label inline-label">Дата:</label>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <div class=" input-group date" id="datetimepicker2">
                        <input class="form-control" type="text" id="orderform-date" name="OrderForm[date]">
                                <span style="" class="input-group-addon">
                                    <span class="glyphicon glyph-norm glyphicon-calendar"></span>
                                </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <label class="control-label inline-label">Время:</label>
            </div>
            <div class="col-sm-3">
                <div class="form-group">
                    <div class=" input-group date" id="datetimepicker3">
                        <input class="form-control" type="text" id="orderform-time" name="OrderForm[time]">
                                <span style="" class="input-group-addon">
                                    <span class="glyphicon glyph-norm glyphicon-time"></span>
                                </span>
                    </div>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="input-group">
                    <label class="control-label inline-label">
                        <label for="inlineCheckbox98" class="checkbox-outline">
                            <input class="input11" id="orderform-clarify" type="checkbox" name="OrderForm[clarify]" value="off">Уточнять</label>
                    </label>
                </div>
            </div>
        </div>

        <?= $form->field($model, 'description')->textarea(['rows' => 3, 'cols' => 7]) ?>
        <?= $form->field($model, 'imageFile')->fileInput() ?>

        <div id="thumb"></div>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end() ?>

    </div>
</div>
