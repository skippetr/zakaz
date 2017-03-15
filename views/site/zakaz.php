<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.02.17
 * Time: 22:35
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Заказать запчасть';
$this->params['breadcrumbs'][] = $this->title;

$script = <<< JS
    $(function () {
        // Create the preview image
        $(".field-zakazform-imagefile input:file").change(function (){     
            var img = $('<img/>', {
                id: 'dynamic',
                width:250,
                height:200
            });      
            var file = this.files[0];
            var reader = new FileReader();
            reader.onload = function (e) {
                $("label[for='zakazform-imagefile']").text("Изображение загружено");
                //$(".image-preview-clear").show();
                img.attr('src', e.target.result);
                $("#thumb").html($(img)[0].outerHTML);
            }        
            reader.readAsDataURL(file);
        });  
    });
JS;
$this->registerJs($script, yii\web\View::POS_READY);

$this->registerCssFile("http://rm.0x5.ru/css/bootstrap-select.min.css");
$this->registerJsFile('http://rm.0x5.ru/js/bootstrap-select.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="row">
    <div class="col-xs-12 col-xs-offset-0 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0 col-lg-5 col-lg-offset-0">

        <?php
        if ($success)
            Yii::$app->response->redirect(Yii::getAlias('@web')."/site/success");
        ?>
        
        <h2 class="header-h2">Оставить заявку на запчасть</h2>
        <?php
            $form = ActiveForm::begin([
            'id' => 'zakazform',
            'options' => ['class' => 'form-horizontal' ,'enctype' => 'multipart/form-data', 'method'=>'post'],
            ])
        ?>
        <?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
    
        <div class="form-group field-zakazform-city">
            <label class="control-label" for="zakazform-city">Город</label>
            <select class="selectpicker" title="Выберите регион" id="zakazform-city" name="ZakazForm[city]" data-live-search="true">
                <?php
                foreach ($reg_items as $item) {
                    echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
                }
                ?>
            </select>
            <div class="help-block"></div>
        </div>
        
        <?= $form->field($model, 'address')->textInput() ?>
        <?= $form->field($model, 'typeTech')->dropDownList($tech); ?>
        <?= $form->field($model, 'items[]')->radioList(['1' => 'Самовывоз', '2' => 'Доставка']) ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 3, 'cols' => 7]) ?>
        <?= $form->field($model, 'imageFile')->fileInput(['class' => 'btn btn-primary']) ?>

        <div id="thumb"></div><br>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end() ?>

    </div>
    <div class="col-xs-12 col-xs-offset-0 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0 col-lg-5 col-lg-offset-2">
        <div class="jumbotron">
            <h2>Выбрать запчасть на сайте</h2>
            <p class="lead"><a href="#">ten163.ru</a></p>
        </div>
    </div>
</div>
