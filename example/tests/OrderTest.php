<?php
declare(strict_types=1);

use MPUnit\Example\Order;
use MPUnit\TestCase;

final class OrderTest extends TestCase
{
    /**
     * @dataProvider providerOrders
     *
     * @param Order $sut
     * @param int $expected
     */
    public function testGetTotalAmount(Order $sut, int $expected): void
    {
        $actual = $sut->getTotalAmount();
        $this->assertSame($expected, $actual);
    }

    public function providerOrders(): array
    {
        return [
            [new Order([100, 200], 300), 600],
            [new Order([100], 300), 400],
        ];
    }
}
