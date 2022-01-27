<?php

namespace App\File\Validator;

class FileExtensionValidator
{
    public static function isNotValidExtension(string $fileExtension): bool
    {
        if ($fileExtension === "csv" || $fileExtension === "CSV") {
            return false;
        } else {
            return true;
        }
    }
}
