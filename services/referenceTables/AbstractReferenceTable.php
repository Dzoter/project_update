<?php

namespace app\services\referenceTables;

abstract class AbstractReferenceTable
{
    protected $document;

    public function __construct(\app\models\Documents $document)
    {
        $this->document = $document;

    }
}