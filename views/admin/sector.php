<?php
/** @var object $sectorFom */

use yii\widgets\ActiveForm;

?>
<?php
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data ']]) ?>

<div class="row" bis_skin_checked="1">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" bis_skin_checked="1">
        <label class="mb-3">Sector Overview</label>
    </div>
    <?= $form->field(
        $sectorFom,
        'sector_radio',
        ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5']]
    )->checkboxList(
        \app\models\forms\AddDocumentToBdForm::getSectorOverview(
            [
                'Commercial',
                'Residential',
                'Hotels',
                'Dental',
                'Care Homes',
                'Nurseries',
            ]
        ),
        [


            'item' => function ($index, $label, $name, $checked, $value) {
                $return = '<label class="custom-control custom-radio">';
                $return .= '<input class="custom-control-input" type="radio" name="'.$name.
                    '" value="'.$value.'" tabindex="3">';
                $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                $return .= '</label>';


                return $return;
            },

        ]
    )
        ->label(false)
    ?>


</div>
<div>
    <?= $form->field($sectorFom, 'sectorInfo')->textarea(['rows' => 20, 'cols' => 20])->label('Sector Overview Info');
    ?>
</div>
<?= \yii\helpers\Html::submitButton('SUBMIT FORM', [
    'class' => 'btn btn-primary btn-lg 
                    btn-block',
]) ?>
<?php
ActiveForm::end(); ?>

