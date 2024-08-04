<?php

namespace App\Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\BasketItem;

class BasketItemTest extends TestCase {

    final public function test__construct(): void
    {
        $item = new BasketItem("A", 50);
        self::assertEquals("A", $item->name);
        self::assertEquals(50, $item->quantity);
        $this->expectException(\Error::class);
            $item->name = "B";
    }
}
