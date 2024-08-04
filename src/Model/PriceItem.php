<?php

namespace App\Model;

/**
 * Item of price-list
 */
class PriceItem {

    /**
     * @var SpecialPriceItem[]
     */
    public array $specialPrices = [];

    /**
     * @param string $name
     */
    public function __construct(public readonly string $name, public readonly UnitPriceItem $unitPrice) {

    }

    /**
     * @param SpecialPriceItem $specialPrice
     * @return void
     */
    final public function setSpecialPrice(SpecialPriceItem $specialPrice): void
    {
        $this->specialPrices[$specialPrice->quantity] = $specialPrice;
        ksort($this->specialPrices, SORT_NUMERIC);
    }

    /**
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
     * @return void
     */
    final public function clearSpecialPrices(): void
    {
        $this->specialPrices = [];
    }
}