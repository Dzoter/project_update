<?php
/** @var object $addDocumentToBdForm */

use yii\widgets\ActiveForm;

?>
<div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Add document </h2>

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
                <h5 class="card-header">Document Form</h5>
                <div class="card-body">


                    <?php
                    $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                    <div class="row">
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'property_number',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(
                            ['placeholder' => 'PROPERTY NUMBER']
                        )->label()
                        ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'street',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(['placeholder' => 'STREET'])->label
                        (
                            false
                        )
                        ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'town',
                            ['options' => ['class' => 'col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput([
                            'placeholder' =>
                                'TOWN',
                        ])
                            ->label
                            (
                                false
                            )
                        ?>


                        <?= $form->field(
                            $addDocumentToBdForm,
                            'post_code',
                            ['options' => ['class' => 'col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(['placeholder' => 'POST CODE'])
                            ->label
                            (
                                false
                            )
                        ?>


                        <?= $form->field(
                            $addDocumentToBdForm,
                            'post_code_first_part',
                            ['options' => ['class' => 'col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(['placeholder' => 'POST CODE FIRST PART'])
                            ->label
                            (
                                false
                            )
                        ?>
                    </div>



                    <button type="button" class="btn-success btn" id="findButtn">Найти</button>






<script>
let findBtn = document.getElementById('findButtn');
findBtn.addEventListener('click',function (){

let propertyNumber = document.getElementById('adddocumenttobdform-property_number').value
let street = document.getElementById('adddocumenttobdform-street').value
let town = document.getElementById('adddocumenttobdform-town').value
let postCode = document.getElementById('adddocumenttobdform-post_code').value




// Создаем экземпляр класса XMLHttpRequest
const request = new XMLHttpRequest()

// Указываем путь до файла на сервере, который будет обрабатывать наш запрос
const url = "<?= \yii\helpers\Url::toRoute('api/GetSertificateList')?>";
//
// Так же как и в GET составляем строку с данными, но уже без пути к файлу
       const params = "params="+propertyNumber+street+town+postCode;

       /* Указываем что соединение	у нас будет POST, говорим что путь к файлу в переменной url, и что запрос у нас
       асинхронный, по умолчанию так и есть не стоит его указывать, еще есть 4-й параметр пароль авторизации, но этот
           параметр тоже необязателен.*/
       request.open("POST", url, true);
//
//В заголовке говорим что тип передаваемых данных закодирован.
       request.setRequestHeader("Content-type", "application/json");
        request.setRequestHeader("X-CSRF-TOKEN", "<?=Yii::$app->request->getCsrfToken()?>");

        request.addEventListener("readystatechange", () => {

           if(request.readyState === 4 && request.status === 200) {
               let resultForShowInput = JSON.parse(request.response)
               console.log(resultForShowInput)
           }
       });

//	Вот здесь мы и передаем строку с данными, которую формировали выше. И собственно выполняем запрос.
       request.send(params);

   })

</script>

                    <div class="row">
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'client',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(
                            ['placeholder' => 'CLIENT']
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'purpose_of_Valuation_ids',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5']]
                        )->radioList(
                            \app\models\forms\AddDocumentToBdForm::getPurposeOfValuation(),
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $return = '<label class="custom-control custom-radio">';
                                    $return .= '<input class="custom-control-input" type="radio" name="'.$name
                                        .'" value="'.$value.'" tabindex="3">';
                                    $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                    $return .= '</label>';

                                    return $return;
                                },

                            ]
                        )
                            ->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'borrower',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(
                            ['placeholder' => 'borrower']
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'limited_liability',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5']]
                        )->radioList(
                            [1 => 'yes', 0 => 'no'],
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $return = '<label class="custom-control custom-radio">';
                                    $return .= '<input class="custom-control-input" type="radio" name="'.$name
                                        .'" value="'.$value.'" tabindex="3">';
                                    $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                    $return .= '</label>';

                                    return $return;
                                },

                            ]
                        )
                            ->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'same_as_inspection',
                            ['options' => ['class' => 'col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5']]
                        )->radioList(
                            [1 => 'yes', 0 => 'no'],
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $return = '<label class="custom-control custom-radio">';
                                    if ($label === 'yes') {
                                        $return .= '<input class="custom-control-input yes" type="radio" name="'.$name
                                            .'" value="'.$value.'" tabindex="3">';
                                    } else {
                                        $return .= '<input class="custom-control-input no" checked type="radio" name="'
                                            .$name
                                            .'" value="'.$value.'" tabindex="3">';
                                    }

                                    $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                    $return .= '</label>';

                                    return $return;
                                },

                            ]
                        )
                            ->label()
                        ?>
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'valuation_date',
                            ['options' => ['class' => 'col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(
                            ['type' => 'date']
                        )->label()
                        ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'inspection_date',
                            ['options' => ['class' => 'col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(
                            ['type' => 'date']
                        )->label()
                        ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'report_date',
                            ['options' => ['class' => 'col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5']]
                        )->textInput(
                            ['type' => 'date', 'value' => date("Y-m-d")]
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'cj_ref',
                            ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(
                            ['placeholder' => 'CJ REF']
                        )->label()
                        ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'client_ref',
                            ['options' => ['class' => 'col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(
                            ['placeholder' => 'CLIENT REF']
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'valuer',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                        )->textInput(
                            ['placeholder' => 'VALUER']
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'double_signed',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3']]
                        )->radioList(
                            [1 => 'yes', 0 => 'no'],
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $return = '<label class="custom-control custom-radio">';
                                    if ($label === 'yes') {
                                        $return .= '<input class="custom-control-input yes" type="radio" name="'.$name
                                            .'" value="'.$value.'" tabindex="3">';
                                    } else {
                                        $return .= '<input class="custom-control-input no" checked  type="radio" name="'
                                            .$name
                                            .'" value="'.$value.'" tabindex="3">';
                                    }

                                    $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                    $return .= '</label>';

                                    return $return;
                                },

                            ]
                        )
                            ->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'valuer_2',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 collapse']]
                        )->textInput(
                            ['placeholder' => 'VALUER 2']
                        )->label()
                        ?>
                    </div>
                    <div class="row">
                        <?= $form->field(
                            $addDocumentToBdForm,
                            'tenure_ids',
                            ['options' => ['class' => 'col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5']]
                        )->radioList(
                            \app\models\forms\AddDocumentToBdForm::getTenure(),
                            [

                                'item' => function ($index, $label, $name, $checked, $value) {
                                    $return = '<label class="custom-control custom-radio">';
                                    $return .= '<input class="custom-control-input" type="radio" name="'.$name
                                        .'" value="'.$value.'" tabindex="3">';
                                    $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                    $return .= '</label>';

                                    return $return;
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
                            $addDocumentToBdForm,
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
                                    $return = '<label class="custom-control custom-checkbox">';
                                    $return .= '<input class="custom-control-input" type="checkbox" name="'.$name.
                                        '" value="'.$value.'" tabindex="3">';
                                    $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                    $return .= '</label>';


                                    return $return;
                                },

                            ]
                        )
                            ->label(false)
                        ?>
                        <?= $form->field(
                            $addDocumentToBdForm,
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
                                    $return = '<label class="custom-control custom-checkbox">';
                                    $return .= '<input class="custom-control-input" type="checkbox" name="'.$name.
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

                    <div class="row" bis_skin_checked="1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" bis_skin_checked="1">
                            <label class="mb-3">Sector Overview</label>
                        </div>
                        <?= $form->field(
                            $addDocumentToBdForm,
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
                                    $return = '<label class="custom-control custom-checkbox">';
                                    $return .= '<input class="custom-control-input" type="checkbox" name="'.$name.
                                        '" value="'.$value.'" tabindex="3">';
                                    $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                    $return .= '</label>';


                                    return $return;
                                },

                            ]
                        )
                            ->label(false)
                        ?>
                        <?= $form->field(
                            $addDocumentToBdForm,
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
                                    $return = '<label class="custom-control custom-checkbox">';
                                    $return .= '<input class="custom-control-input" type="checkbox" name="'.$name.
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

                    <div class="row" bis_skin_checked="1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" bis_skin_checked="1">
                            <label class="mb-3">Methodology</label>
                        </div>
                        <?= $form->field(
                            $addDocumentToBdForm,
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
                                    $return = '<label class="custom-control custom-checkbox">';
                                    $return .= '<input class="custom-control-input" type="checkbox" name="'.$name.
                                        '" value="'.$value.'" tabindex="3">';
                                    $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                    $return .= '</label>';


                                    return $return;
                                },

                            ]
                        )
                            ->label(false)
                        ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
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
                                    $return = '<label class="custom-control custom-checkbox">';
                                    $return .= '<input class="custom-control-input" type="checkbox" name="'.$name.
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
                    <div class="row" bis_skin_checked="1">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" bis_skin_checked="1">
                            <label class="mb-3">APPENDICIES</label>
                        </div>
                        <?= $form->field(
                            $addDocumentToBdForm,
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
                                    $return = '<label class="custom-control custom-checkbox">';
                                    $return .= '<input class="custom-control-input" type="checkbox" name="'.$name.
                                        '" value="'.$value.'" tabindex="3">';
                                    $return .= '<span class="custom-control-label">'.ucwords($label).'</span>';
                                    $return .= '</label>';


                                    return $return;
                                },

                            ]
                        )
                            ->label(false)
                        ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
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
                                    $return = '<label class="custom-control custom-checkbox">';
                                    $return .= '<input class="custom-control-input" type="checkbox" name="'.$name.
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
                    <input type="button" value="Add Photo" onmousedown="viewDivOne()">
                    <div class="row" id="div1" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false) ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ])->label(false) ?>
                    </div>


                    <input type="button" id="btn2" style="display:none;" value="Add Photo" onmousedown="viewDivTwo()">
                    <div class="row" id="div2" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false); ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ]) ?>
                    </div>


                    <input type="button" id="btn3" style="display:none;" value="Add Photo" onmousedown="viewDivThree()">
                    <div class="row" id="div3" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false); ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ]) ?>
                    </div>


                    <input type="button" id="btn4" style="display:none;" value="Add Photo" onmousedown="viewDivFour()">
                    <div class="row" id="div4" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false); ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ]) ?>
                    </div>


                    <input type="button" id="btn5" style="display:none;" value="Add Photo" onmousedown="viewDivFive()">
                    <div class="row" id="div5" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false); ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ]) ?>
                    </div>


                    <input type="button" id="btn6" style="display:none;" value="Add Photo" onmousedown="viewDivSix()">
                    <div class="row" id="div6" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false); ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ]) ?>
                    </div>


                    <input type="button" id="btn7" style="display:none;" value="Add Photo" onmousedown="viewDivSeven()">
                    <div class="row" id="div7" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false); ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ]) ?>
                    </div>


                    <input type="button" id="btn8" style="display:none;" value="Add Photo" onmousedown="viewDivEight()">
                    <div class="row" id="div8" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false); ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ]) ?>
                    </div>


                    <input type="button" id="btn9" style="display:none;" value="Add Photo" onmousedown="viewDivNine()">
                    <div class="row" id="div9" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false); ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ]) ?>
                    </div>


                    <input type="button" id="btn10" style="display:none;" value="Add Photo" onmousedown="viewDivTen()">
                    <div class="row" id="div10" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false); ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ]) ?>
                    </div>


                    <input type="button" id="btn11" style="display:none;" value="Add Photo"
                           onmousedown="viewDivEleven()">
                    <div class="row" id="div11" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false); ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ]) ?>
                    </div>


                    <input type="button" id="btn12" style="display:none;" value="Add Photo"
                           onmousedown="viewDivTwelve()">
                    <div class="row" id="div12" style="display: none">
                        <?= $form->field($addDocumentToBdForm, 'fileName[]')->textInput(['placeholder' => 'Photo Name'])
                            ->label(false); ?>

                        <?= $form->field(
                            $addDocumentToBdForm,
                            'files[]'
                        )->fileInput([
                            'multiple' => true,
                        ]) ?>
                    </div>


                    <?= \yii\helpers\Html::submitButton('SUBMIT FORM', [
                        'class' => 'btn btn-primary btn-lg 
                    btn-block',
                    ]) ?>

                    <?php
                    ActiveForm::end(); ?>


                    <script>
                        function viewDivOne() {
                            document.getElementById("div1").style.display = "block";
                            document.getElementById("btn2").style.display = "block";
                        }

                        function viewDivTwo() {
                            document.getElementById("div2").style.display = "block";
                            document.getElementById("btn3").style.display = "block";

                        }

                        function viewDivThree() {
                            document.getElementById("div3").style.display = "block";
                            document.getElementById("btn4").style.display = "block";
                        }

                        function viewDivFour() {
                            document.getElementById("div4").style.display = "block";
                            document.getElementById("btn5").style.display = "block";
                        }

                        function viewDivFive() {
                            document.getElementById("div5").style.display = "block";
                            document.getElementById("btn6").style.display = "block";
                        }

                        function viewDivSix() {
                            document.getElementById("div6").style.display = "block";
                            document.getElementById("btn7").style.display = "block";
                        }

                        function viewDivSeven() {
                            document.getElementById("div7").style.display = "block";
                            document.getElementById("btn8").style.display = "block";
                        }

                        function viewDivEight() {
                            document.getElementById("div8").style.display = "block";
                            document.getElementById("btn9").style.display = "block";
                        }

                        function viewDivNine() {
                            document.getElementById("div9").style.display = "block";
                            document.getElementById("btn10").style.display = "block";
                        }

                        function viewDivTen() {
                            document.getElementById("div10").style.display = "block";
                            document.getElementById("btn11").style.display = "block";
                        }

                        function viewDivEleven() {
                            document.getElementById("div11").style.display = "block";
                            document.getElementById("btn12").style.display = "block";
                        }

                        function viewDivTwelve() {
                            document.getElementById("div12").style.display = "block";
                        }
                    </script>

                    <!--                    <hr>-->
                    <!--                    <hr>-->
                    <!--                    <hr>-->
                    <!---->
                    <!--                    <form action="/admin/add" method="post">-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Property Address</label>-->
                    <!--                                <input type="text" name="property_number" class="form-control"-->
                    <!--                                       placeholder="PROPERTY NUMBER" value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <input type="text" class="form-control" name="street" placeholder="STREET" value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <input type="text" class="form-control" name="town" placeholder="TOWN" value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <input type="text" class="form-control" name="post_code" placeholder="POST CODE"-->
                    <!--                                       value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <input type="text" class="form-control" name="post_code_first_part"-->
                    <!--                                       placeholder="POST CODE FIRST PART" value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Client</label>-->
                    <!--                                <input type="text" class="form-control" name="client" placeholder="CLIENT" value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Purpose of Valuation</label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" checked name="purpose_of_valuation" class="custom-control-input"-->
                    <!--                                           value="loan_security"><span class="custom-control-label">Loan Security</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="purpose_of_valuation" class="custom-control-input"-->
                    <!--                                           value="internal"><span class="custom-control-label">Internal</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="purpose_of_valuation" class="custom-control-input"-->
                    <!--                                           value="other"><span class="custom-control-label">Other</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Borrower</label>-->
                    <!--                                <input type="text" class="form-control mb-5" name="borrower" placeholder="borrower"-->
                    <!--                                       value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Limited Liability</label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" checked name="limited_liability" value="yes"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Yes</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="limited_liability" value="no"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">No</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Same as Inspection Date?</label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="same_as_inspection" value="yes"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Yes</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" checked name="same_as_inspection" value="no"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">No</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Valuation Date</label>-->
                    <!--                                <input type="date" name="valuation_date" class="form-control mb-5" value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Inspection Date</label>-->
                    <!--                                <input type="date" name="inspection_date" class="form-control mb-5" value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Report Date</label>-->
                    <!--                                <input type="date" name="report_date" class="form-control mb-5" value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">CJ Reference No</label>-->
                    <!--                                <input type="text" name="cj_ref" class="form-control mb-5" placeholder="CJ REF"-->
                    <!--                                       value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Client Ref No</label>-->
                    <!--                                <input type="text" name="clinet_ref" class="form-control mb-5" placeholder="CLINET REF"-->
                    <!--                                       value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Valuer</label>-->
                    <!--                                <input type="text" name="valuer" class="form-control mb-5" placeholder="VALUER"-->
                    <!--                                       value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Double Signed?</label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="double_signed" value="yes"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Yes</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" checked name="double_signed" value="no"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">No</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">-->
                    <!--                                <label class="mb-3">Valuer 2:</label>-->
                    <!--                                <input type="text" name="valuer_2" class="form-control mb-5" placeholder="VALUER 2"-->
                    <!--                                       value="">-->
                    <!--                                <div class="valid-feedback">-->
                    <!--                                    Looks good!-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="mb-3">Tenure</label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" checked name="tenure" value="freehold"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Freehold</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="tenure" value="long_leasehold"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Long Leasehold</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-radio">-->
                    <!--                                    <input type="radio" name="tenure" value="leasehold"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Leasehold</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">-->
                    <!--                                <label class="mb-3">Basis of Value</label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]" value="market_value"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Market Value</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]"-->
                    <!--                                           value="market_value_special_assumption_vacant_posession"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Market Value (special assumption vacant posession)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]"-->
                    <!--                                           value="market_value_special_assumption_90_days"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Market Value (special assumption 90 days)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]"-->
                    <!--                                           value="market_value_special_assumption_180_days"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Market Value (special assumption 180 days)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]" value="market_alue_1"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Market Value (1)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]" value="market_value_2"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Market Value (2)</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]" value="market_value_3"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Market Value (3)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]" value="gross_development_alue"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Gross Development Value</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]" value="euv_sh"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">EUV-SH</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]" value="aggregate_market_value_mv_vp"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Aggregate Market Value (MV-VP)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]" value="market_rent"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Market Rent</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="basis_of_value[]" value="reinstatememnt_value"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Reinstatememnt Value</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">-->
                    <!--                                <label class="mb-3">Sector Overview</label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="sector_overview[]" value="commercial"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Commercial</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="sector_overview[]" value="residential"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Residential</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="sector_overview[]" value="hotels"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Hotels</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="sector_overview[]" value="dental"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Dental</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="sector_overview[]" value="care homes"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Care Homes</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="sector_overview[]" value="nurseries"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Nurseries</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">-->
                    <!--                                <label class="mb-3">Methodology</label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="methodology[]" value="investment"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Investment</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="methodology[]" value="comparable"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Comparable</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="methodology[]" value="development"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Development</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="methodology[]" value="development_with_social_housing"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Development with Social Housing</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="methodology[]" value="social_housing"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Social Housing</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="methodology[]" value="trading_(hotel)"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Trading (Hotel)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="methodology[]" value="trading_(dental)"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Trading (Dental)</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="methodology[]" value="trading_(nursery/care_home)"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Trading (Nursery/Care Home)</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">-->
                    <!--                                <label class="mb-3">APPENDICIES</label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="appendicies[]" value="letter_of_instruction"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Letter of Instruction</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="appendicies[]" value="letter_of_acknowledgement"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Letter of Acknowledgement</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="appendicies[]" value="title_plan"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Title Plan</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="appendicies[]" value="leases"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Leases</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="appendicies[]" value="particulars"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Particulars</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="appendicies[]" value="groundsure"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Groundsure</span>-->
                    <!--                                </label>-->
                    <!--                            </div>-->
                    <!--                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-5">-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="appendicies[]" value="development_appraisal"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Development Appraisal</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="appendicies[]" value="proposed plans"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Proposed Plans</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="appendicies[]" value="accounts"-->
                    <!--                                           class="custom-control-input"><span-->
                    <!--                                            class="custom-control-label">Accounts</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="appendicies[]" value="cqc"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">CQC</span>-->
                    <!--                                </label>-->
                    <!--                                <label class="custom-control custom-checkbox">-->
                    <!--                                    <input type="checkbox" name="appendicies[]" value="other"-->
                    <!--                                           class="custom-control-input"><span class="custom-control-label">Other</span>-->
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


</div>