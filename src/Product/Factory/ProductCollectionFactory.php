<?php

namespace App\Product\Factory;

use App\Product\DTO\Product;
use App\Product\DTO\ProductCollection;

class ProductCollectionFactory
{
    public static function createCollection(array $rawData): ProductCollection
    {
        $collection = [];
        foreach ($rawData as $row) {
            $collection[] = new Product($row['name'], $row['indeks']);
        }
        return new ProductCollection($collection);
    }
}
