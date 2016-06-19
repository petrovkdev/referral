<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegForm;

class SiteController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return array
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
     * @return string|\yii\web\Response
     */
    public function actionIndex()
    {   
        if (Yii::$app->user->isGuest)
        {
          $model = new RegForm();
          
          if ($model->load(Yii::$app->request->post()) && $model->reg()) {
            return $this->goBack('/user');
          }  
          
          return $this->render('index',[
            'model' => $model,
          ]);
         }
        else
        {
          return $this->goBack('/user');
        }        
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
       
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm(); 
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack('/user');
        }
        return $this->render('login', [
            'model' => $model
        ]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goBack('/login');
    }

}
