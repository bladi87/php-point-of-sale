<?php

namespace App\Models;

class Inventory
{
    private array $products;

    public function __construct()
    {
        $this->products = [];
    }

    /**
     * @param Product $product
     * @return void
     */
    public function add(Product $product) : void
    {
        if (!$this->isInInventory($product->getName())) {
            $this->products[$product->getName()] = $product;
        }
    }

    /**
     * @return int
     */
    public function size() : int
    {
        return count($this->products);
    }

    /**
     * @param Product $product
     * @return bool
     */
    public function isInInventory(string $productName) : bool
    {
        return array_key_exists($productName, $this->products);
    }

    public function getProductByName(string $productName) : Product
    {
        return $this->products[$productName];
    }

}