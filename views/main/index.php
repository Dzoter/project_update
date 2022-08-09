<?php

/* @var object $pages */

?>
<a href = "<?=\yii\helpers\Url::to(["admin/login/"])?>">login</a>
<hr>
<a href = "<?=\yii\helpers\Url::to(["admin/documents/"])?>">documents</a>
<header class="masthead" style="background-image: url('/web/images/home-bg.jpg')">
    <div class="container">
        <div class="row">

        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
        </div>
    </div>
</div>



<?= \yii\widgets\LinkPager::widget([
    'pagination' => $pages,
    'activePageCssClass' =>
        'pagination-item--active',
    'options' => ['class' => 'pagination-list'],
    'linkOptions' => ['class' => 'link link--page'],
    'linkContainerOptions' => ['class' => 'pagination-item'],
    'prevPageLabel' => false,
    'nextPageLabel' => false,
    'prevPageCssClass' => 'mark',
    'nextPageCssClass' => 'mark',




]) ?>

