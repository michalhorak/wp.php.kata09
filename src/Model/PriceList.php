<?php

namespace App\Model;

class PriceList {

    /**
     * @var PriceItem[]
     */
    public array $prices = [];

    final public function price(BasketItem $basketItem): float
    {
        if (array_key_exists($basketItem->name, $this->prices)) {
            return $this->prices[$basketItem->name]->getPrice($basketItem->getQuantity());
        }
        return 0;
    }

    final public function setPriceItem(PriceItem $priceItem): void
    {
        $this->prices[$priceItem->name] = $priceItem;
    }

    final public function unsetPriceItem(string $name): void
    {
        if (array_key_exists($name, $this->prices)) {
            unset($this->prices[$name]);
        }
    }
}