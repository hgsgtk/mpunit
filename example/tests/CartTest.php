<?php
declare(strict_types=1);

use MPUnit\Example\Cart;
use MPUnit\TestCase;

final class CartTest extends TestCase
{
    private Cart $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->sut = new Cart();
    }

    public function tearDown(): void
    {
        unset($this->sut);

        parent::tearDown();
    }

    /**
     * @see Cart::countItem()
     */
    public function testCountItem(): void
    {
        $actual = $this->sut->countItem();
        $this->assertSame(0, $actual);

        $this->sut->addItem('item 1');
        $this->sut->addItem('item 2');

        $this->assertSame(2, $this->sut->countItem());
    }
}
