<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AdminAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;


AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>

</header>
<div class="dashboard-main-wrapper">
<!--     ==============================================================-->
<!--     navbar-->
<!--     ==============================================================-->
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand" href="index.html">Concept</a>


        </nav>
    </div>
<!--     ============================================================== -->
<!--     end navbar -->
<!--     ============================================================== -->
<!--     ============================================================== -->
<!--     left sidebar -->
<!--     ============================================================== -->
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="<?=\yii\helpers\Url::to(['admin/documents'])?>"><i class="fas fa-fw
                            fa-file"></i>Documents <span
                                        class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="<?=\yii\helpers\Url::to(['admin/add'])?>"><i class="far
                            fa-plus-square"></i>Add document <span class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="<?=\yii\helpers\Url::to(['admin/sector'])?>"><i class="far
                            fa-plus-square"></i>Sector overview
                                <span class="badge badge-success">6</span></a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link active" href="<?=\yii\helpers\Url::to(['admin/logout'])?>"><i class="fas
                            fa-power-off"></i>Logout <span
                                        class="badge badge-success">6</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
<main role="main" class="flex-shrink-0">
    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
