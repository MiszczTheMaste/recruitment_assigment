<?php

namespace App\Product\Repository;

use App\Product\DTO\Product;
use App\Product\DTO\ProductCollection;

interface ProductRepository
{
    public function addProduct(Product $product): void;

    public function getAllProducts(): ProductCollection;
}
