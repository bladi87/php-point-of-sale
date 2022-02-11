<?php

namespace Tests;

use App\Models\Inventory;
use App\Models\Product;
use App\Models\VolumePrice;
use App\Terminal;
use PHPUnit\Framework\TestCase;

class TerminalTest extends TestCase
{
    private Inventory $inventory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->inventory = new Inventory();
        $this->inventory->add(new Product("A", 2, new VolumePrice(4, 7)));
        $this->inventory->add(new Product("B", 12, null));
        $this->inventory->add(new Product("C", 1.25, new VolumePrice(6, 6)));
        $this->inventory->add(new Product("D", 0.15, null));
    }

    /** @test  */
    public function test_first_case(): void
    {
        $terminal = new Terminal($this->inventory);
        $terminal->scan("A");
        $terminal->scan("B");
        $terminal->scan("C");
        $terminal->scan("D");
        $terminal->scan("A");
        $terminal->scan("B");
        $terminal->scan("A");
        $terminal->scan("A");

        $this->assertEquals(4, sizeof($terminal->getScannedProducts()));
        $this->assertEquals(32.40, $terminal->getTotalPrice());
    }

    /** @test  */
    public function test_second_case(): void
    {
        $terminal = new Terminal($this->inventory);
        $terminal->scan("C");
        $terminal->scan("C");
        $terminal->scan("C");
        $terminal->scan("C");
        $terminal->scan("C");
        $terminal->scan("C");
        $terminal->scan("C");

        $this->assertEquals(1, sizeof($terminal->getScannedProducts()));
        $this->assertEquals(7.25, $terminal->getTotalPrice());
    }

    /** @test  */
    public function test_third_case(): void
    {
        $terminal = new Terminal($this->inventory);
        $terminal->scan("A");
        $terminal->scan("B");
        $terminal->scan("C");
        $terminal->scan("D");

        $this->assertEquals(4, sizeof($terminal->getScannedProducts()));
        $this->assertEquals(15.40, $terminal->getTotalPrice());
    }
}