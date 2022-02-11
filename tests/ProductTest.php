<?php

declare(strict_types = 1);

namespace Tests;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\VolumePrice;
use App\Terminal;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    /** @test  */
    public function create_product_with_price_and_volume_price()
    {
        $product = new Product("A", 2, new VolumePrice(4, 7));

        $this->assertEquals("A", $product->getName());
        $this->assertEquals(2, $product->getPrice());
        $this->assertInstanceOf(VolumePrice::class, $product->getVolumePrice());
        $this->assertEquals(4, $product->getVolumePrice()->getQty());
        $this->assertEquals(7, $product->getVolumePrice()->getPrice());
    }

    /** @test  */
    public function create_product_only_with_price()
    {
        $product = new Product("A", 2, null);

        $this->assertEquals("A", $product->getName());
        $this->assertEquals(2, $product->getPrice());
        $this->assertNull($product->getVolumePrice());
    }

    /** @test  */
    public function add_products_to_inventory()
    {
        $inventory = new Inventory();
        $inventory->add(new Product("A", 2, null));
        $inventory->add(new Product("B", 4, new VolumePrice(4, 7)));

        $this->assertEquals(2, $inventory->size());
        $this->assertInstanceOf(Inventory::class, $inventory);
    }

    /** @test  */
    public function add_inventory_to_terminal()
    {
        $inventory = new Inventory();
        $inventory->add(new Product("A", 2, null));
        $inventory->add(new Product("B", 4, new VolumePrice(4, 7)));

        $terminal = new Terminal($inventory);
        $this->assertEquals(2, $terminal->getInventory()->size());
        $this->assertInstanceOf(Inventory::class, $terminal->getInventory());
    }

    /** @test  */
    public function scan_single_product_to_terminal_calculate_total()
    {
        $inventory = new Inventory();
        $inventory->add(new Product("A", 2, new VolumePrice(4, 7)));

        $terminal = new Terminal($inventory);
        $terminal->scan("A");
        $terminal->scan("A");
        $terminal->scan("A");
        $terminal->scan("A");
        $terminal->scan("A");

        $this->assertEquals(1, sizeof($terminal->getScannedProducts()));
        $this->assertEquals(9.00, $terminal->getTotalCost());
    }




}