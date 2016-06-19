<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\GenerateReferralCodeForm;
use app\models\User;

class UserController extends Controller
{
    /**
     * @return string
     */

    public function actionIndex()
    {
        $this->layout = 'user';
        $model        = new User();
        $list         = $model->getBindToUsers();
        $from_user    = $model->getFromUser();

        return $this->render('index',[
          'model'     => $model,
          'list'      => $list,
          'from_user' => $from_user,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLinkreferral()
    {
        $this->layout = 'user';
        $model        = new GenerateReferralCodeForm();

        if (Yii::$app->request->post() && $model->generateReferralCode()) {
          return $this->goBack('/user/linkreferral');
        }
        return $this->render('linkreferral',[
          'model' => $model,
        ]);
    }


}
