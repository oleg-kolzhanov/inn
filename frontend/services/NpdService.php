<?php
namespace frontend\services;

use yii\httpclient\Client;
use frontend\models\Inn;

/**
 * Сервис проверки ИНН физического лица.
 * Class NpdService
 * @package frontend\services
 */
class NpdService
{
    /**
     * Хост API.
     */
    const HOST = 'https://statusnpd.nalog.ru';

    /**
     * Порт API.
     */
    const PORT = 443;

    /**
     * Раздел API.
     */
    const FOLDER = 'api';

    /**
     * Версия API.
     */
    const VERSION = 1;

    /**
     * Эндпоинт проверки ИНН.
     */
    const ENDPOINT = 'tracker/taxpayer_status';

    /**
     * Метод API.
     */
    const METHOD = 'POST';

    /**
     * Формат запроса к API.
     */
    const FORMAT = Client::FORMAT_JSON;

    /**
     * Формат даты.
     */
    const DATE_FORMAT = 'Y-m-d';

    /**
     * Проверка ИНН физического лица.
     * Результаты проверки кэшируются в БД на сутки.
     * @param $value string значение ИНН
     * @return array code - код ошибки, status - статус, message - сообщение.
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function check($value) {
        $model = new Inn();

        $inn = Inn::findOne(['value' => $value]);
        if (empty($inn)) {
            $inn = new Inn();
            $inn->value = $value;
        } else {
            if (!$inn->isOutdated()) {
                return [
                    'status' => $inn->status,
                    'message' => $inn->message,
                ];
            }
        }

        $client = new Client(['baseUrl' => self::getBaseUrl()]);
        $response = $client->createRequest()
            ->setMethod(self::METHOD)
            ->setFormat(self::FORMAT)
            ->setUrl(self::ENDPOINT)
            ->setData([
                'inn' => $value,
                'requestDate' => date(self::DATE_FORMAT)
            ])
            ->send();
        if ($response->isOk) {
            $inn->status = $response->data['status'];
            $inn->message = $response->data['message'];
            $inn->markAttributeDirty('status');
            $inn->markAttributeDirty('message');
            $inn->save();
            return [
                'status' => $inn->status,
                'message' => $inn->message,
            ];
        } else {
            return [
                'code'=> $response->data['code'],
                'message' => $response->data['message'],
            ];
        }
    }

    /**
     * Получение базового Url сервиса проверки ИНН.
     * @return string
     */
    static protected function getBaseUrl() {
        return self::HOST . ':' . self::PORT . '/' . self::FOLDER . '/v' . self::VERSION;
    }
}