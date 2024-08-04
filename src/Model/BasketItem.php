<?php

namespace App\Model;

/**
 * A basket item
 */
readonly class BasketItem {

    /**
     * @param string $name Item name
     * @param int $quantity Item quantity
     */
    public function __construct(public string $name, public int $quantity) {

    }
}