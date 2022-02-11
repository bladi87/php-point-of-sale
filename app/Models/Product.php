<?php
declare(strict_types = 1);

namespace App\Models;

class Product
{
    private string $name;
    private float $price;
    private VolumePrice|null $volumePrice;

    /**
     * @param string $name
     * @param float $price
     * @param VolumePrice|null $volumePrice
     */
    public function __construct(string $name, float $price, ?VolumePrice $volumePrice)
    {
        $this->name = $name;
        $this->price = $price;
        $this->volumePrice = $volumePrice;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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

    /**
     * @return VolumePrice|null
     */
    public function getVolumePrice(): ?VolumePrice
    {
        return $this->volumePrice;
    }

    /**
     * @param VolumePrice|null $volumePrice
     */
    public function setVolumePrice(?VolumePrice $volumePrice): void
    {
        $this->volumePrice = $volumePrice;
    }

    public function hasVolumePrice(): bool
    {
        return !is_null($this->volumePrice);
    }






}