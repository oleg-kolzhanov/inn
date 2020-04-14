<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\widgets\MaskedInput;

$this->title = 'Проверка ИНН';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-inn">
    <h1><?= Html::encode($this->title) ?></h1>

    <p class="help-block">
        Введите ИНН физического лица.
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'inn-form']); ?>

            <?=
                $form->field($model, 'inn')
                ->widget(MaskedInput::className(), [
                    'mask'=>'9999-999999-99',
//                    'clientOptions' => [
//                        'removeMaskOnSubmit' => true,
//                    ]
                ])
                ->textInput([
                    'placeholder'=>'4826-080132-31',
                    'class' => 'form-control input-lg'
                ]);
            ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'inn-button']); ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
