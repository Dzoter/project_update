<?php

namespace app\controllers;

use app\models\forms\FeedBackForm;
use app\services\documents\SearchDocumentsService;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;


class MainController extends Controller
{
    public $layout = 'default';

    public function actionIndex()
    {

        $searchDocumentsService = new SearchDocumentsService();
        $query = $searchDocumentsService->search();

        $countQuery = clone $query;

        $pages = new Pagination(
            [
                'totalCount' => $countQuery->count(),
                'pageSize' => 1,
                'forcePageParam' => false,
                'pageSizeParam' => false,


            ]
        );

        //документы передадим позже
        $documents = $countQuery->offset($pages->offset)->limit($pages->limit)->all();


        return $this->render('index', ['pages' => $pages]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionContact()
    {


        $feedBackForm = new FeedBackForm();
        $messageToUser = false;
        if (Yii::$app->request->post()){
            $feedBackForm->load(Yii::$app->request->post());
            if ($feedBackForm->validate()) {
                mail(
                    'titef@p33.org',
                    'Сообщение из блога',
                    $feedBackForm->name.'|'.$feedBackForm->email.'|'.$feedBackForm->message
                );
                $messageToUser = 'Сообщение отправлено Администратору';
            } else
            {

                $messageToUser = 'заполните поля корректно';
            }
        }


        return $this->render('contact',['feedBackForm'=>$feedBackForm, 'messageToUser'=>$messageToUser]);
    }
}