<?php
namespace App\Tests\Model;

use PHPUnit\Framework\TestCase;
use App\Model\PriceItem;

class PriceItemTest extends TestCase {

    final public function test__construct(): void
    {
        $item = new PriceItem("A");
        self::assertEquals("A", $item->name);
        $this->expectException(\Error::class);
        $item->name = "B";
    }
}
