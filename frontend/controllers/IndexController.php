<?php
namespace frontend\controllers;

use frontend\services\NpdService;
use Yii;
use yii\web\Controller;
use frontend\models\InnForm;

/**
 * Index controller
 */
class IndexController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Проверка ИНН физическогог лица.
     *
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\httpclient\Exception
     */
    public function actionIndex()
    {
        $model = new InnForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $service = new NpdService();
            $result = $service->check($model->inn);
            return $this->render('result', [
                'model' => $model,
                'result' => $result,
            ]);
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
}
