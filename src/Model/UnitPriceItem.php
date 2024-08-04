<?php

namespace App\Model;

/**
 * Unit price
 */
class UnitPriceItem {
    /**
     * @param string $name
     * @param float $price
     */
    public function __construct(public readonly string $name, public readonly float $price) {

    }
}