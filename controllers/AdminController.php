<?php

namespace app\controllers;

use Yii;
use app\models\Users;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSearchGuest()
    {
        $postData = Yii::$app->request->post();

        $users = Users::find()->where('first_name LIKE :substr', array(':substr' => '%'.$postData['query'].'%'))->orWhere('last_name LIKE :substr', array(':substr' => '%'.$postData['query'].'%'))->all();

        $data['users'] = $users;

        return $this->renderPartial('search_results',$data);
    }

}
