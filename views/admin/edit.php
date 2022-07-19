<?php
/** @var object $document */

/** @var object $updateDocumentToBdForm */

use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>




<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title"></h2>
                <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta, fusce sit amet
                    vestibulum mi. Morbi lobortis pulvinar quam.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Forms</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Validations</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->

    <div class="row">
        <!-- ============================================================== -->
        <!-- validation form -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Bootstrap Validation Form</h5>
                <div class="card-body">


                    <?php
                    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data ']]) ?>
                    <div class="row">
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'property_number',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(
                            ['value' => $document->property_number]
                        )->label()
                        ?>

                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'street',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(['value' => $document->street])->label
                        (
                            false
                        )
                        ?>

                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'town',
                            ['options' => ['class' => 'col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput([
                            'value' =>
                                $document->town,
                        ])
                            ->label
                            (
                                false
                            )
                        ?>


                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'post_code',
                            ['options' => ['class' => 'col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(['value' => $document->post_code])
                            ->label
                            (
                                false
                            )
                        ?>


                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'post_code_first_part',
                            ['options' => ['class' => 'col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(['value' => $document->post_code_first_part])
                            ->label
                            (
                                false
                            )
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'client',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(
                            ['value' => $document->client]
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'purpose_of_Valuation_ids',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5']]
                        )->radioList(
                            \app\models\forms\AddDocumentToBdForm::getPurposeOfValuation(),
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $arrayOfSecondTable
                                        = \app\services\documents\GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoPurporse(
                                        Yii::$app->request->get('documentId')
                                    );
                                    if ($arrayOfSecondTable) {
                                        foreach ($arrayOfSecondTable as $id => $tableName) {
                                            if ($tableName === $label) {
                                                $return = '<label class="custom-control custom-radio">';
                                                $return .= '<input class="custom-control-input" type="radio" name="'
                                                    .$name
                                                    .'" value="'.$value.'" tabindex="3" checked>';
                                                $return .= '<span class="custom-control-label">'.ucwords($label)
                                                    .'</span>';
                                                $return .= '</label>';
                                            } else {
                                                $return = '<label class="custom-control custom-radio">';
                                                $return .= '<input class="custom-control-input" type="radio" name="'
                                                    .$name
                                                    .'" value="'.$value.'" tabindex="3">';
                                                $return .= '<span class="custom-control-label">'.ucwords($label)
                                                    .'</span>';
                                                $return .= '</label>';
                                            }
                                        }
                                    } else {
                                        $return = '<label class="custom-control custom-radio">';
                                        $return .= '<input class="custom-control-input" type="radio" name="'
                                            .$name
                                            .'" value="'.$value.'" tabindex="3">';
                                        $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                        $return .= '</label>';
                                    }


                                    return $return;
                                },

                            ]
                        )
                            ->label()
                        ?>
                    </div>
                    <p>Выбранно </p>
                    <div class="row">
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'borrower',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(
                            ['value' => $document->borrower]
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'limited_liability',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5']]
                        )->radioList(
                            [0 => 'no', 1 => 'yes',],
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $document = \app\models\Documents::find()->where(
                                        ['id' => Yii::$app->request->get('documentId')]
                                    )->one();
                                    if ($document->limited_liability === $index) {
                                        $return = '<label class="custom-control custom-radio">';
                                        $return .= '<input class="custom-control-input" type="radio" name="'.$name
                                            .'" value="'.$value.'" tabindex="3" checked>';
                                        $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                        $return .= '</label>';
                                    } else {
                                        $return = '<label class="custom-control custom-radio">';
                                        $return .= '<input class="custom-control-input" type="radio" name="'.$name
                                            .'" value="'.$value.'" tabindex="3">';
                                        $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                        $return .= '</label>';
                                    }


                                    return $return;
                                },

                            ]
                        )
                            ->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'same_as_inspection',
                            ['options' => ['class' => 'col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5']]
                        )->radioList(
                            [0 => 'no', 1 => 'yes'],
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $document = \app\models\Documents::find()->where(
                                        ['id' => Yii::$app->request->get('documentId')]
                                    )->one();
                                    if ($document->same_as_inspection === $index) {
                                        $return = '<label class="custom-control custom-radio">';
                                        $return .= '<input class="custom-control-input" type="radio" name="'.$name
                                            .'" value="'.$value.'" tabindex="3" checked>';
                                        $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                        $return .= '</label>';
                                    } else {
                                        $return = '<label class="custom-control custom-radio">';
                                        $return .= '<input class="custom-control-input" type="radio" name="'.$name
                                            .'" value="'.$value.'" tabindex="3">';
                                        $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                        $return .= '</label>';
                                    }


                                    return $return;
                                },

                            ]
                        )
                            ->label()
                        ?>
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'valuation_date',
                            ['options' => ['class' => 'col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(
                            ['type' => 'date', 'value' => date("Y-m-d", strtotime($document->valuation_date))]
                        )->label()
                        ?>


                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'inspection_date',
                            ['options' => ['class' => 'col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(
                            ['type' => 'date', 'value' => date("Y-m-d", strtotime($document->inspection_date))]
                        )->label()
                        ?>

                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'report_date',
                            ['options' => ['class' => 'col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(
                            ['type' => 'date', 'value' => date("Y-m-d", strtotime($document->report_date))]
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'cj_ref',
                            ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(
                            ['value' => $document->cj_ref]
                        )->label()
                        ?>

                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'client_ref',
                            ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(
                            ['value' => $document->client_ref]
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'valuer',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(
                            ['value' => $document->valuer]
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'double_signed',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                        )->radioList(
                            [0 => 'no', 1 => 'yes',],
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $document = \app\models\Documents::find()->where(
                                        ['id' => Yii::$app->request->get('documentId')]
                                    )->one();
                                    if ($document->double_signed === $index) {
                                        $return = '<label class="custom-control custom-radio">';
                                        $return .= '<input class="custom-control-input" type="radio" name="'.$name
                                            .'" value="'.$value.'" tabindex="3" checked>';
                                        $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                        $return .= '</label>';
                                    } else {
                                        $return = '<label class="custom-control custom-radio">';
                                        $return .= '<input class="custom-control-input" type="radio" name="'.$name
                                            .'" value="'.$value.'" tabindex="3">';
                                        $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                        $return .= '</label>';
                                    }


                                    return $return;
                                },

                            ]
                        )
                            ->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'valuer_2',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(
                            ['value' => $document->valuer_2]
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'tenure_ids',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5']]
                        )->radioList(
                            \app\models\forms\AddDocumentToBdForm::getTenure(),
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $arrayOfSecondTable
                                        = \app\services\documents\GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoTenure(
                                        Yii::$app->request->get('documentId')
                                    );
                                    if ($arrayOfSecondTable) {
                                        foreach ($arrayOfSecondTable as $id => $tableName) {
                                            if ($tableName === $label) {
                                                $checked = 'checked';

                                            }
                                        }
                                    }

                                    return "<label class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'><span class='custom-control-label'>{$label}</span></label>";
                                },

                            ]
                        )
                            ->label()
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" bis_skin_checked="1">
                            <label class="mb-3">Basis of Value</label>
                        </div>
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'basis_of_value_ids',
                            [
                                'options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5'],
                                'labelOptions' => ['class' => 'mb-3', 'style' => 'margin:0,auto;;top:0'],
                            ]
                        )->checkboxList(
                            \app\models\forms\AddDocumentToBdForm::getBasisOfValue(
                                [
                                    'Market Value',
                                    'Market Value (special assumption vacant posession)',
                                    'Market Value (special assumption 90 days)',
                                    'Market Value (special assumption 180 days)',
                                    'Market Value (1)',
                                    'Market Value (2)',
                                ]
                            ),
                            [
                                'class' => 'col-xl-12 col-lg-4 col-md-4 col-sm-4 col-4 mb-5',

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $arrayOfSecondTable
                                        = \app\services\documents\GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoBasis(
                                        Yii::$app->request->get('documentId')
                                    );
                                    if ($arrayOfSecondTable) {
                                        foreach ($arrayOfSecondTable as $id => $tableName) {
                                            if ($tableName === $label) {
                                                $checked = 'checked';

                                            }
                                        }
                                    }

                                    return "<label class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'><span class='custom-control-label'>{$label}</span></label>";
                                },

                            ]
                        )
                            ->label(false)
                        ?>
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'basis_of_value_ids_right',
                            ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5']]
                        )->checkboxList(
                            \app\models\forms\AddDocumentToBdForm::getBasisOfValue(
                                [
                                    'Market Value (3)',
                                    'Gross Development Value',
                                    'EUV-SH',
                                    'Aggregate Market Value (MV-VP)',
                                    'Market Rent',
                                    'Reinstatememnt Value',
                                ]
                            ),
                            [
                                'class' => 'col-xl-12 col-lg-4 col-md-4 col-sm-4 col-4 mb-5',

                                'item' => function ($index, $label, $name, $checked, $value) {

                                    $arrayOfSecondTable
                                        = \app\services\documents\GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoBasis(
                                        Yii::$app->request->get('documentId')
                                    );

                                    if ($arrayOfSecondTable) {
                                        foreach ($arrayOfSecondTable as $id => $tableName) {
                                            if ($tableName === $label) {
                                                $checked = 'checked';

                                            }
                                        }
                                    }

                                    return "<label class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'><span class='custom-control-label'>{$label}</span></label>";
                                },

                            ]
                        )
                            ->label(false)
                        ?>

                    </div>

                    <div class="row" bis_skin_checked="1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" bis_skin_checked="1">
                            <label class="mb-3">Sector Overview</label>
                        </div>
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'sector_overview_ids',
                            ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5']]
                        )->checkboxList(
                            \app\models\forms\AddDocumentToBdForm::getSectorOverview(
                                [
                                    'Commercial',
                                    'Residential',
                                    'Hotels',
                                ]
                            ),
                            [
                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $arrayOfSecondTable = \app\services\documents\GetAllSecondaryInfoOfDocumentsService
                                        ::getSecondaryInfoSector(
                                            Yii::$app->request->get('documentId')
                                        );
                                    if ($arrayOfSecondTable) {
                                        foreach ($arrayOfSecondTable as $id => $tableName) {
                                            if ($tableName === $label) {
                                                $checked = 'checked';

                                            }
                                        }
                                    }

                                    return "<label class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'><span class='custom-control-label'>{$label}</span></label>";
                                },

                            ]
                        )
                            ->label(false)
                        ?>
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'sector_overview_ids_right',
                            ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5']]
                        )->checkboxList(
                            \app\models\forms\AddDocumentToBdForm::getSectorOverview(
                                [
                                    'Dental',
                                    'Care Homes',
                                    'Nurseries',
                                ]
                            ),
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $arrayOfSecondTable = \app\services\documents\GetAllSecondaryInfoOfDocumentsService
                                        ::getSecondaryInfoSector(
                                            Yii::$app->request->get('documentId')
                                        );
                                    if ($arrayOfSecondTable) {
                                        foreach ($arrayOfSecondTable as $id => $tableName) {
                                            if ($tableName === $label) {
                                                $checked = 'checked';

                                            }
                                        }
                                    }

                                    return "<label class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'><span class='custom-control-label'>{$label}</span></label>";
                                },

                            ]
                        )
                            ->label(false)
                        ?>

                    </div>

                    <div class="row" bis_skin_checked="1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" bis_skin_checked="1">
                            <label class="mb-3">Methodology</label>
                        </div>
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'methodology_ids',
                            ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5']]
                        )->checkboxList(
                            \app\models\forms\AddDocumentToBdForm::getMethodology(
                                [
                                    'Investment',
                                    'Comparable',
                                    'Development',
                                    'Development with Social Housing',
                                ]
                            ),
                            [


                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $arrayOfSecondTable = \app\services\documents\GetAllSecondaryInfoOfDocumentsService
                                        ::getSecondaryInfoMethodology(
                                            Yii::$app->request->get('documentId')
                                        );
                                    if ($arrayOfSecondTable) {
                                        foreach ($arrayOfSecondTable as $id => $tableName) {
                                            if ($tableName === $label) {
                                                $checked = 'checked';

                                            }
                                        }
                                    }

                                    return "<label class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'><span class='custom-control-label'>{$label}</span></label>";
                                },

                            ]
                        )
                            ->label(false)
                        ?>

                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'methodology_ids_right',
                            ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5']]
                        )->checkboxList(
                            \app\models\forms\AddDocumentToBdForm::getMethodology(
                                [
                                    'Social Housing',
                                    'Trading (Hotel)',
                                    'Trading (Dental)',
                                    'Trading (Nursery/Care Home)',
                                ]
                            ),
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $arrayOfSecondTable = \app\services\documents\GetAllSecondaryInfoOfDocumentsService
                                        ::getSecondaryInfoMethodology(
                                            Yii::$app->request->get('documentId')
                                        );
                                    if ($arrayOfSecondTable) {
                                        foreach ($arrayOfSecondTable as $id => $tableName) {
                                            if ($tableName === $label) {
                                                $checked = 'checked';

                                            }
                                        }
                                    }

                                    return "<label class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'><span class='custom-control-label'>{$label}</span></label>";
                                },

                            ]
                        )
                            ->label(false)
                        ?>
                    </div>
                    <div class="row" bis_skin_checked="1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" bis_skin_checked="1">
                            <label class="mb-3">APPENDICIES</label>
                        </div>
                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'appendicies_ids',
                            ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5']]
                        )->checkboxList(
                            \app\models\forms\AddDocumentToBdForm::getAppendicies(
                                [
                                    'Letter of Instruction',
                                    'Letter of Acknowledgement',
                                    'Title Plan',
                                    'Leases',
                                    'Particulars',
                                    'Groundsure',
                                ]
                            ),
                            [


                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $arrayOfSecondTable = \app\services\documents\GetAllSecondaryInfoOfDocumentsService
                                        ::getSecondaryInfoAppendicies(
                                            Yii::$app->request->get('documentId')
                                        );
                                    if ($arrayOfSecondTable) {
                                        foreach ($arrayOfSecondTable as $id => $tableName) {
                                            if ($tableName === $label) {
                                                $checked = 'checked';

                                            }
                                        }
                                    }

                                    return "<label class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'><span class='custom-control-label'>{$label}</span></label>";
                                },

                            ]
                        )
                            ->label(false)
                        ?>

                        <?= $form->field(
                            $updateDocumentToBdForm,
                            'appendicies_ids_right',
                            ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5']]
                        )->checkboxList(
                            \app\models\forms\AddDocumentToBdForm::getAppendicies(
                                [
                                    'Development Appraisal',
                                    'Proposed Plans',
                                    'Accounts',
                                    'CQC',
                                    'Other',
                                ]
                            ),
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $arrayOfSecondTable = \app\services\documents\GetAllSecondaryInfoOfDocumentsService
                                        ::getSecondaryInfoAppendicies(
                                            Yii::$app->request->get('documentId')
                                        );
                                    if ($arrayOfSecondTable) {
                                        foreach ($arrayOfSecondTable as $id => $tableName) {
                                            if ($tableName === $label) {
                                                $checked = 'checked';

                                            }
                                        }
                                    }

                                    return "<label class='custom-control custom-checkbox'><input class='custom-control-input' type='checkbox' {$checked} name='{$name}' value='{$value}' tabindex='3'><span class='custom-control-label'>{$label}</span></label>";
                                },

                            ]
                        )
                            ->label(false)
                        ?>
                    </div>


                    <?= \yii\helpers\Html::submitButton('SUBMIT FORM', [
                        'class' => 'btn btn-primary btn-lg 
                    btn-block',
                    ]) ?>

                    <?php
                    ActiveForm::end(); ?>
                    <hr>
                    <hr>
                    <hr>
                    <hr>
                    <?php
                    $files = \app\services\documents\GetAllSecondaryInfoOfDocumentsService::getSecondaryInfoFiles
                    (
                        $document->id
                    );
                    foreach ($files as $file):?>
                        <img src="<?= Url::to('/'.$file->path) ?>" width="300px" height="300px"
                             alt="Изображения загруженные при добавлении документа">

                    <?php
                    endforeach; ?>


                    <!--                    <form action="/admin/add" method="post">-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Property Address</label>-->
                    <!--                                <input type="text" name="property_number" class="form-control" placeholder="PROPERTY NUMBER" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <input type="text" class="form-control" name="street" placeholder="STREET" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <input type="text" class="form-control" name="town" placeholder="TOWN" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <input type="text" class="form-control" name="post_code" placeholder="POST CODE" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <input type="text" class="form-control" name="post_code_first_part" placeholder="POST CODE FIRST PART" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Client</label>-->
                    <!--                                <input type="text" class="form-control" name="client" placeholder="CLIENT" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Purpose of Valuation</label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="purpose_of_valuation" class="custom-control-input"><span class="custom-control-label">Loan Security</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="purpose_of_valuation" class="custom-control-input"><span class="custom-control-label">Internal</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="purpose_of_valuation" class="custom-control-input"><span class="custom-control-label">Other</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Borrower</label>-->
                    <!--                                <input type="text" class="form-control mb-5" placeholder="borrower" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Limited Liability</label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="limited_liability" class="custom-control-input"><span class="custom-control-label">Yes</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="limited_liability" class="custom-control-input"><span class="custom-control-label">No</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Same as Inspection Date?</label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="same_as_inspection" class="custom-control-input"><span class="custom-control-label">Yes</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="same_as_inspection" class="custom-control-input"><span class="custom-control-label">No</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Valuation Date</label>-->
                    <!--                                <input type="date" name="valuation_date" class="form-control mb-5" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Inspection Date</label>-->
                    <!--                                <input type="date" name="inspection_date" class="form-control mb-5" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Report Date</label>-->
                    <!--                                <input type="date" name="report_date" class="form-control mb-5" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">CJ Reference No</label>-->
                    <!--                                <input type="text" name="cj_ref" class="form-control mb-5" placeholder="CJ REF" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Client Ref No</label>-->
                    <!--                                <input type="text" name="clinet ref" class="form-control mb-5" placeholder="CLINET REF" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Valuer</label>-->
                    <!--                                <input type="text" name="valuer" class="form-control mb-5" placeholder="VALUER" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Double Signed?</label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="double_signed" class="custom-control-input"><span class="custom-control-label">Yes</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="double_signed" class="custom-control-input"><span class="custom-control-label">No</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Valuer 2:</label>-->
                    <!--                                <input type="text" name="valuer_2" class="form-control mb-5" placeholder="VALUER 2" value="" required>-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Tenure</label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="tenure" class="custom-control-input"><span class="custom-control-label">Freehold</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="tenure" class="custom-control-input"><span class="custom-control-label">Long Leasehold</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="tenure" class="custom-control-input"><span class="custom-control-label">Leasehold</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">-->
                    <!--                                <label class="mb-3">Basis of Value</label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="market_value" class="custom-control-input"><span class="custom-control-label">Market Value</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="market_value_(special_assumption_vacant_posession)" class="custom-control-input"><span class="custom-control-label">Market Value (special assumption vacant posession)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="market_value_(special_assumption_90_days)" class="custom-control-input"><span class="custom-control-label">Market Value (special assumption 90 days)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="market_value_(special_assumption_180_days)" class="custom-control-input"><span class="custom-control-label">Market Value (special assumption 180 days)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="market_value_(1)" class="custom-control-input"><span class="custom-control-label">Market Value (1)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="market_value_(2)" class="custom-control-input"><span class="custom-control-label">Market Value (2)</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="market_value_(3)" class="custom-control-input"><span class="custom-control-label">Market Value (3)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="gross_development_value" class="custom-control-input"><span class="custom-control-label">Gross Development Value</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="euv-sh" class="custom-control-input"><span class="custom-control-label">EUV-SH</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="aggregate_market_value_(mv-vp)" class="custom-control-input"><span class="custom-control-label">Aggregate Market Value (MV-VP)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="market_rent" class="custom-control-input"><span class="custom-control-label">Market Rent</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="reinstatememnt_value" class="custom-control-input"><span class="custom-control-label">Reinstatememnt Value</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">-->
                    <!--                                <label class="mb-3">Sector Overview</label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="commercial" class="custom-control-input"><span class="custom-control-label">Commercial</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="residential" class="custom-control-input"><span class="custom-control-label">Residential</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="hotels" class="custom-control-input"><span class="custom-control-label">Hotels</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="dental" class="custom-control-input"><span class="custom-control-label">Dental</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="care homes" class="custom-control-input"><span class="custom-control-label">Care Homes</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="nurseries" class="custom-control-input"><span class="custom-control-label">Nurseries</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">-->
                    <!--                                <label class="mb-3">Methodology</label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="investment" class="custom-control-input"><span class="custom-control-label">Investment</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="comparable" class="custom-control-input"><span class="custom-control-label">Comparable</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="development" class="custom-control-input"><span class="custom-control-label">Development</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="development_with_social_housing" class="custom-control-input"><span class="custom-control-label">Development with Social Housing</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="social_housing" class="custom-control-input"><span class="custom-control-label">Social Housing</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="trading_(hotel)" class="custom-control-input"><span class="custom-control-label">Trading (Hotel)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="trading_(dental)" class="custom-control-input"><span class="custom-control-label">Trading (Dental)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="trading_(nursery/care_home)" class="custom-control-input"><span class="custom-control-label">Trading (Nursery/Care Home)</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">-->
                    <!--                                <label class="mb-3">APPENDICIES</label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="letter_of_instruction" class="custom-control-input"><span class="custom-control-label">Letter of Instruction</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="letter_of_acknowledgement" class="custom-control-input"><span class="custom-control-label">Letter of Acknowledgement</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="title_plan" class="custom-control-input"><span class="custom-control-label">Title Plan</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="leases" class="custom-control-input"><span class="custom-control-label">Leases</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="particulars" class="custom-control-input"><span class="custom-control-label">Particulars</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="groundsure" class="custom-control-input"><span class="custom-control-label">Groundsure</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="development_appraisal" class="custom-control-input"><span class="custom-control-label">Development Appraisal</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="proposed plans" class="custom-control-input"><span class="custom-control-label">Proposed Plans</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="accounts" class="custom-control-input"><span class="custom-control-label">Accounts</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="cqc" class="custom-control-input"><span class="custom-control-label">CQC</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="other" class="custom-control-input"><span class="custom-control-label">Other</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="form-row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">-->
                    <!--                                <button class="btn btn-primary" type="submit">Submit form</button>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </form>-->


                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end validation form -->
        <!-- ============================================================== -->
    </div>

    <label class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox"
               name="AddDocumentToBdForm[basis_of_value_ids][]" value="4" tabindex="3">

        <span class="custom-control-label">Market Value (special assumption 180 days)</span>
    </label>
    <label class="custom-control custom-checkbox">
        <input class="custom-control-input" type="checkbox" name="AddDocumentToBdForm[basis_of_value_ids_right][]" value="7" tabindex="3">
        <span class="custom-control-label">Market Value (3)</span>
    </label>
</div>
