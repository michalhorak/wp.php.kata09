<?php

namespace App\Tests\Model;

use App\Model\Basket;
use App\Model\BasketItem;
use App\Model\PriceItem;
use App\Model\PriceList;
use App\Model\UnitPriceItem;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase {

    final public function test__totalPrice(): void
    {
        $priceItem = new PriceItem("D", new UnitPriceItem("D", 14.5));
        $basketItem = new BasketItem("D", 7);

        $list = new PriceList();
        $list->setPriceItem($priceItem);

        $basket = new Basket();
        $basket->addItem($basketItem);

        $price = $basket->totalPrice($list);
        self::assertEquals(101.5, $price);
    }
}
