<?php
namespace App\Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\UnitPriceItem;

class UnitPriceItemTest extends TestCase {

    final public function test__construct(): void
    {
        $item = new UnitPriceItem("A", 50.4);
        self::assertEquals("A", $item->name);
        self::assertEquals(50.4, $item->price);
        $this->expectException(\Error::class);
        $item->name = "B";
        $this->expectException(\Error::class);
        $item->price = 105;
    }
}
