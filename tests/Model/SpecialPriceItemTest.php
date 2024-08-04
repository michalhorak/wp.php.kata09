<?php

namespace App\Tests\Model;

use App\Model\SpecialPriceItemQuantityException;
use App\Model\SpecialPriceItemPriceException;
use PHPUnit\Framework\TestCase;
use App\Model\SpecialPriceItem;

class SpecialPriceItemTest extends TestCase {

    final public function test__construct(): void
    {
        $item = new SpecialPriceItem("A", 50, 107.3);
        self::assertEquals("A", $item->name);
        self::assertEquals(50, $item->quantity);
        self::assertEquals(107.3, $item->price);
        $this->expectException(\Error::class);
        $item->name = "B";
        $this->expectException(\Error::class);
        $item->quantity = 105;
        $this->expectException(\Error::class);
        $item->price = 14;

        $this->expectException(SpecialPriceItemQuantityException::class);
        $this->expectExceptionMessage("quantity must be greater than 0");
        $item = new SpecialPriceItem("A", 0, 107.3);

        $this->expectException(SpecialPriceItemQuantityException::class);
        $this->expectExceptionMessage("quantity must be greater than 0");
        $item = new SpecialPriceItem("A", -4, 107.3);

        $this->expectException(SpecialPriceItemPriceException::class);
        $this->expectExceptionMessage("price must be greater than 0");
        $item = new SpecialPriceItem("A", 6, -107.3);

        $this->expectException(SpecialPriceItemPriceException::class);
        $this->expectExceptionMessage("price must be greater than 0");
        $item = new SpecialPriceItem("A", 4, 0);
    }
}
