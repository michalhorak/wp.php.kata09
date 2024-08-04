<?php

namespace App\Model;

class UnitPriceItem {
    public function __construct(public readonly string $name, public readonly float $price) {

    }
}