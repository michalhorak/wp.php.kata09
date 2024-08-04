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
        return round($price, 2);
    }

    final public function setItem(BasketItem $item): void
    {
        $this->items[$item->name] = $item;
    }

    final public function raiseItemQuantity(string $name, int $quantity): void
    {
        if (!array_key_exists($name, $this->items)) {
            $this->setItem(new BasketItem($name, $quantity));
        } else {
            $this->items[$name]->raiseQuantity($quantity);
        }
    }

    final public function removeItem(BasketItem $item): void
    {
        if (array_key_exists($item->name, $this->items)) {
            unset($this->items[$item->name]);
        }
    }

}