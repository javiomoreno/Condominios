<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;

class AdministradorController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['administrador'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout ="main-admin";
        Yii::$app->view->params['iconoAdministrador'] = 'fa fa-laptop';
        Yii::$app->view->params['tituloAdministrador'] = 'Dashboard';
        Yii::$app->view->params['subTituloAdministrador'] = 'Inicio';
        Yii::$app->view->params['subTitulo2Administrador'] = '';
        Yii::$app->view->params['linkAdministrador'] = '';
        return $this->render('index');
    }

}
