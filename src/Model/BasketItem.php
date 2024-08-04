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
    public function __construct(public readonly string $name, private int $quantity) {

    }

    /**
     * @return int
     */
    final public function getQuantity(): int {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return void
     */
    final public function raiseQuantity(int $quantity): void {
        $this->quantity += $quantity;
    }
}