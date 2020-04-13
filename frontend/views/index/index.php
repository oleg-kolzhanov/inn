<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Проверка ИНН';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-inn">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Введите ИНН физического лица.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'inn-form']); ?>

            <?= $form->field($model, 'inn')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Проверить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
