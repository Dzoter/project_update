<?php
/** @var object $pages */

/** @var object $documents */

use yii\helpers\Html;

?>


<div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Documents</h2>
                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris
                    facilisis faucibus at enim quis massa lobortis rutrum.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= \yii\helpers\Url::to(["admin/documents/"])?>"
                                                           class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Documents</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <?php
        if (!$documents): ?>
        <p>Список постов пуст</p>
        <?php
        else: ?>
        <?php foreach ($documents as $document):?>

            <?php $file = (\app\services\documents\GetAllSecondaryInfoOfDocumentsService::getDocx($document->id));

            ?>
        <div class="card">
            <div class="card-header">
                <figcaption class="figure-caption">
                    <ul class="list-inline d-flex text-muted mb-0">
                        <li class="list-inline-item text-truncate mr-auto">
                            <span><i class="fas fa-file-word mr-2"></i></span> .docx
                        </li>

                        <li class="list-inline-item">
                            <a download="" href="<?= \yii\helpers\Url::to(["admin/download/$file->id"])?>">
                                <i class="fas fa-download "></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="<?= \yii\helpers\Url::to(["admin/edit/$document->id"])?>" class="btn btn-reset
                            text-muted"
                               title="More
                            actions">
                                <i class="far fa-edit "></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="<?=\yii\helpers\Url::to(["admin/delete/$document->id"])?>" class="btn btn-reset text-muted" title="More actions">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </li>
                    </ul>
                </figcaption>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p><?=$file->id?></p>
                    <footer class="blockquote-footer">Someone famous in
                        <cite title="Source Title">Source Title</cite>
                    </footer>
                </blockquote>
            </div>
        </div>
        <?php endforeach?>
        <?php
        endif; ?>
    </div>
</div>
