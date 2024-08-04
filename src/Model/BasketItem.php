<?php

namespace App\Model;

/**
 * A basket item
 */
class BasketItem {

    /**
     * @param string $name Item name
     * @param int $quantity Item quantity
     */
    public function __construct(public readonly string $name, public readonly int $quantity) {

    }
}