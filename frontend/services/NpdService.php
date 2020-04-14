<?php
namespace frontend\services;

use yii\httpclient\Client;
use frontend\models\Inn;

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
        $model = new Inn();

        $inn = Inn::findOne(['value' => $value]);
//        if (empty($inn)) {
//            $inn = new Inn();
//            $inn->value = $value;
//        } else {
//            if (!$inn->isOutdated()) {
//                return [
//                    'status' => $inn->status,
//                    'message' => $inn->message,
//                ];
//            }
//        }

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

    static protected function getBaseUrl() {
        return self::HOST . ':' . self::PORT . '/' . self::FOLDER . '/v' . self::VERSION;
    }

    static protected function getUrl() {
        return self::getBaseUrl() . '/' . self::ENDPOINT;
    }
}