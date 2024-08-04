<?php

namespace App\Tests\Model;

use App\Model\BasketItem;
use App\Model\PriceItem;
use App\Model\PriceList;
use App\Model\PriceListPriceException;
use App\Model\UnitPriceItem;
use PHPUnit\Framework\TestCase;

class PriceListTest extends TestCase {

    final public function test__setPriceItem(): void
    {
        $list = new PriceList();
        $priceItem = new PriceItem("D", new UnitPriceItem("D", 14.5));
        $list->setPriceItem($priceItem);

        self::assertEquals(true, array_key_exists("D", $list->prices));
        self::assertEquals(false, array_key_exists("C", $list->prices));
    }

    final public function test__unsetPriceItem(): void
    {
        $list = new PriceList();
        $priceItem = new PriceItem("D", new UnitPriceItem("D", 14.5));
        $priceItem2 = new PriceItem("C", new UnitPriceItem("C", 17.5));
        $list->setPriceItem($priceItem);
        $list->setPriceItem($priceItem2);
        self::assertEquals(true, array_key_exists("D", $list->prices));
        self::assertEquals(true, array_key_exists("C", $list->prices));
        $list->unsetPriceItem("C");
        $list->unsetPriceItem("A");
        self::assertEquals(false, array_key_exists("C", $list->prices));
        self::assertEquals(false, array_key_exists("A", $list->prices));
        self::assertEquals(true, array_key_exists("D", $list->prices));
    }

    final public function test__price(): void
    {
        $priceItem = new PriceItem("D", new UnitPriceItem("D", 14.5));
        $basketItem = new BasketItem("D", 7);
        $basketItem2 = new BasketItem("C", 8);

        $list = new PriceList();
        $list->setPriceItem($priceItem);

        $price = $list->price($basketItem);
        self::assertEquals(101.5, $price);

        $this->expectException(PriceListPriceException::class);
        $price2 = $list->price($basketItem2);
    }
}
