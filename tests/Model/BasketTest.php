<?php

namespace App\Tests\Model;

use App\Model\Basket;
use App\Model\BasketItem;
use App\Model\PriceItem;
use App\Model\PriceList;
use App\Model\UnitPriceItem;
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase {

    final public function testTotalPrice(): void
    {
        $priceItem = new PriceItem("D");
        $priceItem->setUnitPrice(new UnitPriceItem("D", 14.5));
        $basketItem = new BasketItem("D", 7);

        $list = new PriceList();
        $list->setPrice($priceItem);

        $basket = new Basket();
        $basket->addItem($basketItem);

        $price = $basket->totalPrice($list);
        self::assertEquals(101.5, $price);
    }
}
