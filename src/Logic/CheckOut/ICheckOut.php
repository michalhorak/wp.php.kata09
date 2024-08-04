<?php

namespace App\Logic\CheckOut;

/**
 * CheckOut interface
 */
interface ICheckOut {

    /**
     * Constructs new {@link ICheckOut} with given pricing rules
     *
     * @param array $rules
     * @return ICheckOut
     */
    public static function new(Array $rules): ICheckOut;

    /**
     * Scans the new item into the basket
     *
     * @param string $itemName
     * @return void
     */
    public function scan(string $itemName): void;

    /**
     * Value of all items currently in basket
     *
     * @return float
     */
    public function total(): float;
}