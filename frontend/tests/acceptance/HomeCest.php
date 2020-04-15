<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->wantTo('Проверка страницы');
        $I->amOnPage(Url::toRoute('/'));
        $I->seeInTitle('Проверка ИНН');
        $I->see('Проверка ИНН');
        $I->see('Введите ИНН физического лица.');
        $I->seeElement('input', ['name' => 'InnForm[inn]']);
        $I->seeElement('button', ['name' => 'inn-button']);
    }

    public function checkValidation(AcceptanceTester $I)
    {
        $I->wantTo('Проверка валидации ИНН');
        $I->amOnPage(Url::toRoute('/'));
        $I->waitForElement(['name' => 'InnForm[inn]'], 5);

        $I->click('.btn.btn-primary');
        $I->wait(1);
        $I->see('Необходимо заполнить «ИНН».');

        $I->fillField(['name' => 'InnForm[inn]'], '11111');
        $I->click('.btn.btn-primary');
        $I->wait(1);
        $I->see('Значение «ИНН» должно содержать 12 цифр.');

        $I->fillField(['name' => 'InnForm[inn]'], '482608013232');
        $I->click('.btn.btn-primary');
        $I->wait(1);
        $I->see('Некорректное значение «ИНН».');
    }

    public function checkValid(AcceptanceTester $I)
    {
        $I->wantTo('Проверка корректного ИНН');
        $I->amOnPage(Url::toRoute('/'));
        $I->waitForElement(['name' => 'InnForm[inn]'], 5);
        $I->fillField(['name' => 'InnForm[inn]'], '482608013231');
        $I->click('.btn.btn-primary');
        $I->wait(1);
        $I->see('Проверка ИНН: 482608013231');
        $I->see('Статус');
        $I->see('Сообщение');
        $I->see('Проверить еще один ИНН');
    }
}
