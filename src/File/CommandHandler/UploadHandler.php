<?php

namespace App\File\CommandHandler;

use App\Exception\InvalidFileExtension;
use App\Exception\InvalidFileStructure;
use App\Exception\NoFileFound;
use App\File\Validator\CSVFileStructureValidator;
use App\File\Validator\FileExtensionValidator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadHandler
{
    private string $uploadDir;

    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    public function upload(UploadedFile $file): void
    {
        if (empty($file)) {
            throw new NoFileFound();
        }

        $filename = $file->getClientOriginalName();
        $fileExtension = $file->getClientOriginalExtension();

        if (FileExtensionValidator::isNotValidExtension($fileExtension)) {
            throw new InvalidFileExtension();
        }

        if (false === CSVFileStructureValidator::hasValidStructure($file)) {
            throw new InvalidFileStructure();
        }

        $file->move($this->uploadDir, $filename);
    }
}
