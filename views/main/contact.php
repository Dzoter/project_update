<?php

use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var string $messageToUser */
/** @var object $feedBackForm */

?>


<header class="masthead" style="background-image: url(<?= Url::to('@web/images/contact-bg.jpg') ?>)">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="page-heading">
                    <h1>Напишите мне</h1>
                    <span class="subheading">я постараюсь ответить в течении 24 часов</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

            <?php
            $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data ']]) ?>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <?= $form->field($feedBackForm, 'name')->textInput(['placeholder' => 'Имя'])->label(false)
                    ?>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <?= $form->field($feedBackForm, 'email')->textInput(['placeholder' => 'E-mail'])->label(false)
                    ?>
                </div>
            </div>
            <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                    <?= $form->field($feedBackForm, 'message')->textarea(['placeholder' => 'Сообщение'])->label(false)
                    ?>
                </div>
            </div>


            <?= \yii\helpers\Html::submitButton('Отправить', ['class' => 'btn btn-secondary']) ?>
            <?php
            ActiveForm::end(); ?>

<?php if($messageToUser): ?>
            <script>
                let message = '<?=$messageToUser?>'
                alert(message)
            </script>

<?php endif;?>




        </div>
    </div>
</div>