<?php
/** @var object $sectorFom */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
$sector = \app\models\SectorOverview::find()->all();
$sectorArr =[];

foreach ($sector as $sectorObj){

    $sectorArr += [$sectorObj->name=>$sectorObj->info];

}

;
?>
<?php
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data ']]) ?>

<div class="row" bis_skin_checked="1">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" bis_skin_checked="1">
        <label class="mb-3">Sector Overview</label>
    </div>

</div>
<div>
    <?= $form->field($sectorFom, 'sectorInfoCommercial')->textarea(['rows' => 20, 'cols' => 20,'value'=>$sectorArr['Commercial']])->label('Sector Overview Commercial');
    ?>
</div>
<div>
    <?= $form->field($sectorFom, 'sectorInfoResidential')->textarea(['rows' => 20, 'cols' => 20,'value'=>$sectorArr['Residential']])->label('Sector Overview Residential');
    ?>
</div>
<div>
    <?= $form->field($sectorFom, 'sectorInfoHotels')->textarea(['rows' => 20, 'cols' => 20,'value'=>$sectorArr['Hotels']])->label('Sector Overview Hotels');
    ?>
</div>
<div>
    <?= $form->field($sectorFom, 'sectorInfoDental')->textarea(['rows' => 20, 'cols' => 20,'value'=>$sectorArr['Dental']])->label('Sector Overview Dental');
    ?>
</div>
<div>
    <?= $form->field($sectorFom, 'sectorInfoCareHomes')->textarea(['rows' => 20, 'cols' => 20,
                                                                   'value'=>$sectorArr['Care Homes']])->label('Sector Overview Homes');
    ?>
</div>
<div>
    <?= $form->field($sectorFom, 'sectorInfoNurseries')->textarea(['rows' => 20, 'cols' => 20,'value'=>$sectorArr['Nurseries']])->label('Sector Overview Nurseries');
    ?>
</div>
<?= \yii\helpers\Html::submitButton('SUBMIT FORM', [
    'class' => 'btn btn-primary btn-lg 
                    btn-block', 'id'=>'textArea'
]) ?>
<?php
ActiveForm::end(); ?>

