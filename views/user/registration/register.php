<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var yii\widgets\ActiveForm    $form
 * @var dektrium\user\models\User $user
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('http://176.112.218.83/yii/web/assets/script.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<div class="row">
    <div class="col-sm-5 col-sm-offset-0 col-md-5 col-md-offset-0"> <!--col-md-4 col-md-offset-4>-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?> как Клиент</h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                ]); ?>

                <?php //$form->field($model, 'username') ?>

                <?= $form->field($model, 'email', ['options' => ['id'=>'clt']]) ?>

                <?php //$form->field($model, 'field') ?>

                <?= $form->field($model, 'type')->hiddenInput(['value'=> '0'])->label(false) //echo Html::hiddenInput('field', "321"); ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block', 'value'=>'signup']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
    </div>

    <div class="col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2"> <!--col-md-4 col-md-offset-4>-->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?> как Мастер</h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'registration-form1',
                ]); ?>

                <?php //$form->field($model, 'username') ?>

<?= $form->field($model, 'activeType')->hiddenInput(['value' => isset($_POST['register-form']['type']) && $_POST['register-form']['type'] == 1 ? '1' : '0'])->label(false) ?>

                <?= $form->field($model, 'email', ['options' => ['id'=>'mst']]) ?>
                
                <?= $form->field($model, 'type')->hiddenInput(['value'=> '1'])->label(false) ?>

                <?= $form->field($model, 'rate')->hiddenInput(['value'=> '1'])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <!--
                <h4 class="v2">Выбор тарифа:</h4>
                <ul class="lst-checks">
                    <li class="active" id="rate_1">
                        <a href="#">
                                  <span class="lc-head">
                                      <span class="lc-left">Стоимость:</span>
                                      <span class="lc-right">100 рублей</span>
                                  </span>
                                  <span class="lc-head">
                                      <span class="lc-left">Период:</span>
                                      <span class="lc-right">24 часа</span>
                                  </span>
                            <span class="lc-center">"LIGHT"</span>
                            <span class="img-ch"></span>
                        </a>
                    </li>
                    <li class="" id="rate_2">
                        <a href="#">
                                  <span class="lc-head">
                                      <span class="lc-left">Стоимость:</span>
                                      <span class="lc-right">500 рублей</span>
                                  </span>
                                  <span class="lc-head">
                                      <span class="lc-left">Период:</span>
                                      <span class="lc-right">7 дней</span>
                                  </span>
                            <span class="lc-center">"NORMAL"</span>
                            <span class="img-ch"></span>
                        </a>
                    </li>
                    <li class="" id="rate_3">
                        <a href="#">
                                  <span class="lc-head">
                                      <span class="lc-left">Стоимость:</span>
                                      <span class="lc-right">1500 руб.</span>
                                  </span>
                                  <span class="lc-head">
                                      <span class="lc-left">Период:</span>
                                      <span class="lc-right">30 дней</span>
                                  </span>
                            <span class="lc-center">"Premium"</span>
                            <span class="img-ch"></span>
                        </a>
                    </li>
                </ul>

                -->

                <?= Html::submitButton("Выбрать", ['class' => 'btn btn-success btn-block', 'value'=>'test']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
    </div>

    <!--<div class="col-sm-5 col-sm-offset-2 col-md-5 col-md-offset-2">
        <div class="thumbnail1">
            <div class="caption cap-center">
                <h3>Регистрация как мастер</h3>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label">E-mail</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-3 control-label">Пароль</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                            <p class="align-left1">или зарегистрируйтесь через соцсети:</p>
                            <p class="align-left1">
                                <a class="btn btn-social-icon btn-vk"><span class="fa fa-vk"></span></a>
                                <a class="btn btn-social-icon btn-facebook"><span class="fa fa-facebook"></span></a>
                                <a class="btn btn-social-icon btn-twitter"><span class="fa fa-twitter"></span></a>
                            </p>
                            <h4 class="v2">Выбор тарифа:</h4>
                            <ul class="lst-checks">
                                <li class="active">
                                    <a href="#">
                                  <span class="lc-head">
                                      <span class="lc-left">Стоимость:</span>
                                      <span class="lc-right">100 рублей</span>
                                  </span>
                                  <span class="lc-head">
                                      <span class="lc-left">Период:</span>
                                      <span class="lc-right">24 часа</span>
                                  </span>
                                        <span class="lc-center">"LIGHT"</span>
                                        <span class="img-ch"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#">
                                  <span class="lc-head">
                                      <span class="lc-left">Стоимость:</span>
                                      <span class="lc-right">500 рублей</span>
                                  </span>
                                  <span class="lc-head">
                                      <span class="lc-left">Период:</span>
                                      <span class="lc-right">7 дней</span>
                                  </span>
                                        <span class="lc-center">"NORMAL"</span>
                                        <span class="img-ch"></span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#">
                                  <span class="lc-head">
                                      <span class="lc-left">Стоимость:</span>
                                      <span class="lc-right">1500 руб.</span>
                                  </span>
                                  <span class="lc-head">
                                      <span class="lc-left">Период:</span>
                                      <span class="lc-right">30 дней</span>
                                  </span>
                                        <span class="lc-center">"Premium"</span>
                                        <span class="img-ch"></span>
                                    </a>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-lg btn-primary">ВЫБРАТЬ</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>-->
</div>
