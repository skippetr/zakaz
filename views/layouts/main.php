<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://rm.0x5.ru/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://rm.0x5.ru/css/justified-nav.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://rm.0x5.ru/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php $this->beginBody() ?>

<!--<div class="wrap">-->
<div class="container">
    <?php
    NavBar::begin([
        //'brandLabel' => 'My Company',
        //'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            //'class' => 'navbar-inverse navbar-fixed-top',
            'class' => 'navbar',
        ],
    ]);

    $navItems=[
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'Заказы', 'url' => ['/site/orders']],
        ['label' => 'Мастера', 'url' => ['/site/masters']],
        ['label' => 'Заказать запчасть', 'url' => ['/site/zakaz']],
        ['label' => 'Запчасти', 'url' => ['/site/zakazi']],
        ['label' => 'FAQ', 'url' => ['/site/faq']],
        ['label' => 'Поддержка', 'url' => ['/site/support']],
    ];

    if (Yii::$app->user->isGuest) {
        unset($navItems[1]);
        unset($navItems[3]);
        unset($navItems[4]);
    } else {
        if (\Yii::$app->user->identity->type == 0) { //user is client
            unset($navItems[1]);
            unset($navItems[4]);
        } else { //user is master
            unset($navItems[2]);
            unset($navItems[3]);
        }
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $navItems,
    ]);
    ?>

    <ul class="nav navbar-user navbar-right">
        <li class="dropdown">
            <a href="#" class="user-tog-btn dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <?php
                    if (Yii::$app->user->isGuest) {
                        echo "<li><a href=".Yii::getAlias('@web')."/user/login>Авторизация</a></li>";
                        echo "<li><a href=".Yii::getAlias('@web')."/user/register>Регистрация</a></li>";
                    } else {
                        echo "<li><a href=".Yii::getAlias('@web')."/site/logout/ data-method='post'>Выйти</a></li>";
                    }
                ?>
            </ul>
        </li>
    </ul>

    <ul class="nav navbar-right">
        <?php
        if (!Yii::$app->user->isGuest) {
            $str = '<li>';
            if (\Yii::$app->user->identity->type == 0) //user is client
                $str .= "Клиент";
            else //user is master
                $str .= "Мастер";
            $str .= " (".\Yii::$app->user->identity->email.")</li>";
            echo $str;
        }
        ?>
    </ul>
    
    <?php
    NavBar::end();
    ?>

    <!-- <div class="container"> -->
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    <!--</div>-->

    <footer class="footer">
        <p class="pull-left">&copy; <?= date('Y') ?> Компания, Inc</p>
    </footer>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
