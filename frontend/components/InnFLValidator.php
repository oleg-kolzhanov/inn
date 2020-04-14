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