<?php

namespace app\services\documents;

use app\models\Documents;
use app\models\forms\AddDocumentToBdForm;

class AddAdminDocumentService
{
    public function addDocument(AddDocumentToBdForm $addDocumentToBdForm){
        $document = new Documents();
        $document->property_number = $addDocumentToBdForm->property_number;
        $document->street = $addDocumentToBdForm->street;
        $document->town = $addDocumentToBdForm->town;
        $document->post_code = $addDocumentToBdForm->post_code;
        $document->post_code_first_part = $addDocumentToBdForm->post_code_first_part;
        $document->client = $addDocumentToBdForm->client;
        $document->borrower = $addDocumentToBdForm->borrower;
        $document->limited_liability = $addDocumentToBdForm->limited_liability;
        $document->same_as_inspection = $addDocumentToBdForm->same_as_inspection;
        $document->valuation_date = $addDocumentToBdForm->valuation_date;
        $document->inspection_date = $addDocumentToBdForm->inspection_date;
        $document->report_date = $addDocumentToBdForm->report_date;
        $document->cj_ref = $addDocumentToBdForm->cj_ref;
        $document->client_ref = $addDocumentToBdForm->client_ref;
        $document->valuer = $addDocumentToBdForm->valuer;
        $document->valuer_2 = $addDocumentToBdForm->valuer_2;
        $document->double_signed = $addDocumentToBdForm->double_signed;
        $document->save();


    }
}