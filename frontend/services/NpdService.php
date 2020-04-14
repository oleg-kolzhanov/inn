<?php
namespace frontend\services;

use yii\httpclient\Client;

class NpdService
{
//    const ENDPOINT = 'https://statusnpd.nalog.ru/api/v1/tracker/taxpayer_status';
    const HOST = 'https://statusnpd.nalog.ru';
    const PORT = 443;
    const FOLDER = 'api';
    const VERSION = 1;
    const ENDPOINT = 'tracker/taxpayer_status';
    const DATE_FORMAT = 'Y-m-d';

    public function check($value) {
        $client = new Client(['baseUrl' => self::getBaseUrl()]);
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl(self::ENDPOINT)
            ->setData([
                'inn' => $value,
                'requestDate' => date(self::DATE_FORMAT)
            ])
            ->send();
        if ($response->isOk) {
            $newUserId = $response->data['id'];
        }
    }

    static protected function getBaseUrl() {
        return self::HOST . ':' . self::PORT . '/' . self::FOLDER . '/v' . self::VERSION;
    }

    static protected function getUrl() {
        return self::getBaseUrl() . '/' . self::ENDPOINT;
    }
}