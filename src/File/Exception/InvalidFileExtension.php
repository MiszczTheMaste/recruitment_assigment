<?php

namespace App\Exception;

final class InvalidFileExtension extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("Invalid file extension");
    }
}
