<?php
/** @var object $document */

/** @var object $updateDocumentToBdForm */
/** @var object $renameForm */
/** @var object $addAnotherImgForm */
/** @var object $addNewImgForm */





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
                    <hr>
                    <hr>
                    <hr>
                    <hr>
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
                        <p><?=$file->name?></p>
                        <img src="<?= Url::to('/'.$file->path) ?>" width="300px" height="300px"
                             alt="Изображения загруженные при добавлении документа">
                        <a href="<?=Url::to(["admin/remove/$file->id/$document->id"])?>">Удалить</a>
                        <?php
                    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>



                        <?= $form->field(
                        $renameForm,
                        'new_name',
                        ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                    )->textInput()->label()
                        ?>
                        <?= $form->field(
                        $renameForm,
                        'id',
                        ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3','style'=>'Display:none']]
                    )->textInput(
                        ['value' => $file->id]
                    )->label()
                        ?>

                        <?= \yii\helpers\Html::submitButton('SUBMIT FORM', [
                        'class' => 'btn btn-primary btn-lg 
                    btn-block',
                    ]) ?>
                        <?php
                        ActiveForm::end(); ?>

                        <b>OR CHANGE THIS IMG</b>

                        <?php
                        $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


                        <?= $form->field($addAnotherImgForm,'file_name')->textInput(['placeholder' => 'Photo Name'])
                            ->label
                        (false) ?>

                        <?= $form->field(
                            $addAnotherImgForm,
                            'files')->fileInput([
                            'multiple' => true,
                        ])->label(false) ?>



                        <?= $form->field(
                            $addAnotherImgForm,
                            'id_image',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3','style'=>'Display:none']]
                        )->textInput(
                            ['value' => $file->id]
                        )->label()
                        ?>

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
                        <hr>
                        <hr>
                    <?php
                    endforeach; ?>
                    <b>OR ADD NEW IMG</b>



                    <?php
                    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


                    <?= $form->field($addNewImgForm,'file_name')->textInput(['placeholder' => 'Photo Name'])
                        ->label
                        (false) ?>

                    <?= $form->field(
                        $addNewImgForm,
                        'files')->fileInput([
                        'multiple' => true,
                    ])->label(false) ?>

                    <?= $form->field(
                        $addNewImgForm,
                        'document_id',
                        ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3','style'=>'Display:none']]
                    )->textInput(
                        ['value' => $document->id]
                    )->label()
                    ?>



                    <?= \yii\helpers\Html::submitButton('SUBMIT FORM', [
                        'class' => 'btn btn-primary btn-lg 
                    btn-block',
                    ]) ?>


                    <?php
                    ActiveForm::end(); ?>




                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end validation form -->
        <!-- ============================================================== -->
    </div>


