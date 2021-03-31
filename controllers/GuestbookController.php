<?php

namespace app\controllers;

use Yii;
use app\models\Events;
use app\models\RegistrationForm;

class GuestbookController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new RegistrationForm();
        $events = Events::find()
                  ->where(['is_active' => 1])
                  ->all();

        if($model->load(Yii::$app->request->post()) && $model->register()) {
            Yii::$app->session->setFlash('success', "Registration successful!");
            return $this->redirect(Yii::$app->homeUrl);
        }

        return $this->render('index', [
            'model' => $model,
            'events' => $events,
        ]);
    }

    public function actionRegister()
    {
        $model = new RegistrationForm();
        if($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->redirect(Yii::$app->homeUrl);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
