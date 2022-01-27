<?php

namespace App\File\Validator;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class CSVFileStructureValidator
{
    const REQUIRED_FIELD_NAME = 'nazwa';
    const REQUIRED_FIELD_PRODUCT = 'index';

    public static function hasValidStructure(UploadedFile $file): bool
    {
        if (($handle = fopen($file->getRealPath(), "r")) !== FALSE) {
            $header = fgetcsv($handle, null, ";");
            fclose($handle);
            if (in_array(self::REQUIRED_FIELD_NAME, $header) && in_array(self::REQUIRED_FIELD_PRODUCT, $header)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
