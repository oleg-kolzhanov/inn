<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\MaskedInput;

$this->title = 'Проверка ИНН: ' . $model->inn;
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-inn">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="help-block">
        Результат проверки ИНН физического лица.
    </p>
    <br />
    <?php if (isset($result['code'])) { ?>
        <h3>
            Ошибка:
            <span class="text-danger"><?= Html::encode($result['code']) ?></span>
        </h3>
        <h3>
            Сообщение:
            <span class="text-danger"><?= Html::encode($result['message']) ?></span>
        </h3>
    <?php } else { ?>
        <h3>
            Статус:
            <?php if ($result['status']) { ?>
                <span class="text-success">Является самозанятым</span>
            <?php } else { ?>
                <span class="text-danger">Не является самозанятым</span>
            <?php } ?>
        </h3>
        <h3>
            Сообщение:
            <span class="text-info"><?= Html::encode($result['message']) ?></span>
        </h3>
    <?php } ?>
    <br /><br />
    <p>
        <a class="btn btn-sm btn-default" href="<?php echo Url::to(['/']); ?>">
            Проверить еще один ИНН
        </a>
    </p>
</div>
