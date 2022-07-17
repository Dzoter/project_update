<?php

namespace app\controllers;

use app\models\forms\AdminLoginForm;
use Yii;
use yii\filters\AccessControl;

class AdminController extends \yii\web\Controller
{
    public $layout = 'admin';


    public function behaviors()
    {
        return [
            'access' => [
                'class'        => AccessControl::class,
                'only'         => [],
                'rules'        => [
                    [
                        'allow'   => true,
                        'actions' => ['add','logout'],
                        'roles'   => ['@'],
                    ],
                    [
                        'allow'   => true,
                        'actions' => ['login'],
                        'roles'   => ['?'],
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->response->redirect(['main/index/']);
                },
            ],
        ];
    }


    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $adminLogin = new AdminLoginForm();
        if ($adminLogin->load(Yii::$app->request->post()) && $adminLogin->login()) {
            return Yii::$app->response->redirect(["admin/add/"]);
        }

        $adminLogin->password = '';

        return $this->render('login', [
            'adminLoginForm' => $adminLogin,
        ]);
    }

    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionAdd()
    {
        return $this->render('add');
    }
}