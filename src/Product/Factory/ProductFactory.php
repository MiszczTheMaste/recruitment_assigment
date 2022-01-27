<?php

namespace App\Product\Factory;

use App\Product\DTO\Product;

class ProductFactory
{
    public static function createProduct(string $name, string $index): Product
    {
        return new Product($name, $index);
    }
}
