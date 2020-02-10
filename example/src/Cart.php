<?php
declare(strict_types=1);

namespace MPUnit\Example;

final class Cart
{
    /**
     * @var string[]
     */
    private array $items;

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        $this->items = [];
    }


    /**
     * @param string $item
     */
    public function addItem(string $item): void
    {
        $this->items[] = $item;
    }

    public function countItem(): int
    {
        return count($this->items);
    }
}
