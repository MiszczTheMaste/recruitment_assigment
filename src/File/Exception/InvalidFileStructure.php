<?php

namespace App\Exception;

final class InvalidFileStructure extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Invalid file structure");
    }
}
