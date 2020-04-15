<?php
namespace frontend\components;

use yii\validators\Validator;

/**
 * InnFLValidator проверяет, что значение атрибута является корректным значением ИНН физического лица.
 *
 * @link https://www.egrul.ru/test_inn.html
 */
class InnFLValidator extends Validator
{
    /**
     * {@inheritdoc}
     */
    public function validateAttribute($model, $attribute)
    {
        $value = $model->$attribute;

        $n11 = $this->checksum($value, [7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
        $n12 = $this->checksum($value, [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
        $result = (($n11 === (int) $value{10}) && ($n12 === (int) $value{11}));

        if (!$result) {
            $this->addError($model, $attribute, 'Некорректное значение «{attribute}».');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function clientValidateAttribute($model, $attribute, $view)
    {
        $label = $model->getAttributeLabel($attribute);

        return <<<JS
let result = false;
let inn = value.toString();

if (/[^0-9]/.test(inn)) {
    messages.push('Значение «{$label}» должно содержать 12 цифр.');
} else {
    let checksum = function (inn, coefficients) {
        var n = 0;
        for (var i in coefficients) {
            n += coefficients[i] * inn[i];
        }
        return parseInt(n % 11 % 10);
    };
    let n11 = checksum(inn, [7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
    let n12 = checksum(inn, [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8]);
    if ((n11 === parseInt(inn[10])) && (n12 === parseInt(inn[11]))) {
        result = true;
    }
    if (!result) {
        messages.push('Некорректное значение «{$label}».');
    }
}
JS;
    }

    /**
     * Вычисление чексуммы для проверки ИНН физщического лица.
     * @param $value string значение
     * @param $coefficients array коэффициенты
     * @return int
     */
    protected function checksum($value, $coefficients) {
        $result = 0;
        foreach ($coefficients as $i => $c) {
            $result += $c * (int) $value{$i};
        }
        return $result % 11 % 10;
    }
}