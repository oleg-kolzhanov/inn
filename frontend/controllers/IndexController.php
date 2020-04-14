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
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new InnForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $service = new NpdService();
            $service->check($model->inn);

//            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
//                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
//            } else {
//                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
//            }

            return $this->refresh();
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
}
