<?php

namespace app\controllers;

use app\services\documents\ApiService;

class ApiController extends \yii\web\Controller
{
    public function actionGetSertificateList()
    {


        $post = \Yii::$app->request->post();

        $sertificate = json_encode(ApiService::getEnergySertificate());


        return $sertificate;



    }
}