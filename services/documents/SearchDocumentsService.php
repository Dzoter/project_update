<?php
namespace app\services\documents;

use app\models\Documents;


class SearchDocumentsService
{
    public function search()
    {
        return Documents::find()->orderBy(['id'=>SORT_DESC]);
    }


}