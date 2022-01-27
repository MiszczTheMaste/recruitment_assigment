<?php

namespace App\Exception;

final class NoFileFound extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct("No file found");
    }
}
