<?php
/** @var object $pages */

/** @var object $documents */

?>
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header">Посты</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <?php
                        if (!$documents): ?>
                            <p>Список постов пуст</p>
                        <?php
                        else: ?>

                            <table class="table">
                                <tr>
                                    <th>Название</th>
                                    <th>Редактировать</th>
                                    <th>Удалить</th>
                                </tr>

                            <?php foreach ($documents as $document):?>
                                <tr>
                                    <td><?=$document->valuation_date?></td>
                                    <td><a href="<?=\yii\helpers\Url::to(["admin/edit/$document->id"])?>" class="btn
                                    btn-primary">Редактировать</a></td>
                                    <td><a href="<?=\yii\helpers\Url::to(["admin/delete/$document->id"])?>" class="btn
                                    btn-danger">Удалить</a></td>
                                </tr>


                        <?php endforeach?>
                            </table>
                            <?= \yii\widgets\LinkPager::widget([
                                'pagination' => $pages,







                            ]) ?>
                        <?php
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
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
        <div class="card">
            <div class="card-header">
                <figcaption class="figure-caption">
                    <ul class="list-inline d-flex text-muted mb-0">
                        <li class="list-inline-item text-truncate mr-auto">
                            <span><i class="fas fa-file-word mr-2"></i></span> .docx
                        </li>
                        <li class="list-inline-item">
                            <a download="" href="#">
                                <i class="fas fa-download "></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="/admin/edit/" class="btn btn-reset text-muted" title="More actions">
                                <i class="far fa-edit "></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="/admin/delete/" class="btn btn-reset text-muted" title="More actions">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </li>
                    </ul>
                </figcaption>
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
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
