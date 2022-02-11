<?php

namespace App\Models;

class VolumePrice
{
    private int $qty;
    private float $price;

    /**
     * @param int $qty
     * @param float $price
     */
    public function __construct(int $qty, float $price)
    {
        $this->qty = $qty;
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return $this->qty;
    }

    /**
     * @param int $qty
     */
    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }



}