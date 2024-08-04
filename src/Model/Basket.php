<?php

namespace App\Model;

/**
 * Shopping basket
 */
class Basket {

    /**
     * @var BasketItem[]
     */
    public array $items = [];

    /**
     * Total price of products in the basket
     *
     * @param PriceList $priceList
     * @return float
     */
    final public function totalPrice(PriceList $priceList): float
    {
        $price = 0;
        foreach ($this->items as $item) {
            $price += $priceList->price($item);
        }
        return round($price, 2);
    }

    /**
     * Adds or overwrites product of given name from basket
     *
     * @param BasketItem $item
     * @return void
     */
    final public function setItem(BasketItem $item): void
    {
        $this->items[$item->name] = $item;
    }

    /**
     * Adds product to basket (when not yet present), or raises the quantity
     *
     * @param string $name
     * @param int $quantity
     * @return void
     */
    final public function raiseItemQuantity(string $name, int $quantity): void
    {
        if (!array_key_exists($name, $this->items)) {
            $this->setItem(new BasketItem($name, $quantity));
        } else {
            $this->items[$name]->raiseQuantity($quantity);
        }
    }

    /**
     * Removes product of given name from basket
     *
     * @param BasketItem $item
     * @return void
     */
    final public function removeItem(BasketItem $item): void
    {
        if (array_key_exists($item->name, $this->items)) {
            unset($this->items[$item->name]);
        }
    }

}