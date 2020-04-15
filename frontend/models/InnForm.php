<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use frontend\components\InnFLValidator;

/**
 * Форма проверки ИНН физического лица.
 */
class InnForm extends Model
{
    /**
     * @var string Номер ИНН.
     */
    public $inn;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['inn', 'required'],
            ['inn', 'match', 'pattern' => '/^(\d{12})$/', 'message' => 'Значение «ИНН» должно содержать 12 цифр'],
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