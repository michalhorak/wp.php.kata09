<?php

namespace App\Model;

/**
 * Product price-list / catalog
 */
class PriceList {

    /**
     * @var PriceItem[]
     */
    public array $prices = [];

    /**
     * Price of given basket-item according to this price-list
     *
     * @param BasketItem $basketItem
     * @return float
     */
    final public function price(BasketItem $basketItem): float
    {
        if (array_key_exists($basketItem->name, $this->prices)) {
            return $this->prices[$basketItem->name]->getPrice($basketItem->getQuantity());
        }
        return 0;
    }

    /**
     * Adds or overwrites price item for given product name
     *
     * @param PriceItem $priceItem
     * @return void
     */
    final public function setPriceItem(PriceItem $priceItem): void
    {
        $this->prices[$priceItem->name] = $priceItem;
    }

    /**
     * Removes price item for given product name
     *
     * @param string $name
     * @return void
     */
    final public function unsetPriceItem(string $name): void
    {
        if (array_key_exists($name, $this->prices)) {
            unset($this->prices[$name]);
        }
    }
}