<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

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