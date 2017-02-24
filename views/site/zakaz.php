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
?>

<div class="row">
    <div class="col-xs-12 col-xs-offset-0 col-sm-6 col-sm-offset-0 col-md-6 col-md-offset-0 col-lg-5 col-lg-offset-0">

        <?php
        if ($success)
            echo '<div class="alert alert-success" role="alert">Zakaz oformlen</div>';
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
        <?= $form->field($model, 'city')->textInput() ?>
        <?= $form->field($model, 'items[]')->radioList(['1' => 'Самовывоз', '2' => 'Доставка']) ?>
        <?= $form->field($model, 'description')->textarea(['rows' => 3, 'cols' => 7]) ?>
        <?= $form->field($model, 'imageFile')->fileInput() ?>

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
