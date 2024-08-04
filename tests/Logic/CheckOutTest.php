<?php

namespace App\Tests\Logic;

use App\Logic\CheckOut\CheckOut;
use PHPUnit\Framework\TestCase;

class CheckOutTest extends TestCase
{

    const RULES = [
        ["A" => [50, "3 for 130"]],
        ["B" => [30, "2 for 45"]],
        ["C" => 20],
        ["D" => 15]

    ];

    final public function testTotals(): void
    {
        self::assertEquals(0, $this->price(""));
        self::assertEquals(50, $this->price("A"));
        self::assertEquals(80, $this->price("AB"));
        self::assertEquals(115, $this->price("CDBA"));

        self::assertEquals(100, $this->price("AA"));
        self::assertEquals(130, $this->price("AAA"));
        self::assertEquals(180, $this->price("AAAA"));
        self::assertEquals(230, $this->price("AAAAA"));
        self::assertEquals(260, $this->price("AAAAAA"));

        self::assertEquals(160, $this->price("AAAB"));
        self::assertEquals(175, $this->price("AAABB"));
        self::assertEquals(190, $this->price("AAABBD"));
        self::assertEquals(190, $this->price("DABABA"));

    }

    private function price(string $goods): float
    {
        //$co =
        return 1;
    }

    final public function testIncremental(): void
    {

        $co = CheckOut::new(self::RULES);
        self::assertEquals(0, $co->total);
        $co->scan("A");  self::assertEquals(50, $co->total);
        $co->scan("B");  self::assertEquals(80, $co->total);
        $co->scan("A");  self::assertEquals(130, $co->total);
        $co->scan("A");  self::assertEquals(160, $co->total);
        $co->scan("B");  self::assertEquals(175, $co->total);

    }
}
