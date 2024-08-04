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

    final public function getQuantity(): string {
        return $this->quantity;
    }

    final public function raiseQuantity(int $quantity): void {
        $this->quantity += $quantity;
    }
}