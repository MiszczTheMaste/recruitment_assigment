<?php

namespace App\SiteRenderer\QueryHandler;

use App\Product\DTO\ProductCollection;
use App\Product\Repository\ProductRepository;

class TableRendererHandler
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(): ProductCollection
    {
       return $this->repository->getAllProducts();
    }
}
