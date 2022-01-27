<?php

namespace App\Product\CommandHandler;

use App\File\Repository\FileRepository;
use App\Product\Factory\ProductFactory;
use App\Product\Repository\ProductRepository;

class AddProductHandler
{
    private ProductRepository $productRepository;

    private FileRepository $fileRepository;

    private string $fileDirectory;

    public function __construct(ProductRepository $productRepository, FileRepository $fileRepository, string $fileDirectory)
    {
        $this->productRepository = $productRepository;
        $this->fileRepository = $fileRepository;
        $this->fileDirectory = $fileDirectory;
    }

    public function handle(string $filename): void
    {
        $products = $this->fileRepository->getFile($this->fileDirectory . "/" . $filename);
        foreach ($products as $row) {
            $newProduct = ProductFactory::createProduct($row['nazwa'], $row['index']);
            $this->productRepository->addProduct($newProduct);
        }
    }
}
