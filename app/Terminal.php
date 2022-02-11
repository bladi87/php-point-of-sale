<?php

namespace App;

use App\Models\Inventory;

class Terminal
{
    private Inventory $inventory;
    private array $scannedProducts;

    /**
     * @param Inventory $inventory
     */
    public function __construct(Inventory $inventory)
    {
        $this->inventory = $inventory;
        $this->scannedProducts = [];
    }

    public function scan(string $productName): void
    {
        if ($this->inventory->isInInventory($productName)) {
            if (array_key_exists($productName, $this->scannedProducts)) {
                $this->scannedProducts[$productName]++;
            } else {
                $this->scannedProducts[$productName] = 1;
            }
        }
    }

    public function getTotalCost() : float
    {
        $totalCost = 0.00;
        foreach ($this->scannedProducts as $productName => $qty) {
            $totalCost += $this->calculate($productName, $qty);
        }
        return $totalCost;
    }

    private function calculate(string $productName, int $qty) : float
    {
        $product = $this->inventory->getProductByName($productName);
        if ($qty === 1 || !$product->hasVolumePrice()) {
            return $product->getPrice() * $qty;
        } else {
            $volumeUnit = $product->getVolumePrice()->getQty();
            $volumePrice = $product->getVolumePrice()->getPrice();
            return intval($qty / $volumeUnit) * $volumePrice + fmod($qty, $volumeUnit) * $product->getPrice();
        }
    }

    /**
     * @return array
     */
    public function getScannedProducts(): array
    {
        return $this->scannedProducts;
    }

    /**
     * @return Inventory
     */
    public function getInventory(): Inventory
    {
        return $this->inventory;
    }

    /**
     * @param Inventory $inventory
     */
    public function setInventory(Inventory $inventory): void
    {
        $this->inventory = $inventory;
    }




}