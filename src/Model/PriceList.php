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
     * @param PriceItem $priceItem
     * @return void
     */
    final public function setPriceItem(PriceItem $priceItem): void
    {
        $this->prices[$priceItem->name] = $priceItem;
    }

    /**
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