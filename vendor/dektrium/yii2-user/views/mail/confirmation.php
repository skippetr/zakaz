<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;

/**
 * @var dektrium\user\models\User $user
 * @var dektrium\user\models\Token $token
 */
?>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'Здравствуйте') ?>,
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'Спасибо что зарегестрировались на сайте {0}', Yii::$app->name)
    /*Yii::t('user', 'Thank you for signing up on {0}', Yii::$app->name) ?>.*/ ?>.
    <?= Yii::t('user', 'Чтобы завершить регистрацию, пожалуйста, нажмите на ссылку ниже')
    /*Yii::t('user', 'In order to complete your registration, please click the link below') ?>.*/ ?>.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Html::a(Html::encode($token->url), $token->url) ?>
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'Если вы не можете нажать на ссылку, пожалуйста, попытайтесь скопировать ссылку и вставить ее в адресную строку вашего браузера')
    /*Yii::t('user', 'If you cannot click the link, please try pasting the text into your browser') ?>.*/ ?>.
</p>
<p style="font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 1.6; font-weight: normal; margin: 0 0 10px; padding: 0;">
    <?= Yii::t('user', 'Если регистрировались не вы, то проигнорируйте это письмо.')
    /*Yii::t('user', 'If you did not make this request you can ignore this email') ?>.*/ ?>
</p>
