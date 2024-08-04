<?php

namespace App\Logic\CheckOut;

use App\Model\BasketItem;

class CheckOut implements ICheckOut
{
    /**
     * @var BasketItem[]
     */
    private array $basket = [];

    private function __construct(private readonly array $rules = [])
    {

    }

    private function itemPrice(BasketItem $item): float
    {
        if (!array_key_exists($item->name, $this->rules)) {
            throw new \OutOfBoundsException("No pricing rule for item {${$item->name}}");
        }

        return $this->rules[$item->name][0] * $item->quantity;
    }

    private function basketPrice(): float
    {
        return array_reduce($this->basket, function ($carry, BasketItem $item) {
            return 0;
            //return $carry + $item->
        },0);
    }

    public function __get(string $propertyName): mixed
    {
        if ("total" === $propertyName) {
            return $this->basketPrice();
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public static function new(array $rules): ICheckOut
    {
        return new self($rules);
    }

    /**
     * @inheritDoc
     */
    final public function scan(string $itemName): void
    {
        // TODO: Implement scan() method.
    }

    /**
     * @inheritDoc
     */
    final public function total(): float
    {
        // TODO: Implement total() method.
    }
}