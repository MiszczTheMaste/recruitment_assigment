<?php

namespace App\File\Repository;

interface FileRepository
{
    public function getFile(string $filename): array;
}
