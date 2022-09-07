<?php

namespace app\controllers;

use app\models\Documents;
use app\models\Docx;
use app\models\forms\AddAnotherImgForm;
use app\models\forms\AddDocumentToBdForm;
use app\models\forms\AddNewImageForm;
use app\models\forms\AddSectorInfoForm;
use app\models\forms\AdminLoginForm;
use app\models\forms\RefactorImgForm;
use app\services\documents\AddAdminDocumentService;
use app\services\documents\AddSectorInfoService;
use app\services\documents\EditFilesService;
use app\services\documents\SearchDocumentsService;
use app\services\referenceTables\FilesService;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\UploadedFile;


class AdminController extends \yii\web\Controller
{
    public $layout = 'admin';

    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class'        => AccessControl::class,
                'only'         => [],
                'rules'        => [
                    [
                        'allow'   => true,
                        'actions' => [
                            'add',
                            'logout',
                            'edit',
                            'documents',
                            'delete',
                            'edit',
                            'error',
                            'download',
                            'sector',
                            'remove-img',
                            'remove-pdf',
                            'rename',
                        ],
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
        $renameForm = new RefactorImgForm();
        $addAnotherImgForm = new AddAnotherImgForm();
        $addNewImgForm = new AddNewImageForm();

        if (Yii::$app->request->post('AddDocumentToBdForm')) {

            $updateDocumentToBdForm->load(Yii::$app->request->post());
            if ($updateDocumentToBdForm->validate()) {
                $addDocument = new AddAdminDocumentService();
                $addDocument->updateDocument($document, $updateDocumentToBdForm);
                return Yii::$app->response->redirect(["admin/documents"]);
            }
        } elseif (Yii::$app->request->post('RefactorImgForm')) {

            $renameForm->load(Yii::$app->request->post());
            if ($renameForm->validate()) {
                $imiService = new EditFilesService($document);
                $imiService->editRefactorImgById($renameForm);
                $imiService->createDocx();
                return Yii::$app->response->redirect(["admin/edit/$documentId"]);
            }

        } elseif (Yii::$app->request->post('AddAnotherImgForm')){

            $addAnotherImgForm->load(Yii::$app->request->post());
            if ($addAnotherImgForm->validate()){
                $imiService = new EditFilesService($document);
                $imiService->editAnotherImg($addAnotherImgForm);
                $imiService->createDocx();
            }
        } elseif (Yii::$app->request->post('AddNewImageForm')){

            $addNewImgForm->load(Yii::$app->request->post());
            if ($addNewImgForm->validate()){
                $imiService = new EditFilesService($document);
                $imiService->editAddNewFile($addNewImgForm);
                $imiService->createDocx();

            }
        }

        return $this->render(
            'edit',
            ['document' => $document, 'updateDocumentToBdForm' => $updateDocumentToBdForm, 'renameForm' =>
                $renameForm,'addAnotherImgForm'=>$addAnotherImgForm,'addNewImgForm'=>$addNewImgForm]
        );
    }

    public function actionDocuments()
    {

        die();
        $documentSearchService = new SearchDocumentsService();
        $query = $documentSearchService->search();

        $countQuery = clone $query;

        $pages = new Pagination(
            [

                'totalCount'      => $countQuery->count(),
                'defaultPageSize' => 5,
                'forcePageParam'  => false,
                'pageSizeParam'   => false,
                'pageParam'       => Url::to(['admin/documents']),

            ]
        );

        $documents = $countQuery->offset($pages->offset)->limit($pages->limit)->all();


        return $this->render('documents', ['documents' => $documents, 'pages' => $pages]);
    }

    public function actionDelete($documentId)
    {
        $deleteDocument = new AddAdminDocumentService();
        $deleteDocument->deleteDocument($documentId);

        return Yii::$app->response->redirect(["admin/documents/"]);
    }

    public function actionDownload($docxId)
    {
        $file = Docx::find()->where("id = $docxId")->one();
        Yii::$app->response->sendFile($file->path)->send();
    }

    public function actionSector()
    {
        $sectorForm = new AddSectorInfoForm();
        if (Yii::$app->request->post()) {
            $sectorForm->load(Yii::$app->request->post());
            if ($sectorForm->validate()) {
                $addSectorService = new AddSectorInfoService();
                $addSectorService->addSector($sectorForm);

                return Yii::$app->response->redirect(["admin/documents/"]);
            }
        }

        return $this->render('sector', ['sectorFom' => $sectorForm]);
    }


    public function actionRemoveImg($imgId, $docId)
    {
        $document = Documents::find()->where(['id'=>$docId])->one();
        $imgService = new EditFilesService($document);
        $imgService->editDeleteImgById($imgId);

        return Yii::$app->response->redirect(["admin/edit/$docId"]);
    }

    public function actionRemovePdf($pdfId,$docId)
    {
        $document = Documents::find()->where(['id'=>$docId])->one();
        $imgService = new EditFilesService($document);
        $imgService->editDeletePdfById($pdfId);
        return Yii::$app->response->redirect(["admin/edit/$docId"]);
    }

    public function actionRename($imgId, $docId)
    {
        return Yii::$app->response->redirect(["admin/edit/$docId"]);
    }

}