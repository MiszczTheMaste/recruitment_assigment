<?php

namespace App\Product\DTO;

class Product
{
    private string $index;
    private string $name;

    public function __construct(string $name, string $index)
    {
        $this->name = $name;
        $this->index = $index;
    }

    public function getIndex(): string
    {
        return $this->index;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
}
