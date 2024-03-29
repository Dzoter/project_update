<?php


if (file_exists(__DIR__ . '/paramsForProd.php')){
    $params = require __DIR__ . '/paramsForProd.php';
} else {
    $params = require __DIR__ . '/params.php';
}

$db = require __DIR__ . '/db.php';


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'wCFJ11xouO_YsjY21g5uQBJHxt9S1iSb',

        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true]
        ],
        'errorHandler' => [
            'errorAction' => 'admin/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'main/index/<page:\d+>' => 'main/index',
                'main/about' => 'main/about',
                'main/contact' => 'main/contact',
                'main/post/<postId:\d+>' => 'main/post',
                'admin/login' => 'admin/login',
                'admin/logout' => 'admin/logout',
                'admin/add' => 'admin/add',
                'admin/edit/<documentId:\d+>' => 'admin/edit',
                'admin/delete/<documentId:\d+>' => 'admin/delete',
                'admin/download/<docxId:\d+>' => 'admin/download',
                'admin/remove-img/<imgId:\d+>/<docId:\d+>' => 'admin/remove-img',
                'admin/remove-pdf/<pdfId:\d+>/<docId:\d+>' => 'admin/remove-pdf',
                'admin/rename/<imgId:\d+>/<docId:\d+>' => 'admin/rename',
                'api/GetSertificateList' => 'api/get-sertificate-list'

            ],
        ],

    ],
    'params' => $params,

    'defaultRoute' => 'main/index',

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
