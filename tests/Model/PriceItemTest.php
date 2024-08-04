<?php
namespace App\Tests\Model;

use App\Model\SpecialPriceItem;
use App\Model\UnitPriceItem;
use PHPUnit\Framework\TestCase;
use App\Model\PriceItem;

class PriceItemTest extends TestCase {

    final public function test__construct(): void
    {
        $item = new PriceItem("A", new UnitPriceItem("A", 41.8));
        self::assertEquals("A", $item->name);
        self::assertEquals(41.8, $item->unitPrice->price);
        $this->expectException(\Error::class);
        $item->name = "B";
        $this->expectException(\Error::class);
        $item->unitPrice = new UnitPriceItem("B", 41.9);
    }

    final public function test__setSpecialPrice(): void
    {
        $item = new PriceItem("A", new UnitPriceItem("A", 41.8));
        $item->setSpecialPrice(new SpecialPriceItem("A", 7,30));
        self::assertEquals("A", $item->name);
        self::assertEquals(30, $item->specialPrices["7"]->price);
    }

    final public function test__getPrice(): void
    {
        $item = new PriceItem("A", new UnitPriceItem("A", 41.8));
        $item->setSpecialPrice(new SpecialPriceItem("A", 7,30));
        self::assertEquals(41.8, $item->getPrice(1));
        self::assertEquals(167.2, $item->getPrice(4));
        self::assertEquals(210, $item->getPrice(7));
        self::assertEquals(240, $item->getPrice(8));
    }

    final public function test__clearSpecialPrices(): void
    {
        $item = new PriceItem("A", new UnitPriceItem("A", 41.8));
        $item->setSpecialPrice(new SpecialPriceItem("A", 7,30));
        $item->clearSpecialPrices();
        self::assertEquals([], $item->specialPrices);
    }
}
