<?php
namespace frontend\tests\models;

use frontend\fixtures\InnFixture;
use frontend\models\Inn;

/**
 * Тестирование модели Inn.
 * Class InnTest
 * @package frontend\tests\models
 */
class InnTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     * @see http://bologer.ru/yii2-basic-pishem-i-zapuskaem-testy-s-codeception/
     */
    protected $tester;

    /**
     * {@inheritdoc}
     */
    protected function _before()
    {
        $this->tester->haveFixtures([
            'cars' => [
                'class' => InnFixture::className(),
                'dataFile' => codecept_data_dir() . 'inn.php'
            ]
        ]);
    }

    /**
     * Тестирование добавления ИНН.
     */
    public function testCreate()
    {
        $model = new Inn();
        $model->load([
            'value' => '463217055384',
            'status' => false,
            'message' => '463217055384 не является плательщиком налога на профессиональный доход'
        ],'');
        expect_that($model->insert());
    }
}