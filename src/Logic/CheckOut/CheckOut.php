<?php

namespace App\Logic\CheckOut;

use App\Model\Basket;
use App\Model\PriceItem;
use App\Model\PriceList;
use App\Model\SpecialPriceItem;
use App\Model\UnitPriceItem;

/**
 * Checkout logic
 */
class CheckOut implements ICheckOut
{
    /**
     * @var Basket
     */
    private Basket $basket;

    /**
     * @param PriceList $priceList
     */
    private function __construct(public readonly PriceList $priceList)
    {
        $this->basket = new Basket();
    }

    /**
     * Price of all items in basket
     *
     * @return float
     */
    private function basketPrice(): float
    {
        return $this->basket->totalPrice($this->priceList);
    }

    /**
     * Property accessor
     *
     * - {@link CheckOut::total()} when "total"
     * - otherwise null
     *
     * @param string $propertyName
     * @return mixed
     */
    public function __get(string $propertyName): mixed
    {
        if ("total" === $propertyName) {
            return $this->basketPrice();
        }

        return null;
    }

    /**
     * Constructs new {@link CheckOut} with given pricing rules
     *
     * @param array<string,int|float|array{0: int|float, 1: string}> $rules
     * @return CheckOut
     *
     * @example
     * // unit price 20 for 'C'
     * Checkout::new([
     *     "C" => 20,
     * ])
     *
     * // unit price 20 for 'C', discounted price 15 for 17 and more items of 'C'
     * Checkout::new([
     *     "C" => [20, "17 for 15"]
     * ])
     *
     * // more complex price-list
     * const RULES = [
     *  "A" => [50, "3 for 130"],
     *  "B" => [30, "2 for 45"],
     *  "C" => 20,
     *  "D" => 15
     * ];
     */
    public static function new(array $rules): CheckOut
    {
        $list = new PriceList();
        foreach ($rules as $ruleName => $ruleValue) {
            $listItem = null;
            if (is_float($ruleValue) || is_int($ruleValue)) {
                $listItem = new PriceItem($ruleName, new UnitPriceItem($ruleName, (float)$ruleValue));
            } else {
                $unitPrice = $ruleValue[0];
                if (is_float($unitPrice) || is_int($unitPrice)) {
                    $listItem = new PriceItem($ruleName, new UnitPriceItem($ruleName, (float)$unitPrice));
                    $specialPrice = explode(" for ", $ruleValue[1]);
                    if (0 === count($specialPrice)) {
                        throw new SpecialPriceParsingException("Invalid separator string");
                    }
                    if (!is_numeric($specialPrice[0])) {
                        throw new SpecialPriceParsingException("Non-numeric quantity");
                    }
                    $quantity = (int)$specialPrice[0];
                    if ((float)$specialPrice[0] !== (float)$quantity) {
                        throw new SpecialPriceParsingException("Non-integer quantity");
                    }
                    if (!is_numeric($specialPrice[1])) {
                        throw new SpecialPriceParsingException("Non-numeric price");
                    }
                    $listItem->setSpecialPrice(new SpecialPriceItem($ruleName, $quantity, (float) $specialPrice[1] / $quantity));
                }
            }
            if (!is_null($listItem)) {
                $list->setPriceItem($listItem);
            }
        }
        return new self($list);
    }

    /**
     * @inheritDoc
     */
    final public function scan(string $itemName): void
    {
        $this->basket->raiseItemQuantity($itemName, 1);
    }

    /**
     * @inheritDoc
     */
    final public function total(): float
    {
        return $this->basketPrice();
    }
}