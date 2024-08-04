<?php

namespace App\Tests\Model;

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

    }
}
