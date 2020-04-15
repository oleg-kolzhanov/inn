<?php
namespace frontend\tests\models;

use frontend\fixtures\InnFixture;

class InnTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        $this->tester->haveFixtures([
            'cars' => [
                'class' => InnFixture::className(),
                'dataFile' => codecept_data_dir() . 'inn.php'
            ]
        ]);
    }

    protected function _after()
    {
    }

    /**
     * Тест для добавление инн
     */
    public function testCreate()
    {
    }
}