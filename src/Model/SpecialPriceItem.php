<?php

namespace App\Model;

/**
 * Price with quantity discount
 */
class SpecialPriceItem {
    /**
     * @param string $name
     * @param int $quantity
     * @param float $price
     * @throws SpecialPriceItemQuantityException When $quantity not greater than 0
     * @throws SpecialPriceItemPriceException When $price not greater than 0
     */
    public function __construct(public readonly string $name, public readonly int $quantity, public readonly float $price) {
        if ($this->quantity < 1) {
            throw new SpecialPriceItemQuantityException("quantity must be greater than 0");
        }

        if ($this->price <= 0) {
            throw new SpecialPriceItemPriceException("price must be greater than 0");
        }
    }
}