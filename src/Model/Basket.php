<?php

namespace App\Model;

class Basket {

    /**
     * @var BasketItem[]
     */
    public array $items = [];

    final public function totalPrice(PriceList $priceList): float
    {
        $price = 0;
        foreach ($this->items as $item) {
            $price += $priceList->price($item);
        }
        return $price;
    }

    final public function addItem(BasketItem $item): void
    {
        $this->items[] = $item;
    }

    final public function removeItem(BasketItem $item): void
    {
        $index = array_search($item, $this->items, true);
        if ($index !== false) {
            unset($this->items[$index]);
        }
    }

}