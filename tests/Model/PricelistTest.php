<?php

namespace App\Tests\Model;

use App\Model\BasketItem;
use App\Model\PriceItem;
use App\Model\PriceList;
use App\Model\UnitPriceItem;
use PHPUnit\Framework\TestCase;

class PricelistTest extends TestCase {

    final public function testPrice(): void
    {
        $priceItem = new PriceItem("D");
        $priceItem->setUnitPrice(new UnitPriceItem("D", 14.5));
        $basketItem = new BasketItem("D", 7);

        $list = new PriceList();
        $list->setPrice($priceItem);

        $price = $list->price($basketItem);
        self::assertEquals(101.5, $price);
    }
}
