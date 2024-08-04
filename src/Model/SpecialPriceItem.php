<?php

namespace App\Model;

class SpecialPriceItem {
    public function __construct(public readonly string $name, public readonly int $quantity, public readonly float $price) {

    }
}