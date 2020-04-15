<?php
namespace frontend\tests\unit\models;

use frontend\models\InnForm;
use yii\mail\MessageInterface;

/**
 * Тестирование формы InnForm.
 * Class InnFormTest
 * @package frontend\tests\unit\models
 */
class InnFormTest extends \Codeception\Test\Unit
{
    /**
     * Тестирование некорректного ИНН.
     */
    public function testWrongNumber()
    {
        $model = new InnForm();
        $model->attributes = [
            'inn' => '111111111111',
        ];
        expect_not($model->validate());
    }

    /**
     * Тестирование некореректной длинны ИНН.
     */
    public function testWrongLength()
    {
        $model = new InnForm();
        $model->attributes = [
            'inn' => '111111',
        ];
        expect_not($model->validate());
    }

    /**
     * Тестирование корректного ИНН.
     */
    public function testCorrect()
    {
        $model = new InnForm();
        $model->attributes = [
            'inn' => '482608013231',
        ];
        expect_that($model->validate());
    }
}
