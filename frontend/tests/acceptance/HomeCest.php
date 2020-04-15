<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/'));
        $I->seeInTitle('Проверка ИНН');
        $I->see('Проверка ИНН');
        $I->see('Введите ИНН физического лица.');
        $I->seeElement('input', ['name' => 'InnForm[inn]']);
        $I->seeElement('button', ['name' => 'inn-button']);
    }
}
