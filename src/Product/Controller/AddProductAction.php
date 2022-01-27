<?php

namespace App\Product\Controller;

use App\Product\CommandHandler\AddProductHandler;
use Throwable;

class AddProductAction
{
    private AddProductHandler $handler;

    public function __construct(AddProductHandler $handler)
    {
        $this->handler = $handler;
    }

    public function addProduct(string $filename): bool
    {
        try {
            $this->handler->handle($filename);
        } catch (Throwable $th) {
            echo $th->getMessage();
            return false;
        }
        return true;
    }
}
