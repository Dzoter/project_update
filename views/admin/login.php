<?php

use yii\widgets\ActiveForm;

/** @var object $adminLoginForm */
///** @var string|bool $errorMsg */
?>
<!-- ============================================================== -->
<!-- login page  -->
<!-- ============================================================== -->
<div class="splash-container">
    <div class="card ">
        <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="../assets/images/logo.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
        <div class="card-body">


            <?php
            $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data ']]) ?>

            <?= $form->field($adminLoginForm, 'username')->textInput(['placeholder' => 'username'])->label(false)
            ?>

            <?= $form->field($adminLoginForm, 'password')->textInput(['placeholder' => 'password'])->label(false)
            ?>
            <?= \yii\helpers\Html::submitButton('Sign in', ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            <?php
            ActiveForm::end(); ?>



        </div>
    </div>
</div>
<?php
//if ($errorMsg):
//?>
<!--<script>-->
<!--    const errorMsg = '--><?//=$errorMsg?>//'
//    alert(errorMsg)
//</script>
<?php //endif?>
<!-- ============================================================== -->
<!-- end login page  -->
<!-- ============================================================== -->