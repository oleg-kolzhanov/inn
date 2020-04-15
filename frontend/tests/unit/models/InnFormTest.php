<?php
namespace frontend\tests\unit\models;

use frontend\models\InnForm;
use yii\mail\MessageInterface;

class InnFormTest extends \Codeception\Test\Unit
{
    public function testWrongNumber()
    {
        $model = new InnForm();

        $model->attributes = [
            'inn' => '111111111111',
        ];
        expect_not($model->validate());
    }

    public function testWrongLength()
    {
        $model = new InnForm();

        $model->attributes = [
            'inn' => '111111',
        ];
        expect_not($model->validate());
    }

    public function testCorrect()
    {
        $model = new InnForm();

        $model->attributes = [
            'inn' => '482608013231',
        ];
        expect_that($model->validate());
    }
}
