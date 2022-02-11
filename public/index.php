<?php

declare(strict_types = 1);

use App\Models\Inventory;
use App\Models\Product;
use App\Models\VolumePrice;
use App\Terminal;

require_once __DIR__ . '/../vendor/autoload.php';

$inventory = new Inventory();
$inventory->add(new Product("A", 2, new VolumePrice(4, 7)));
$inventory->add(new Product("B", 12, null));
$inventory->add(new Product("C", 1.25, new VolumePrice(6, 6)));
$inventory->add(new Product("D", 0.15, null));

$terminal = new Terminal($inventory);

$firstCase = ["A", "B", "C", "D", "A", "B", "A", "A"];
foreach ($firstCase as $productName) {
    $terminal->scan($productName);
}
echo "Products: " . implode($firstCase) . " - total price: $" . number_format($terminal->getTotalPrice(), 2, '.', ) . "<br />";
$terminal->reset();

$secondCase = ["C", "C", "C", "C", "C", "C", "C"];
foreach ($secondCase as $productName) {
    $terminal->scan($productName);
}
echo "Products: " . implode($secondCase) . " - total price: $" . number_format($terminal->getTotalPrice(), 2, '.', ) . "<br />";
$terminal->reset();

$thirdCase = ["A", "B", "C", "D"];
foreach ($thirdCase as $productName) {
    $terminal->scan($productName);
}
echo "Products: " . implode($thirdCase) . " - total price: $" . number_format($terminal->getTotalPrice(), 2, '.', ) . "<br />";