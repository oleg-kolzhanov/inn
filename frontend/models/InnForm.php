<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\components\InnFLValidator;

/**
 * ContactForm is the model behind the contact form.
 */
class InnForm extends Model
{
    public $inn;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['inn', 'required'],
            ['inn', 'match', 'pattern' => '/^(\d{4}\-\d{6}\-\d{2})$/', 'message' => 'Значение «ИНН» должно содержать 12 цифр'],
            ['inn', 'filter', 'filter' => function($value) {
                    $value = str_replace('-', '', $value);
                    return $value;
                },
                'enableClientValidation' => true,
            ],
            ['inn', InnFLValidator::className()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'inn' => 'ИНН',
        ];
    }
}