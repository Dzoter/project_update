<?php

namespace app\controllers;

use app\models\Documents;
use app\models\forms\AddDocumentToBdForm;
use app\models\forms\AdminLoginForm;
use app\services\documents\AddAdminDocumentService;
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
                        'actions' => ['add', 'logout', 'edit', 'documents', 'delete', 'edit','test'],
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
            return Yii::$app->response->redirect(["admin/documents/"]);
        }

        $adminLogin->password = '';

        return $this->render('login', [
            'adminLoginForm' => $adminLogin,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAdd()
    {
        $addDocumentToBdForm = new AddDocumentToBdForm();
        if (Yii::$app->request->post()) {
            $addDocumentToBdForm->load(Yii::$app->request->post());
            if ($addDocumentToBdForm->validate()) {
                $addDocument = new AddAdminDocumentService();
                $addDocument->addDocument($addDocumentToBdForm, 'add');

                return Yii::$app->response->redirect(["admin/documents/"]);
            }
        }

        return $this->render('add', ['addDocumentToBdForm' => $addDocumentToBdForm]);
    }

    public function actionEdit($documentId)
    {
        $document = Documents::find()->where(['id' => $documentId])->one();

        $updateDocumentToBdForm = new AddDocumentToBdForm();
        if (Yii::$app->request->post()) {
            $updateDocumentToBdForm->load(Yii::$app->request->post());
            if ($updateDocumentToBdForm->validate()) {
                $addDocument = new AddAdminDocumentService();
                $addDocument->updateDocument($documentId, $updateDocumentToBdForm);

                return Yii::$app->response->redirect(["admin/documents/"]);
            }
        }

        return $this->render('edit', ['document' => $document, 'updateDocumentToBdForm' => $updateDocumentToBdForm]);
    }

    public function actionDocuments()
    {

        $documentSearchService = new SearchDocumentsService();
        $query = $documentSearchService->search();

        $countQuery = clone $query;

        $pages = new Pagination(
            [

                'totalCount'     => $countQuery->count(),
                'defaultPageSize'       => 5,
                'forcePageParam' => false,
                'pageSizeParam'  => false,
                'pageParam' => Url::to(['admin/documents'])

            ]
        );

        $documents = $countQuery->offset($pages->offset)->limit($pages->limit)->all();


        return $this->render('documents',['documents'=>$documents,'pages'=>$pages]);
    }

    public function actionDelete($documentId)
    {
        $deleteDocument = new AddAdminDocumentService();
        $deleteDocument->deleteDocument($documentId);

        return Yii::$app->response->redirect(["admin/documents/"]);
    }
    public function actionTest(){

        $test = new AddAdminDocumentService();

        return Yii::$app->response->redirect(["admin/test/"]);
    }
}