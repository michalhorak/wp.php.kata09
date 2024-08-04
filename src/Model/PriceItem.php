<?php

namespace App\Model;

class PriceItem {

    public function __construct(public readonly string $name) {

    }

    public function setUnitPrice(UnitPriceItem $unitPrice): void
    {
        // TODO: Implement setUnitPrice() method.
    }

    public function setSpecialPrice(SpecialPriceItem $specialPrice): void
    {
        // TODO: Implement setSpecialPrice() method.
    }

    public function clearSpecialPrices(): void
    {
        // TODO: Implement clearSpecialPrices() method.
    }
}