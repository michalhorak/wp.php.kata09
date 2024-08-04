<?php

namespace App\Model;

/**
 * Item of price-list
 */
class PriceItem {

    /**
     * Discounted prices
     *
     * 0 or more quantity discounts. In case of more than 1 quantity discount, the price with the highest quantity threshold is used
     *
     * @var SpecialPriceItem[]
     */
    public array $specialPrices = [];

    /**
     * @param string $name
     */
    public function __construct(public readonly string $name, public readonly UnitPriceItem $unitPrice) {

    }

    /**
     * Adds quantity discount
     *
     * In case the quantity equals to already existing {@link SpecialPriceItem}, that discounted price is overwritten.
     *
     * @param SpecialPriceItem $specialPrice
     * @return void
     */
    final public function setSpecialPrice(SpecialPriceItem $specialPrice): void
    {
        $this->specialPrices[$specialPrice->quantity] = $specialPrice;
        ksort($this->specialPrices, SORT_NUMERIC);
    }

    /**
     * Price for given quantity
     *
     * @param int $quantity
     * @return float
     */
    final public function getPrice(int $quantity): float
    {
        $specPricesQts = array_keys($this->specialPrices);

        if (count($specPricesQts) > 0 && $quantity >= min($specPricesQts)) {
            ksort($specPricesQts);
            $qtyKey = 0;
            foreach ($specPricesQts as $specPricesQt) {
                if ($specPricesQt <= $quantity) {
                    $qtyKey = $specPricesQt;
                }
                if ($specPricesQt > $quantity) {
                    break;
                }
            }
            return $this->specialPrices[$qtyKey]->price * $quantity;
        }
        return $this->unitPrice->price * $quantity;
    }

    /**
     * Deletes all quantity discounts
     *
     * @return void
     */
    final public function clearSpecialPrices(): void
    {
        $this->specialPrices = [];
    }
}